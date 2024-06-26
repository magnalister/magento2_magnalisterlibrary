<?php

/**
 * The MIT License (MIT).
 *
 * Copyright (c) 2013 Jonathan Vollebregt (jnvsor@gmail.com), Rokas Šleinius (raveren@gmail.com)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
if (defined('KINT_DIR')) {
    return;
}
if (version_compare(PHP_VERSION, '5.1.2') < 0) {
    throw new Exception('Kint 2.0 requires PHP 5.1.2 or higher');
}

define('KINT_DIR', dirname(__FILE__));
define('KINT_WIN', DIRECTORY_SEPARATOR !== '/');
define('KINT_PHP52', (version_compare(PHP_VERSION, '5.2') >= 0));
define('KINT_PHP522', (version_compare(PHP_VERSION, '5.2.2') >= 0));
define('KINT_PHP523', (version_compare(PHP_VERSION, '5.2.3') >= 0));
define('KINT_PHP524', (version_compare(PHP_VERSION, '5.2.4') >= 0));
define('KINT_PHP525', (version_compare(PHP_VERSION, '5.2.5') >= 0));
define('KINT_PHP53', (version_compare(PHP_VERSION, '5.3') >= 0));
define('KINT_PHP56', (version_compare(PHP_VERSION, '5.6') >= 0));
define('KINT_PHP70', (version_compare(PHP_VERSION, '7.0') >= 0));
define('KINT_PHP72', (version_compare(PHP_VERSION, '7.2') >= 0));
class Kint {

    public static $enabled_mode = true;
    public static $mode_default = self::MODE_RICH;
    public static $mode_default_cli = self::MODE_CLI;
    public static $return;
    public static $file_link_format = '';
    public static $display_called_from = true;
    public static $app_root_dirs = array();
    public static $max_depth = 6;
    public static $expanded = false;
    public static $cli_detection = true;
    public static $aliases = array(array('Kint', 'dump'), array('Kint', 'trace'), array('Kint', 'dumpArray'),);
    public static $renderers = array(self::MODE_RICH => 'Kint_Renderer_Rich', self::MODE_PLAIN => 'Kint_Renderer_Plain', self::MODE_TEXT => 'Kint_Renderer_Text', self::MODE_CLI => 'Kint_Renderer_Cli',);

    const MODE_RICH = 'r';
    const MODE_TEXT = 't';
    const MODE_CLI = 'c';
    const MODE_PLAIN = 'p';

    public static $plugins = array('Kint_Parser_Base64', 'Kint_Parser_Blacklist', 'Kint_Parser_ClassMethods', 'Kint_Parser_ClassStatics', 'Kint_Parser_Closure', 'Kint_Parser_Color', 'Kint_Parser_DateTime', 'Kint_Parser_FsPath', 'Kint_Parser_Iterator', 'Kint_Parser_Json', 'Kint_Parser_Microtime', 'Kint_Parser_SimpleXMLElement', 'Kint_Parser_SplFileInfo', 'Kint_Parser_SplObjectStorage', 'Kint_Parser_Stream', 'Kint_Parser_Table', 'Kint_Parser_Throwable', 'Kint_Parser_Timestamp', 'Kint_Parser_ToString', 'Kint_Parser_Trace', 'Kint_Parser_Xml',);
    private static $plugin_pool = array();
    private static $dump_array = false;
    private static $names = array();

    public static function settings(array $settings = null) {
        static $keys = array('aliases', 'app_root_dirs', 'cli_detection', 'display_called_from', 'enabled_mode', 'expanded', 'file_link_format', 'max_depth', 'mode_default', 'mode_default_cli', 'renderers', 'return', 'plugins',);
        $out = array();
        foreach ($keys as $key) {
            $out[$key] = self::$$key;
        } if ($settings !== null) {
            $in = array_intersect_key($settings, $out);
            foreach ($in as $key => $val) {
                self::$$key = $val;
            }
        } return $out;
    }

    public static function trace($trace = null) {
        if ($trace === null) {
            if (KINT_PHP525) {
                $trace = debug_backtrace(true);
            } else {
                $trace = debug_backtrace();
            }
        } else {
            return self::dump($trace);
        } Kint_Parser_Trace::normalizeAliases(self::$aliases);
        $trimmed_trace = array();
        foreach ($trace as $frame) {
            if (Kint_Parser_Trace::frameIsListed($frame, self::$aliases)) {
                $trimmed_trace = array();
            } $trimmed_trace[] = $frame;
        } return self::dumpArray(array($trimmed_trace), array(Kint_Object::blank('Kint::trace()', 'debug_backtrace()')));
    }

    public static function dumpArray(array $data, array $names = null) {
        self::$names = $names;
        self::$dump_array = true;
        $out = self::dump($data);
        self::$names = null;
        self::$dump_array = false;
        return $out;
    }

    public static function dump($data = null) {
        if (!self::$enabled_mode) {
            return 0;
        } $stash = self::settings();
        $num_args = func_num_args();
        list($params, $modifiers, $callee, $caller, $minitrace) = self::getCalleeInfo(defined('DEBUG_BACKTRACE_IGNORE_ARGS') ? debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS) : debug_backtrace(), $num_args);
        if (self::$enabled_mode === true) {
            self::$enabled_mode = self::$mode_default;
            if (PHP_SAPI === 'cli' && self::$cli_detection === true) {
                self::$enabled_mode = self::$mode_default_cli;
            }
        } if (in_array('~', $modifiers)) {
            self::$enabled_mode = self::MODE_TEXT;
        } if (!array_key_exists(self::$enabled_mode, self::$renderers)) {
            $renderer = self::$renderers[self::MODE_PLAIN];
        } else {
            $renderer = self::$renderers[self::$enabled_mode];
        } if (in_array('-', $modifiers)) {
            while (ob_get_level()) {
                ob_end_clean();
            }
        } if (in_array('!', $modifiers)) {
            self::$expanded = true;
        } if (in_array('+', $modifiers)) {
            self::$max_depth = false;
        } if (in_array('@', $modifiers)) {
            self::$return = true;
        } $renderer = new $renderer(array('num_args' => $num_args, 'params' => $params, 'modifiers' => $modifiers, 'callee' => $callee, 'caller' => $caller, 'minitrace' => $minitrace, 'settings' => self::settings(), 'stash' => $stash,));
        $plugins = array();
        foreach (self::$plugins as $plugin) {
            if ($plugin instanceof Kint_Parser_Plugin) {
                $plugins[] = $plugin;
            } elseif (is_string($plugin) && is_subclass_of($plugin, 'Kint_Parser_Plugin')) {
                if (!isset(self::$plugin_pool[$plugin])) {
                    $p = new $plugin();
                    self::$plugin_pool[$plugin] = $p;
                } $plugins[] = self::$plugin_pool[$plugin];
            }
        } $plugins = $renderer->parserPlugins($plugins);
        $output = $renderer->preRender();
        $parser = new Kint_Parser(self::$max_depth, empty($caller['class']) ? null : $caller['class']);
        foreach ($plugins as $plugin) {
            $parser->addPlugin($plugin);
        } if (!self::$dump_array && (!isset($params[0]['name']) || $params[0]['name'] == '1') && $num_args === 1 && $data === 1) {
            if (KINT_PHP525) {
                $data = debug_backtrace(true);
            } else {
                $data = debug_backtrace();
            } $trace = array();
            foreach ($data as $index => $frame) {
                if (Kint_Parser_Trace::frameIsListed($frame, self::$aliases)) {
                    $trace = array();
                } $trace[] = $frame;
            } $lastframe = reset($trace);
            $tracename = $lastframe['function'] . '(1)';
            if (isset($lastframe['class'], $lastframe['type'])) {
                $tracename = $lastframe['class'] . $lastframe['type'] . $tracename;
            } $tracebase = Kint_Object::blank($tracename, 'debug_backtrace()');
            if (empty($trace)) {
                $output .= $renderer->render($tracebase->transplant(new Kint_Object_Trace()));
            } else {
                $output .= $renderer->render($parser->parse($trace, $tracebase));
            }
        } else {
            $data = func_get_args();
            if ($data === array()) {
                $output .= $renderer->render(new Kint_Object_Nothing());
            } if (self::$dump_array) {
                $data = $data[0];
            } static $blacklist = array('null', 'true', 'false', 'array(...)', 'array()', '"..."', 'b"..."', '[...]', '[]', '(...)', '()');
            foreach ($data as $i => $argument) {
                if (isset(self::$names[$i])) {
                    $output .= $renderer->render($parser->parse($argument, self::$names[$i]));
                    continue;
                } if (!isset($params[$i]['name']) || is_numeric($params[$i]['name']) || in_array(str_replace("'", '"', strtolower($params[$i]['name'])), $blacklist, true)) {
                    $name = null;
                } else {
                    $name = $params[$i]['name'];
                } if (isset($params[$i]['path'])) {
                    $access_path = $params[$i]['path'];
                    if (!empty($params[$i]['expression'])) {
                        $access_path = '(' . $access_path . ')';
                    }
                } else {
                    $access_path = '$' . $i;
                } $output .= $renderer->render($parser->parse($argument, Kint_Object::blank($name, $access_path)));
            }
        } $output .= $renderer->postRender();
        if (self::$return) {
            self::settings($stash);
            return $output;
        } self::settings($stash);
        echo $output;
        return 0;
    }

    public static function shortenPath($file) {
        $file = array_values(array_filter(explode('/', str_replace('\\', '/', $file)), 'strlen'));
        $longest_match = 0;
        $match = '/';
        foreach (self::$app_root_dirs as $path => $alias) {
            if (empty($path)) {
                continue;
            } $path = array_values(array_filter(explode('/', str_replace('\\', '/', $path)), 'strlen'));
            if (array_slice($file, 0, count($path)) === $path && count($path) > $longest_match) {
                $longest_match = count($path);
                $match = $alias;
            }
        } if ($longest_match) {
            $file = array_merge(array($match), array_slice($file, $longest_match));
            return implode('/', $file);
        } else {
            $kint = array_values(array_filter(explode('/', str_replace('\\', '/', KINT_DIR)), 'strlen'));
            foreach ($file as $i => $part) {
                if (!isset($kint[$i]) || $kint[$i] !== $part) {
                    return ($i ? '.../' : '/') . implode('/', array_slice($file, $i));
                }
            } return '/' . implode('/', $file);
        }
    }

    public static function getIdeLink($file, $line) {
        return str_replace(array('%f', '%l'), array($file, $line), self::$file_link_format);
    }

    private static function getCalleeInfo($trace, $num_params) {
        Kint_Parser_Trace::normalizeAliases(self::$aliases);
        $miniTrace = array();
        foreach ($trace as $index => $frame) {
            if (Kint_Parser_Trace::frameIsListed($frame, self::$aliases)) {
                $miniTrace = array();
            } if (!Kint_Parser_Trace::frameIsListed($frame, array('spl_autoload_call'))) {
                $miniTrace[] = $frame;
            }
        } $callee = reset($miniTrace);
        $caller = next($miniTrace);
        if (!$callee) {
            $callee = null;
        } if (!$caller) {
            $caller = null;
        } unset($miniTrace[0]);
        foreach ($miniTrace as $index => &$frame) {
            if (!isset($frame['file'], $frame['line'])) {
                unset($miniTrace[$index]);
            } else {
                unset($frame['object'], $frame['args']);
            }
        } $miniTrace = array_values($miniTrace);
        if (!isset($callee['file'], $callee['line']) || !is_readable($callee['file'])) {
            return array(null, array(), $callee, $caller, $miniTrace);
        } if (empty($callee['class'])) {
            $callfunc = $callee['function'];
        } else {
            $callfunc = array($callee['class'], $callee['function']);
        } $calls = Kint_SourceParser::getFunctionCalls(file_get_contents($callee['file']), $callee['line'], $callfunc);
        $return = array(null, array(), $callee, $caller, $miniTrace);
        foreach ($calls as $call) {
            $is_unpack = false;
            if (KINT_PHP56) {
                foreach ($call['parameters'] as $i => &$param) {
                    if (strpos($param['name'], '...') === 0) {
                        if ($i === count($call['parameters']) - 1) {
                            for ($j = 1; $j + $i < $num_params; ++$j) {
                                $call['parameters'][] = array('name' => 'array_values(' . substr($param['name'], 3) . ')[' . $j . ']', 'path' => 'array_values(' . substr($param['path'], 3) . ')[' . $j . ']', 'expression' => false,);
                            } $param['name'] = 'reset(' . substr($param['name'], 3) . ')';
                            $param['path'] = 'reset(' . substr($param['path'], 3) . ')';
                            $param['expression'] = false;
                        } else {
                            $call['parameters'] = array_slice($call['parameters'], 0, $i);
                        } $is_unpack = true;
                        break;
                    }
                }
            } if ($is_unpack || count($call['parameters']) === $num_params) {
                if ($return[0] === null) {
                    $return = array($call['parameters'], $call['modifiers'], $callee, $caller, $miniTrace);
                } else {
                    return array(null, array(), $callee, $caller, $miniTrace);
                }
            }
        } return $return;
    }

    public static function composerGetExtras($key = 'kint') {
        $extras = array();
        if (!KINT_PHP53) {
            return $extras;
        } $folder = KINT_DIR . '/vendor';
        for ($i = 0; $i < 4; ++$i) {
            $installed = $folder . '/composer/installed.json';
            if (file_exists($installed) && is_readable($installed)) {
                $packages = json_decode(file_get_contents($installed), true);
                foreach ($packages as $package) {
                    if (isset($package['extra'][$key]) && is_array($package['extra'][$key])) {
                        $extras = array_replace($extras, $package['extra'][$key]);
                    }
                } $folder = dirname($folder);
                if (file_exists($folder . '/composer.json') && is_readable($folder . '/composer.json')) {
                    $composer = json_decode(file_get_contents($folder . '/composer.json'), true);
                    if (isset($composer['extra'][$key]) && is_array($composer['extra'][$key])) {
                        $extras = array_replace($extras, $composer['extra'][$key]);
                    }
                } break;
            } else {
                $folder = dirname($folder);
            }
        } return $extras;
    }

    public static function composerGetDisableHelperFunctions() {
        $extras = self::composerGetExtras();
        return !empty($extras['disable-helper-functions']);
    }

}

class Kint_Object {

    const ACCESS_NONE = null;
    const ACCESS_PUBLIC = 'public';
    const ACCESS_PROTECTED = 'protected';
    const ACCESS_PRIVATE = 'private';
    const OPERATOR_NONE = null;
    const OPERATOR_ARRAY = '=>';
    const OPERATOR_OBJECT = '->';
    const OPERATOR_STATIC = '::';

    public $name;
    public $type;
    public $static = false;
    public $const = false;
    public $access = self::ACCESS_NONE;
    public $owner_class;
    public $access_path;
    public $operator = self::OPERATOR_NONE;
    public $reference = false;
    public $size = null;
    public $depth = 0;
    public $representations = array();
    public $value = null;
    public $hints = array();

    public function __construct() {

    }

    public function addRepresentation(Kint_Object_Representation $rep, $pos = null) {
        if (isset($this->representations[$rep->name])) {
            return false;
        } if ($this->value === null) {
            $this->value = $rep;
        } if ($pos === null) {
            $this->representations[$rep->name] = $rep;
        } else {
            $this->representations = array_merge(array_slice($this->representations, 0, $pos), array($rep->name => $rep), array_slice($this->representations, $pos));
        } return true;
    }

    public function replaceRepresentation(Kint_Object_Representation $rep, $pos = null) {
        if ($pos === null) {
            $this->representations[$rep->name] = $rep;
        } else {
            $this->removeRepresentation($rep->name);
            $this->addRepresentation($rep, $pos);
        }
    }

    public function removeRepresentation($name) {
        unset($this->representations[$name]);
    }

    public function getRepresentation($name) {
        if (isset($this->representations[$name])) {
            return $this->representations[$name];
        }
    }

    public function getRepresentations() {
        return $this->representations;
    }

    public function clearRepresentations() {
        $this->representations = array();
    }

    public function getType() {
        return $this->type;
    }

    public function getModifiers() {
        $out = $this->getAccess();
        if (is_null($out)) {
            $out = '';
        }
        if ($this->const) {
            $out .= ' const';
        } if ($this->static) {
            $out .= ' static';
        } if (strlen($out)) {
            return ltrim($out);
        }
    }

    public function getAccess() {
        switch ($this->access) {
            case self::ACCESS_PRIVATE: return 'private';
            case self::ACCESS_PROTECTED: return 'protected';
            case self::ACCESS_PUBLIC: return 'public';
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getOperator() {
        if ($this->operator === self::OPERATOR_ARRAY) {
            return '=>';
        } elseif ($this->operator === self::OPERATOR_OBJECT) {
            return '->';
        } elseif ($this->operator === self::OPERATOR_STATIC) {
            return '::';
        } return;
    }

    public function getSize() {
        return $this->size;
    }

    public function getValueShort() {
        if ($rep = $this->value) {
            if ($this->type === 'boolean') {
                return $rep->contents ? 'true' : 'false';
            } elseif ($this->type === 'integer' || $this->type === 'double') {
                return $rep->contents;
            }
        }
    }

    public function getAccessPath() {
        return $this->access_path;
    }

    public static function blank($name = null, $access_path = null) {
        $o = new self();
        $o->name = $name;
        $o->access_path = $name;
        if ($access_path) {
            $o->access_path = $access_path;
        } return $o;
    }

    public function transplant(Kint_Object $new) {
        $new->name = $this->name;
        $new->size = $this->size;
        $new->access_path = $this->access_path;
        $new->access = $this->access;
        $new->static = $this->static;
        $new->const = $this->const;
        $new->type = $this->type;
        $new->depth = $this->depth;
        $new->owner_class = $this->owner_class;
        $new->operator = $this->operator;
        $new->reference = $this->reference;
        $new->value = $this->value;
        $new->representations += $this->representations;
        $new->hints = array_merge($this->hints, $new->hints);
        return $new;
    }

    public static function isSequential(array $array) {
        return array_keys($array) === range(0, count($array) - 1);
    }

    public static function sortByAccess(Kint_Object $a, Kint_Object $b) {
        static $sorts = array(self::ACCESS_PUBLIC => 1, self::ACCESS_PROTECTED => 2, self::ACCESS_PRIVATE => 3, self::ACCESS_NONE => 4,);
        return $sorts[$a->access] - $sorts[$b->access];
    }

    public static function sortByName(Kint_Object $a, Kint_Object $b) {
        $ret = strnatcasecmp($a->name, $b->name);
        if ($ret === 0) {
            return is_int($a->name) - is_int($b->name);
        } return $ret;
    }

}

class Kint_Parser {

    public $caller_class;
    public $max_depth;
    private $marker;
    private $object_hashes = array();
    private $parse_break = false;
    private $plugins = array();

    const TRIGGER_NONE = 0;
    const TRIGGER_BEGIN = 1;
    const TRIGGER_SUCCESS = 2;
    const TRIGGER_RECURSION = 4;
    const TRIGGER_DEPTH_LIMIT = 8;
    const TRIGGER_COMPLETE = 14;

    public function __construct($max_depth = false, $c = null) {
        $this->marker = uniqid("kint\0", true);
        $this->caller_class = $c;
        $this->max_depth = $max_depth;
    }

    public function parse(&$var, Kint_Object $o) {
        $o->type = strtolower(gettype($var));
        if (!$this->applyPlugins($var, $o, self::TRIGGER_BEGIN)) {
            return $o;
        } switch ($o->type) {
            case 'array': return $this->parseArray($var, $o);
            case 'boolean': case 'double': case 'integer': case 'null': return $this->parseGeneric($var, $o);
            case 'object': return $this->parseObject($var, $o);
            case 'resource': return $this->parseResource($var, $o);
            case 'string': return $this->parseString($var, $o);
            default: return $this->parseUnknown($var, $o);
        }
    }

    private function parseGeneric(&$var, Kint_Object $o) {
        $rep = new Kint_Object_Representation('Contents');
        $rep->contents = $var;
        $rep->implicit_label = true;
        $o->addRepresentation($rep);
        $this->applyPlugins($var, $o, self::TRIGGER_SUCCESS);
        return $o;
    }

    private function parseString(&$var, Kint_Object $o) {
        $string = $o->transplant(new Kint_Object_Blob());
        $string->encoding = Kint_Object_Blob::detectEncoding($var);
        $string->size = Kint_Object_Blob::strlen($var, $string->encoding);
        $rep = new Kint_Object_Representation('Contents');
        $rep->contents = $var;
        $rep->implicit_label = true;
        $string->addRepresentation($rep);
        $this->applyPlugins($var, $string, self::TRIGGER_SUCCESS);
        return $string;
    }

    private function parseArray(array &$var, Kint_Object $o) {
        $array = $o->transplant(new Kint_Object());
        $array->size = count($var);
        if (isset($var[$this->marker])) {
            --$array->size;
            $array->hints[] = 'recursion';
            $this->applyPlugins($var, $array, self::TRIGGER_RECURSION);
            return $array;
        }
        $rep = new Kint_Object_Representation('Contents');
        $rep->implicit_label = true;
        $array->addRepresentation($rep);
        if ($array->size) {
            if ($this->max_depth && $o->depth >= $this->max_depth) {
                $array->hints[] = 'depth_limit';
                $this->applyPlugins($var, $array, self::TRIGGER_DEPTH_LIMIT);
                return $array;
            } if (KINT_PHP522) {
                $copy = array_values($var);
            } $i = 0;
            $var[$this->marker] = $array->depth;
            foreach ($var as $key => &$val) {
                if ($key === $this->marker) {
                    continue;
                } $child = new Kint_Object();
                $child->name = $key;
                $child->depth = $array->depth + 1;
                $child->access = Kint_Object::ACCESS_NONE;
                $child->operator = Kint_Object::OPERATOR_ARRAY;
                if ($array->access_path !== null) {
                    if (is_string($key) && (string) (int) $key === $key) {
                        $child->access_path = 'array_values(' . $array->access_path . ')[' . $i . ']';
                    } else {
                        $child->access_path = $array->access_path . '[' . var_export($key, true) . ']';
                    }
                } if (KINT_PHP522) {
                    $stash = $val;
                    $copy[$i] = $this->marker;
                    if ($val === $this->marker) {
                        $child->reference = true;
                        $val = $stash;
                    }
                } $rep->contents[] = $this->parse($val, $child);
                ++$i;
            } $this->applyPlugins($var, $array, self::TRIGGER_SUCCESS);
            unset($var[$this->marker]);
            return $array;
        } else {
            $this->applyPlugins($var, $array, self::TRIGGER_SUCCESS);
            return $array;
        }
    }

    private function parseObject(&$var, Kint_Object $o) {
        if (KINT_PHP53 || function_exists('spl_object_hash')) {
            $hash = spl_object_hash($var);
        } else {
            ob_start();
            var_dump($var);
            preg_match('/#(\d+)/', ob_get_clean(), $match);
            $hash = $match[1];
        } $values = (array) $var;
        $object = $o->transplant(new Kint_Object_Instance());
        $object->classname = get_class($var);
        $object->hash = $hash;
        $object->size = count($values);
        if (isset($this->object_hashes[$hash])) {
            $object->hints[] = 'recursion';
            $this->applyPlugins($var, $object, self::TRIGGER_RECURSION);
            return $object;
        } $this->object_hashes[$hash] = $object;
        if ($this->max_depth && $o->depth >= $this->max_depth) {
            $object->hints[] = 'depth_limit';
            $this->applyPlugins($var, $object, self::TRIGGER_DEPTH_LIMIT);
            unset($this->object_hashes[$hash]);
            return $object;
        } if ($var instanceof ArrayObject) {
            $ArrayObject_flags_stash = $var->getFlags();
            $var->setFlags(ArrayObject::STD_PROP_LIST);
        } $reflector = new ReflectionObject($var);
        if ($reflector->isUserDefined()) {
            $object->filename = $reflector->getFileName();
            $object->startline = $reflector->getStartLine();
        } $rep = new Kint_Object_Representation('Properties');
        if (KINT_PHP522) {
            $copy = array_values($values);
        } $i = 0;
        foreach ($values as $key => &$val) {
            $child = new Kint_Object();
            $child->depth = $object->depth + 1;
            $child->owner_class = $object->classname;
            $child->operator = Kint_Object::OPERATOR_OBJECT;
            $child->access = Kint_Object::ACCESS_PUBLIC;
            $split_key = explode("\0", $key, 3);
            if (count($split_key) === 3 && $split_key[0] === '') {
                $child->name = $split_key[2];
                if ($split_key[1] === '*') {
                    $child->access = Kint_Object::ACCESS_PROTECTED;
                } else {
                    $child->access = Kint_Object::ACCESS_PRIVATE;
                    $child->owner_class = $split_key[1];
                }
            } elseif (KINT_PHP72) {
                $child->name = (string) $key;
            } else {
                $child->name = $key;
            } if ($this->childHasPath($object, $child)) {
                $child->access_path = $object->access_path;
                if (!KINT_PHP72 && is_int($child->name)) {
                    $child->access_path = 'array_values((array) ' . $child->access_path . ')[' . $i . ']';
                } elseif (preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $child->name)) {
                    $child->access_path .= '->' . $child->name;
                } else {
                    $child->access_path .= '->{' . var_export((string) $child->name, true) . '}';
                }
            } if (KINT_PHP522) {
                $stash = $val;
                $copy[$i] = $this->marker;
                if ($val === $this->marker) {
                    $child->reference = true;
                    $val = $stash;
                }
            } $rep->contents[] = $this->parse($val, $child);
            ++$i;
        } if (isset($ArrayObject_flags_stash)) {
            $var->setFlags($ArrayObject_flags_stash);
        } usort($rep->contents, array('Kint_Parser', 'sortObjectProperties'));
        $object->addRepresentation($rep);
        $this->applyPlugins($var, $object, self::TRIGGER_SUCCESS);
        unset($this->object_hashes[$hash]);
        return $object;
    }

    private function parseResource(&$var, Kint_Object $o) {
        $resource = $o->transplant(new Kint_Object_Resource());
        $resource->resource_type = get_resource_type($var);
        $this->applyPlugins($var, $resource, self::TRIGGER_SUCCESS);
        return $resource;
    }

    private function parseUnknown(&$var, Kint_Object $o) {
        $o->type = 'unknown';
        $this->applyPlugins($var, $o, self::TRIGGER_SUCCESS);
        return $o;
    }

    public function addPlugin(Kint_Parser_Plugin $p) {
        if (!$types = $p->getTypes()) {
            return false;
        } if (!$triggers = $p->getTriggers()) {
            return false;
        } $p->setParser($this);
        foreach ($types as $type) {
            if (!isset($this->plugins[$type])) {
                $this->plugins[$type] = array(self::TRIGGER_BEGIN => array(), self::TRIGGER_SUCCESS => array(), self::TRIGGER_RECURSION => array(), self::TRIGGER_DEPTH_LIMIT => array(),);
            } foreach ($this->plugins[$type] as $trigger => &$pool) {
                if ($triggers & $trigger) {
                    $pool[] = $p;
                }
            }
        } return true;
    }

    public function clearPlugins() {
        $this->plugins = array();
    }

    private function applyPlugins(&$var, Kint_Object &$o, $trigger) {
        $break_stash = $this->parse_break;
        $this->parse_break = false;
        $plugins = array();
        if (isset($this->plugins[$o->type][$trigger])) {
            $plugins = $this->plugins[$o->type][$trigger];
        } foreach ($plugins as $plugin) {
            try {
                $plugin->parse($var, $o, $trigger);
            } catch (Exception $e) {
                trigger_error('An exception (' . get_class($e) . ') was thrown in ' . $e->getFile() . ' on line ' . $e->getLine() . ' while executing Kint Parser Plugin "' . get_class($plugin) . '". Error message: ' . $e->getMessage(), E_USER_WARNING);
            } if ($this->parse_break) {
                $this->parse_break = $break_stash;
                return false;
            }
        } $this->parse_break = $break_stash;
        return true;
    }

    public function haltParse() {
        $this->parse_break = true;
    }

    public function childHasPath(Kint_Object_Instance $parent, Kint_Object $child)
    {
        if ($parent->type === 'object' && ($parent->access_path !== null || $child->static || $child->const)) {
            if ($child->access === Kint_Object::ACCESS_PUBLIC) {
                return true;
            } elseif ($child->access === Kint_Object::ACCESS_PRIVATE && $this->caller_class && $this->caller_class === $child->owner_class) {
                // We can't accurately determine owner class on statics / consts below 5.3 so deny
                // the access path just to be sure. See ClassStatics for more info
                if (KINT_PHP53 || (!$child->static && !$child->const)) {
                    return true;
                }
            } elseif ($child->access === Kint_Object::ACCESS_PROTECTED && $this->caller_class) {
                if ($this->caller_class === $child->owner_class) {
                    return true;
                }
                if (is_subclass_of($this->caller_class, $child->owner_class)) {
                    return true;
                }
                if (is_subclass_of($child->owner_class, $this->caller_class)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getCleanArray(array $array) {
        unset($array[$this->marker]);
        return $array;
    }

    private static function sortObjectProperties(Kint_Object $a, Kint_Object $b) {
        $sort = Kint_Object::sortByAccess($a, $b);
        if ($sort) {
            return $sort;
        } $sort = Kint_Object::sortByName($a, $b);
        if ($sort) {
            return $sort;
        } return Kint_Object_Instance::sortByHierarchy($a->owner_class, $b->owner_class);
    }

}

abstract class Kint_Renderer {

    protected $parameters;

    abstract public function render(Kint_Object $o);

    public function __construct(array $parameters) {
        $this->parameters = $parameters;
    }

    public function matchPlugins(array $plugins, array $hints) {
        $out = array();
        foreach ($hints as $key) {
            if (isset($plugins[$key])) {
                $out[$key] = $plugins[$key];
            }
        } return $out;
    }

    public function parserPlugins(array $plugins) {
        return $plugins;
    }

    public function preRender() {
        return '';
    }

    public function postRender() {
        return '';
    }

}

class Kint_SourceParser {

    private static $ignore = array(T_CLOSE_TAG => true, T_COMMENT => true, T_DOC_COMMENT => true, T_INLINE_HTML => true, T_OPEN_TAG => true, T_OPEN_TAG_WITH_ECHO => true, T_WHITESPACE => true,);
    private static $operator = array(T_AND_EQUAL => true, T_BOOLEAN_AND => true, T_BOOLEAN_OR => true, T_ARRAY_CAST => true, T_BOOL_CAST => true, T_CLONE => true, T_CONCAT_EQUAL => true, T_DEC => true, T_DIV_EQUAL => true, T_DOUBLE_CAST => true, T_INC => true, T_INCLUDE => true, T_INCLUDE_ONCE => true, T_INSTANCEOF => true, T_INT_CAST => true, T_IS_EQUAL => true, T_IS_GREATER_OR_EQUAL => true, T_IS_IDENTICAL => true, T_IS_NOT_EQUAL => true, T_IS_NOT_IDENTICAL => true, T_IS_SMALLER_OR_EQUAL => true, T_LOGICAL_AND => true, T_LOGICAL_OR => true, T_LOGICAL_XOR => true, T_MINUS_EQUAL => true, T_MOD_EQUAL => true, T_MUL_EQUAL => true, T_NEW => true, T_OBJECT_CAST => true, T_OR_EQUAL => true, T_PLUS_EQUAL => true, T_REQUIRE => true, T_REQUIRE_ONCE => true, T_SL => true, T_SL_EQUAL => true, T_SR => true, T_SR_EQUAL => true, T_STRING_CAST => true, T_UNSET_CAST => true, T_XOR_EQUAL => true, '!' => true, '%' => true, '&' => true, '*' => true, '+' => true, '-' => true, '.' => true, '/' => true, ':' => true, '<' => true, '=' => true, '>' => true, '?' => true, '^' => true, '|' => true, '~' => true,);
    private static $strip = array('(' => true, ')' => true, '[' => true, ']' => true, '{' => true, '}' => true, T_OBJECT_OPERATOR => true, T_DOUBLE_COLON => true,);

    public static function getFunctionCalls($source, $line, $function) {
        static $up = array('(' => true, '[' => true, '{' => true, T_CURLY_OPEN => true, T_DOLLAR_OPEN_CURLY_BRACES => true,);
        static $down = array(')' => true, ']' => true, '}' => true,);
        static $modifiers = array('!' => true, '@' => true, '~' => true, '+' => true, '-' => true,);
        if (KINT_PHP53) {
            self::$strip[T_NS_SEPARATOR] = true;
        } if (KINT_PHP56) {
            self::$operator[T_POW] = true;
            self::$operator[T_POW_EQUAL] = true;
        } if (KINT_PHP70) {
            self::$operator[T_SPACESHIP] = true;
        } $tokens = token_get_all($source);
        $cursor = 1;
        $function_calls = array();
        $prev_tokens = array(null, null, null);
        if (is_array($function)) {
            $class = explode('\\', $function[0]);
            $class = strtolower(end($class));
            $function = strtolower($function[1]);
        } else {
            $class = null;
            $function = strtolower($function);
        } foreach ($tokens as $index => $token) {
            if (!is_array($token)) {
                continue;
            } $cursor += substr_count($token[1], "\n");
            if ($cursor > $line) {
                break;
            } if (isset(self::$ignore[$token[0]])) {
                continue;
            } else {
                $prev_tokens = array($prev_tokens[1], $prev_tokens[2], $token);
            } if ($token[0] !== T_STRING || strtolower($token[1]) !== $function) {
                continue;
            } if ($tokens[self::realTokenIndex($tokens, $index, 1)] !== '(') {
                continue;
            } if ($class === null) {
                if ($prev_tokens[1] && in_array($prev_tokens[1][0], array(T_DOUBLE_COLON, T_OBJECT_OPERATOR))) {
                    continue;
                }
            } else {
                if (!$prev_tokens[1] || $prev_tokens[1][0] !== T_DOUBLE_COLON) {
                    continue;
                } if (!$prev_tokens[0] || $prev_tokens[0][0] !== T_STRING || strtolower($prev_tokens[0][1]) !== $class) {
                    continue;
                }
            } $inner_cursor = $cursor;
            $depth = 0;
            $offset = 1;
            $instring = false;
            $realtokens = false;
            $params = array();
            $shortparam = array();
            $param_start = 1;
            while (isset($tokens[$index + $offset])) {
                $token = $tokens[$index + $offset];
                if (is_array($token)) {
                    $inner_cursor += substr_count($token[1], "\n");
                } if (!isset(self::$ignore[$token[0]]) && !isset($down[$token[0]])) {
                    $realtokens = true;
                } if (isset($up[$token[0]])) {
                    if ($depth === 0) {
                        $param_start = $offset + 1;
                    } elseif ($depth === 1) {
                        $shortparam[] = $token;
                        $realtokens = false;
                    } ++$depth;
                } elseif (isset($down[$token[0]])) {
                    --$depth;
                    if ($depth === 1) {
                        if ($realtokens) {
                            $shortparam[] = '...';
                        } $shortparam[] = $token;
                    }
                } elseif ($token[0] === '"') {
                    if ($instring) {
                        --$depth;
                        if ($depth === 1) {
                            $shortparam[] = '...';
                        }
                    } else {
                        ++$depth;
                    } $instring = !$instring;
                    $shortparam[] = '"';
                } elseif ($depth === 1) {
                    if ($token[0] === ',') {
                        $params[] = array('full' => array_slice($tokens, $index + $param_start, $offset - $param_start), 'short' => $shortparam,);
                        $shortparam = array();
                        $param_start = $offset + 1;
                    } elseif ($token[0] === T_CONSTANT_ENCAPSED_STRING && strlen($token[1]) > 2) {
                        $shortparam[] = $token[1][0] . '...' . $token[1][0];
                    } else {
                        $shortparam[] = $token;
                    }
                } if ($depth <= 0) {
                    $params[] = array('full' => array_slice($tokens, $index + $param_start, $offset - $param_start), 'short' => $shortparam,);
                    break;
                } ++$offset;
            } if ($inner_cursor < $line) {
                continue;
            } foreach ($params as &$param) {
                $name = self::tokensFormatted($param['short']);
                $expression = false;
                foreach ($name as $token) {
                    if (self::tokenIsOperator($token)) {
                        $expression = true;
                        break;
                    }
                } $param = array('name' => self::tokensToString($name), 'path' => self::tokensToString(self::tokensTrim($param['full'])), 'expression' => $expression,);
            } $mods = array();
            --$index;
            while (isset($tokens[$index])) {
                if (isset(self::$ignore[$tokens[$index][0]])) {
                    --$index;
                    continue;
                } elseif (is_array($tokens[$index]) && empty($mods)) {
                    if ($tokens[$index][0] === T_DOUBLE_COLON || $tokens[$index][0] === T_STRING || (KINT_PHP53 && $tokens[$index][0] === T_NS_SEPARATOR)) {
                        --$index;
                        continue;
                    } else {
                        break;
                    }
                } elseif (isset($modifiers[$tokens[$index][0]])) {
                    $mods[] = $tokens[$index];
                    --$index;
                    continue;
                } else {
                    break;
                }
            } $function_calls[] = array('parameters' => $params, 'modifiers' => $mods,);
        } return $function_calls;
    }

    private static function realTokenIndex(array $tokens, $index, $direction) {
        $index += $direction;
        while (isset($tokens[$index])) {
            if (!isset(self::$ignore[$tokens[$index][0]])) {
                return $index;
            } $index += $direction;
        } return null;
    }

    private static function tokenIsOperator($token) {
        return $token !== '...' && isset(self::$operator[$token[0]]);
    }

    private static function tokensToString(array $tokens) {
        $out = '';
        foreach ($tokens as $token) {
            if (is_string($token)) {
                $out .= $token;
            } elseif (is_array($token)) {
                $out .= $token[1];
            }
        } return $out;
    }

    private static function tokensTrim(array $tokens) {
        foreach ($tokens as $index => $token) {
            if (isset(self::$ignore[$token[0]])) {
                unset($tokens[$index]);
            } else {
                break;
            }
        } $tokens = array_reverse($tokens);
        foreach ($tokens as $index => $token) {
            if (isset(self::$ignore[$token[0]])) {
                unset($tokens[$index]);
            } else {
                break;
            }
        } return array_reverse($tokens);
    }

    private static function tokensFormatted(array $tokens) {
        $space = false;
        $tokens = self::tokensTrim($tokens);
        $output = array();
        $last = null;
        foreach ($tokens as $index => $token) {
            if (isset(self::$ignore[$token[0]])) {
                if ($space) {
                    continue;
                } $next = $tokens[self::realTokenIndex($tokens, $index, 1)];
                if (isset(self::$strip[$last[0]]) && !self::tokenIsOperator($next)) {
                    continue;
                } elseif (isset(self::$strip[$next[0]]) && $last && !self::tokenIsOperator($last)) {
                    continue;
                } $token = ' ';
                $space = true;
            } else {
                $space = false;
                $last = $token;
            } $output[] = $token;
        } return $output;
    }

}

class Kint_Object_Blob extends Kint_Object {

    public static $char_encodings = array('ASCII', 'UTF-8',);
    public $type = 'string';
    public $encoding = false;
    public $hints = array('string');

    public function getType() {
        if ($this->encoding === false) {
            return 'binary ' . $this->type;
        } elseif ($this->encoding === 'ASCII') {
            return $this->type;
        } else {
            return $this->encoding . ' ' . $this->type;
        }
    }

    public function getValueShort() {
        if ($rep = $this->value) {
            return '"' . $rep->contents . '"';
        }
    }

    public function transplant(Kint_Object $new) {
        $new = parent::transplant($new);
        $new->encoding = $this->encoding;
        return $new;
    }

    public static function strlen($string, $encoding = false) {
        if (extension_loaded('mbstring')) {
            if ($encoding === false) {
                $encoding = self::detectEncoding($string);
            } if ($encoding && $encoding !== 'ASCII') {
                return mb_strlen($string, $encoding);
            }
        } return strlen($string);
    }

    public static function substr($string, $start, $length = null, $encoding = false) {
        if (extension_loaded('mbstring')) {
            if ($encoding === false) {
                $encoding = self::detectEncoding($string);
            } if ($encoding && $encoding !== 'ASCII') {
                return mb_substr($string, $start, $length, $encoding);
            }
        } return substr($string, $start, isset($length) ? $length : PHP_INT_MAX);
    }

    public static function detectEncoding($string) {
        if (extension_loaded('mbstring')) {
            if ($ret = mb_detect_encoding($string, array_diff(self::$char_encodings, array('Windows-1252')), true)) {
                return $ret;
            } elseif (!in_array('Windows-1252', self::$char_encodings) || preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x81\x8D\x8F\x90\x9D]/', $string)) {
                return false;
            } else {
                return 'Windows-1252';
            }
        } if (!extension_loaded('iconv')) {
            return 'UTF-8';
        } $md5 = md5($string);
        foreach (self::$char_encodings as $encoding) {
            if (md5(@iconv($encoding, $encoding, $string)) === $md5) {
                return $encoding;
            }
        } return false;
    }

    public static function escape($string, $encoding = false) {
        static $show_dep = true;
        if ($show_dep) {
            trigger_error('Kint_Object_Blob::escape() is deprecated and will be removed in Kint 3.0. Use renderer-specific escape methods instead.', KINT_PHP53 ? E_USER_DEPRECATED : E_USER_NOTICE);
            $show_dep = false;
        } if (empty($string)) {
            return $string;
        } if (Kint::$enabled_mode === Kint::MODE_TEXT) {
            return $string;
        } if (Kint::$enabled_mode === Kint::MODE_CLI) {
            return str_replace("\x1b", '\\x1b', $string);
        } if ($encoding === false) {
            $encoding = self::detectEncoding($string);
        } $original_encoding = $encoding;
        if ($encoding === false || $encoding === 'ASCII') {
            $encoding = 'UTF-8';
        } $string = htmlspecialchars($string, ENT_NOQUOTES, $encoding);
        if ($original_encoding !== 'ASCII' && function_exists('mb_encode_numericentity')) {
            $string = mb_encode_numericentity($string, array(0x80, 0xffff, 0, 0xffff), $encoding);
        } return $string;
    }

}

class Kint_Object_Closure extends Kint_Object_Instance {

    public $parameters = array();
    public $hints = array('object', 'callable', 'closure');
    private $paramcache = null;

    public function getAccessPath() {
        if ($this->access_path !== null) {
            return parent::getAccessPath() . '(' . $this->getParams() . ')';
        }
    }

    public function getSize() {

    }

    public function getParams() {
        if ($this->paramcache !== null) {
            return $this->paramcache;
        } $out = array();
        foreach ($this->parameters as $p) {
            $type = $p->getType();
            $ref = $p->reference ? '&' : '';
            if ($type) {
                $out[] = $type . ' ' . $ref . $p->getName();
            } else {
                $out[] = $ref . $p->getName();
            }
        } return $this->paramcache = implode(', ', $out);
    }

}

class Kint_Object_Color extends Kint_Object_Blob {

    public static $color_map = array('aliceblue' => 'f0f8ff', 'antiquewhite' => 'faebd7', 'aqua' => '00ffff', 'aquamarine' => '7fffd4', 'azure' => 'f0ffff', 'beige' => 'f5f5dc', 'bisque' => 'ffe4c4', 'black' => '000000', 'blanchedalmond' => 'ffebcd', 'blue' => '0000ff', 'blueviolet' => '8a2be2', 'brown' => 'a52a2a', 'burlywood' => 'deb887', 'cadetblue' => '5f9ea0', 'chartreuse' => '7fff00', 'chocolate' => 'd2691e', 'coral' => 'ff7f50', 'cornflowerblue' => '6495ed', 'cornsilk' => 'fff8dc', 'crimson' => 'dc143c', 'cyan' => '00ffff', 'darkblue' => '00008b', 'darkcyan' => '008b8b', 'darkgoldenrod' => 'b8860b', 'darkgray' => 'a9a9a9', 'darkgreen' => '006400', 'darkgrey' => 'a9a9a9', 'darkkhaki' => 'bdb76b', 'darkmagenta' => '8b008b', 'darkolivegreen' => '556b2f', 'darkorange' => 'ff8c00', 'darkorchid' => '9932cc', 'darkred' => '8b0000', 'darksalmon' => 'e9967a', 'darkseagreen' => '8fbc8f', 'darkslateblue' => '483d8b', 'darkslategray' => '2f4f4f', 'darkslategrey' => '2f4f4f', 'darkturquoise' => '00ced1', 'darkviolet' => '9400d3', 'deeppink' => 'ff1493', 'deepskyblue' => '00bfff', 'dimgray' => '696969', 'dimgrey' => '696969', 'dodgerblue' => '1e90ff', 'firebrick' => 'b22222', 'floralwhite' => 'fffaf0', 'forestgreen' => '228b22', 'fuchsia' => 'ff00ff', 'gainsboro' => 'dcdcdc', 'ghostwhite' => 'f8f8ff', 'gold' => 'ffd700', 'goldenrod' => 'daa520', 'gray' => '808080', 'green' => '008000', 'greenyellow' => 'adff2f', 'grey' => '808080', 'honeydew' => 'f0fff0', 'hotpink' => 'ff69b4', 'indianred' => 'cd5c5c', 'indigo' => '4b0082', 'ivory' => 'fffff0', 'khaki' => 'f0e68c', 'lavender' => 'e6e6fa', 'lavenderblush' => 'fff0f5', 'lawngreen' => '7cfc00', 'lemonchiffon' => 'fffacd', 'lightblue' => 'add8e6', 'lightcoral' => 'f08080', 'lightcyan' => 'e0ffff', 'lightgoldenrodyellow' => 'fafad2', 'lightgray' => 'd3d3d3', 'lightgreen' => '90ee90', 'lightgrey' => 'd3d3d3', 'lightpink' => 'ffb6c1', 'lightsalmon' => 'ffa07a', 'lightseagreen' => '20b2aa', 'lightskyblue' => '87cefa', 'lightslategray' => '778899', 'lightslategrey' => '778899', 'lightsteelblue' => 'b0c4de', 'lightyellow' => 'ffffe0', 'lime' => '00ff00', 'limegreen' => '32cd32', 'linen' => 'faf0e6', 'magenta' => 'ff00ff', 'maroon' => '800000', 'mediumaquamarine' => '66cdaa', 'mediumblue' => '0000cd', 'mediumorchid' => 'ba55d3', 'mediumpurple' => '9370db', 'mediumseagreen' => '3cb371', 'mediumslateblue' => '7b68ee', 'mediumspringgreen' => '00fa9a', 'mediumturquoise' => '48d1cc', 'mediumvioletred' => 'c71585', 'midnightblue' => '191970', 'mintcream' => 'f5fffa', 'mistyrose' => 'ffe4e1', 'moccasin' => 'ffe4b5', 'navajowhite' => 'ffdead', 'navy' => '000080', 'oldlace' => 'fdf5e6', 'olive' => '808000', 'olivedrab' => '6b8e23', 'orange' => 'ffa500', 'orangered' => 'ff4500', 'orchid' => 'da70d6', 'palegoldenrod' => 'eee8aa', 'palegreen' => '98fb98', 'paleturquoise' => 'afeeee', 'palevioletred' => 'db7093', 'papayawhip' => 'ffefd5', 'peachpuff' => 'ffdab9', 'peru' => 'cd853f', 'pink' => 'ffc0cb', 'plum' => 'dda0dd', 'powderblue' => 'b0e0e6', 'purple' => '800080', 'rebeccapurple' => '663399', 'red' => 'ff0000', 'rosybrown' => 'bc8f8f', 'royalblue' => '4169e1', 'saddlebrown' => '8b4513', 'salmon' => 'fa8072', 'sandybrown' => 'f4a460', 'seagreen' => '2e8b57', 'seashell' => 'fff5ee', 'sienna' => 'a0522d', 'silver' => 'c0c0c0', 'skyblue' => '87ceeb', 'slateblue' => '6a5acd', 'slategray' => '708090', 'slategrey' => '708090', 'snow' => 'fffafa', 'springgreen' => '00ff7f', 'steelblue' => '4682b4', 'tan' => 'd2b48c', 'teal' => '008080', 'thistle' => 'd8bfd8', 'tomato' => 'ff6347', 'turquoise' => '40e0d0', 'violet' => 'ee82ee', 'wheat' => 'f5deb3', 'white' => 'ffffff', 'whitesmoke' => 'f5f5f5', 'yellow' => 'ffff00', 'yellowgreen' => '9acd32',);
    public $hints = array('color');
    public $color = null;

    public function __construct($color) {
        $this->color = $color;
    }

    public static function hslToRgb($hue, $saturation, $lightness) {
        $hue /= 360;
        $saturation /= 100;
        $lightness /= 100;
        $m2 = ($lightness <= 0.5) ? $lightness * ($saturation + 1) : $lightness + $saturation - $lightness * $saturation;
        $m1 = $lightness * 2 - $m2;
        $out = array(round(self::hueToRgb($m1, $m2, $hue + 1 / 3) * 255), round(self::hueToRgb($m1, $m2, $hue) * 255), round(self::hueToRgb($m1, $m2, $hue - 1 / 3) * 255),);
        if (max($out) > 255) {
            return;
        } else {
            return $out;
        }
    }

    private static function hueToRgb($m1, $m2, $hue) {
        $hue = ($hue < 0) ? $hue + 1 : (($hue > 1) ? $hue - 1 : $hue);
        if ($hue * 6 < 1) {
            return $m1 + ($m2 - $m1) * $hue * 6;
        } if ($hue * 2 < 1) {
            return $m2;
        } if ($hue * 3 < 2) {
            return $m1 + ($m2 - $m1) * (0.66666 - $hue) * 6;
        } return $m1;
    }

    public static function rgbToHsl($red, $green, $blue) {
        $clrMin = min($red, $green, $blue);
        $clrMax = max($red, $green, $blue);
        $deltaMax = $clrMax - $clrMin;
        $L = ($clrMax + $clrMin) / 510;
        if (0 == $deltaMax) {
            $H = 0;
            $S = 0;
        } else {
            if (0.5 > $L) {
                $S = $deltaMax / ($clrMax + $clrMin);
            } else {
                $S = $deltaMax / (510 - $clrMax - $clrMin);
            } if ($clrMax == $red) {
                $H = ($green - $blue) / (6.0 * $deltaMax);
            } elseif ($clrMax == $green) {
                $H = 1 / 3 + ($blue - $red) / (6.0 * $deltaMax);
            } else {
                $H = 2 / 3 + ($red - $green) / (6.0 * $deltaMax);
            } if (0 > $H) {
                $H += 1;
            } if (1 < $H) {
                $H -= 1;
            }
        } return array((round($H * 360) % 360 + 360) % 360, round($S * 100), round($L * 100),);
    }

}

class Kint_Object_DateTime extends Kint_Object_Instance {

    public $dt;
    public $hints = array('object', 'datetime');

    public function __construct(DateTime $dt) {
        $this->dt = clone $dt;
    }

    public function getValueShort() {
        $stamp = $this->dt->format('Y-m-d H:i:s');
        if (KINT_PHP522 && intval($micro = $this->dt->format('u'))) {
            $stamp .= '.' . $micro;
        } $stamp .= $this->dt->format('P T');
        return $stamp;
    }

}

class Kint_Object_Instance extends Kint_Object {

    public $type = 'object';
    public $classname;
    public $hash;
    public $filename;
    public $startline;
    public $hints = array('object');

    public static function sortByHierarchy($a, $b) {
        if (is_string($a) && is_string($b)) {
            $aclass = $a;
            $bclass = $b;
        } elseif (!($a instanceof Kint_Object) || !($b instanceof Kint_Object)) {
            return 0;
        } elseif ($a->type === 'object' && $b->type === 'object') {
            $aclass = $a->classname;
            $bclass = $b->classname;
        } if (is_subclass_of($aclass, $bclass)) {
            return -1;
        } if (is_subclass_of($bclass, $aclass)) {
            return 1;
        } return 0;
    }

    public function transplant(Kint_Object $new) {
        $new = parent::transplant($new);
        $new->classname = $this->classname;
        $new->hash = $this->hash;
        $new->filename = $this->filename;
        $new->startline = $this->startline;
        return $new;
    }

    public function getType() {
        return $this->classname;
    }

}

class Kint_Object_Method extends Kint_Object {

    public $type = 'method';
    public $filename;
    public $startline;
    public $endline;
    public $parameters = array();
    public $abstract;
    public $final;
    public $internal;
    public $returntype = null;
    public $hints = array('callable', 'method');
    public $showparams = true;
    private $paramcache = null;
    private $docstring;

    public function __construct($method) {
        if (!($method instanceof ReflectionMethod) && !($method instanceof ReflectionFunction)) {
            throw new InvalidArgumentException('Argument must be an instance of ReflectionFunctionAbstract');
        } $this->name = $method->getName();
        $this->filename = $method->getFilename();
        $this->startline = $method->getStartLine();
        $this->endline = $method->getEndLine();
        $this->internal = $method->isInternal();
        $this->docstring = $method->getDocComment();
        foreach ($method->getParameters() as $param) {
            $this->parameters[] = new Kint_Object_Parameter($param);
        } if (KINT_PHP70) {
            $this->returntype = $method->getReturnType();
            if ($this->returntype) {
                if (method_exists($this->returntype, 'getName')) {
                    $this->returntype = $this->returntype->getName();
                } else {
                    $this->returntype = (string)$this->returntype;
                }
            }
        } if (!$this->returntype && $this->docstring) {
            if (preg_match('/@return\s+(.*)\r?\n/m', $this->docstring, $matches)) {
                if (!empty($matches[1])) {
                    $this->returntype = $matches[1];
                }
            }
        } if ($method instanceof ReflectionMethod) {
            $this->static = $method->isStatic();
            $this->operator = $this->static ? Kint_Object::OPERATOR_STATIC : Kint_Object::OPERATOR_OBJECT;
            $this->abstract = $method->isAbstract();
            $this->final = $method->isFinal();
            $this->owner_class = $method->getDeclaringClass()->name;
            $this->access = Kint_Object::ACCESS_PUBLIC;
            if ($method->isProtected()) {
                $this->access = Kint_Object::ACCESS_PROTECTED;
            } elseif ($method->isPrivate()) {
                $this->access = Kint_Object::ACCESS_PRIVATE;
            }
        } $docstring = new Kint_Object_Representation_Docstring($this->docstring, $this->filename, $this->startline);
        $docstring->implicit_label = true;
        $this->addRepresentation($docstring);
    }

    public function setAccessPathFrom(Kint_Object_Instance $parent) {
        static $magic = array('__call' => true, '__callstatic' => true, '__clone' => true, '__construct' => true, '__debuginfo' => true, '__destruct' => true, '__get' => true, '__invoke' => true, '__isset' => true, '__set' => true, '__set_state' => true, '__sleep' => true, '__tostring' => true, '__unset' => true, '__wakeup' => true,);
        $name = strtolower($this->name);
        if ($name === '__construct') {
            if (KINT_PHP53) {
                $this->access_path = 'new \\' . $parent->getType();
            } else {
                $this->access_path = 'new ' . $parent->getType();
            }
        } elseif ($name === '__invoke') {
            $this->access_path = $parent->access_path;
        } elseif ($name === '__clone') {
            $this->access_path = 'clone ' . $parent->access_path;
            $this->showparams = false;
        } elseif ($name === '__tostring') {
            $this->access_path = '(string) ' . $parent->access_path;
            $this->showparams = false;
        } elseif (isset($magic[$name])) {
            $this->access_path = null;
        } elseif ($this->static) {
            if (KINT_PHP53) {
                $this->access_path = '\\' . $this->owner_class . '::' . $this->name;
            } else {
                $this->access_path = $this->owner_class . '::' . $this->name;
            }
        } else {
            $this->access_path = $parent->access_path . '->' . $this->name;
        }
    }

    public function getValueShort() {
        if (!$this->value || !($this->value instanceof Kint_Object_Representation_Docstring)) {
            return parent::getValueShort();
        } $ds = explode("\n", $this->value->docstringWithoutComments());
        $out = '';
        foreach ($ds as $line) {
            if (strlen(trim($line)) === 0 || $line[0] === '@') {
                break;
            } $out .= $line . ' ';
        } if (strlen($out)) {
            return rtrim($out);
        }
    }

    public function getModifiers() {
        $mods = array($this->abstract ? 'abstract' : null, $this->final ? 'final' : null, $this->getAccess(), $this->static ? 'static' : null,);
        $out = '';
        foreach ($mods as $word) {
            if ($word !== null) {
                $out .= $word . ' ';
            }
        } if (strlen($out)) {
            return rtrim($out);
        }
    }

    public function getAccessPath() {
        if ($this->access_path !== null) {
            if ($this->showparams) {
                return parent::getAccessPath() . '(' . $this->getParams() . ')';
            } else {
                return parent::getAccessPath();
            }
        }
    }

    public function getParams() {
        if ($this->paramcache !== null) {
            return $this->paramcache;
        } $out = array();
        foreach ($this->parameters as $p) {
            $type = $p->getType();
            if ($type) {
                $type .= ' ';
            } $default = $p->getDefault();
            if ($default) {
                $default = ' = ' . $default;
            } $ref = $p->reference ? '&' : '';
            $out[] = $type . $ref . $p->getName() . $default;
        } return $this->paramcache = implode(', ', $out);
    }

    public function getPhpDocUrl() {
        if (!$this->internal) {
            return null;
        } if ($this->owner_class) {
            $class = strtolower($this->owner_class);
        } else {
            $class = 'function';
        } $funcname = str_replace('_', '-', strtolower($this->name));
        if (strpos($funcname, '--') === 0 && strpos($funcname, '-', 2) !== 0) {
            $funcname = substr($funcname, 2);
        } return 'https://secure.php.net/' . $class . '.' . $funcname;
    }

}

class Kint_Object_Nothing extends Kint_Object {

    public $hints = array('nothing');

}

class Kint_Object_Parameter extends Kint_Object {

    public $type_hint = null;
    public $default = null;
    public $position = null;
    public $hints = array('parameter');

    public function getType() {
        return $this->type_hint;
    }

    public function getName() {
        return '$' . $this->name;
    }

    public function __construct(ReflectionParameter $param) {
        if (method_exists('ReflectionParameter', 'getType')) {
            if ($type = $param->getType()) {
                if (method_exists($type, 'getName')) {
                    $this->type_hint = $type->getName();
                } else {
                    $this->type_hint = (string)$type;
                }
            }
        } else {
            if ($param->isArray()) {
                $this->type_hint = 'array';
            } else {
                try {
                    if ($this->type_hint = $param->getClass()) {
                        $this->type_hint = $this->type_hint->name;
                    }
                } catch (ReflectionException $e) {
                    preg_match('/\[\s\<\w+?>\s([\w]+)/s', $param->__toString(), $matches);
                    $this->type_hint = isset($matches[1]) ? $matches[1] : '';
                }
            }
        } $this->reference = $param->isPassedByReference();
        $this->name = $param->getName();
        if (KINT_PHP523) {
            $this->position = $param->getPosition();
        } if ($param->isDefaultValueAvailable()) {
            $default = $param->getDefaultValue();
            switch (gettype($default)) {
                case 'NULL': $this->default = 'null';
                    break;
                case 'boolean': $this->default = $default ? 'true' : 'false';
                    break;
                case 'array': $this->default = count($default) ? 'array(...)' : 'array()';
                    break;
                default: $this->default = var_export($default, true);
                    break;
            }
        }
    }

    public function getDefault() {
        return $this->default;
    }

}

class Kint_Object_Representation {

    public $name;
    public $label;
    public $implicit_label = false;
    public $hints = array();
    public $contents = array();

    public function __construct($label, $name = null) {
        $this->label = $label;
        if ($name === null) {
            $name = preg_replace('/[^a-z0-9]+/', '_', strtolower($label));
        } $this->name = $name;
    }

    public function getLabel() {
        if (is_array($this->contents) && count($this->contents) > 1) {
            return $this->label . ' (' . count($this->contents) . ')';
        } else {
            return $this->label;
        }
    }

    public function labelIsImplicit() {
        return $this->implicit_label;
    }

}

class Kint_Object_Resource extends Kint_Object {

    public $resource_type = null;

    public function getType() {
        if ($this->resource_type) {
            return $this->resource_type . ' resource';
        } else {
            return 'resource';
        }
    }

    public function transplant(Kint_Object $new) {
        $new = parent::transplant($new);
        $new->resource_type = $this->resource_type;
        return $new;
    }

}

class Kint_Object_Stream extends Kint_Object_Resource {

    public $stream_meta = null;

    public function __construct(array $meta = null) {
        parent::__construct();
        $this->stream_meta = $meta;
    }

    public function getValueShort() {
        if (empty($this->stream_meta['uri'])) {
            return;
        } $uri = $this->stream_meta['uri'];
        if (KINT_PHP524 && stream_is_local($uri)) {
            return Kint::shortenPath($uri);
        } else {
            return $uri;
        }
    }

}

class Kint_Object_Throwable extends Kint_Object_Instance {

    public $message;
    public $hints = array('object', 'throwable');

    public function __construct($throw) {
        if (!$throw instanceof Exception && (!KINT_PHP70 || !$throw instanceof Throwable)) {
            throw new InvalidArgumentException('Kint_Object_Throwable must be constructed with an Exception or a Throwable');
        } $this->message = $throw->getMessage();
    }

    public function getValueShort() {
        if (strlen($this->message)) {
            return '"' . $this->message . '"';
        }
    }

}

class Kint_Object_Trace extends Kint_Object {

    public $hints = array('trace');

    public function getType() {
        return 'Debug Backtrace';
    }

    public function getSize() {
        if (!$this->size) {
            return 'empty';
        } return parent::getSize();
    }

}

class Kint_Object_TraceFrame extends Kint_Object {

    public $trace;
    public $hints = array('trace_frame');

    public function assignFrame(array &$frame) {
        $this->trace = array('function' => isset($frame['function']) ? $frame['function'] : null, 'line' => isset($frame['line']) ? $frame['line'] : null, 'file' => isset($frame['file']) ? $frame['file'] : null, 'class' => isset($frame['class']) ? $frame['class'] : null, 'type' => isset($frame['type']) ? $frame['type'] : null, 'object' => null, 'args' => null,);
        if ($this->trace['class'] && method_exists($this->trace['class'], $this->trace['function'])) {
            $func = new ReflectionMethod($this->trace['class'], $this->trace['function']);
            $this->trace['function'] = new Kint_Object_Method($func);
        } elseif (!$this->trace['class'] && function_exists($this->trace['function'])) {
            $func = new ReflectionFunction($this->trace['function']);
            $this->trace['function'] = new Kint_Object_Method($func);
        } foreach ($this->value->contents as $frame_prop) {
            if ($frame_prop->name === 'object') {
                $this->trace['object'] = $frame_prop;
                $this->trace['object']->name = null;
                $this->trace['object']->operator = Kint_Object::OPERATOR_NONE;
            } if ($frame_prop->name === 'args') {
                $this->trace['args'] = $frame_prop->value->contents;
                if (is_object($this->trace['function'])) {
                    foreach (array_values($this->trace['function']->parameters) as $param) {
                        if (isset($this->trace['args'][$param->position])) {
                            $this->trace['args'][$param->position]->name = $param->getName();
                        }
                    }
                }
            }
        } $this->clearRepresentations();
        if (isset($this->trace['file'], $this->trace['line']) && is_readable($this->trace['file'])) {
            $this->addRepresentation(new Kint_Object_Representation_Source($this->trace['file'], $this->trace['line']));
        } if ($this->trace['args']) {
            $args = new Kint_Object_Representation('Arguments');
            $args->contents = $this->trace['args'];
            $this->addRepresentation($args);
        } if ($this->trace['object']) {
            $callee = new Kint_Object_Representation('object');
            $callee->label = 'Callee object [' . $this->trace['object']->classname . ']';
            $callee->contents[] = $this->trace['object'];
            $this->addRepresentation($callee);
        }
    }

}

class Kint_Object_Representation_Color extends Kint_Object_Representation {

    public $r = 0;
    public $g = 0;
    public $b = 0;
    public $a = 1;
    public $variant = null;
    public $implicit_label = true;
    public $hints = array('color');

    const COLOR_NAME = 1;
    const COLOR_HEX_3 = 2;
    const COLOR_HEX_6 = 3;
    const COLOR_RGB = 4;
    const COLOR_RGBA = 5;
    const COLOR_HSL = 6;
    const COLOR_HSLA = 7;
    const COLOR_HEX_4 = 8;
    const COLOR_HEX_8 = 9;

    public function getColor($variant = null) {
        switch ($variant) {
            case self::COLOR_NAME: $hex = sprintf('%02x%02x%02x', $this->r, $this->g, $this->b);
                return array_search($hex, Kint_Object_Color::$color_map);
            case self::COLOR_HEX_3: if ($this->r % 0x11 === 0 && $this->g % 0x11 === 0 && $this->b % 0x11 === 0) {
                return sprintf('#%1X%1X%1X', round($this->r / 0x11), round($this->g / 0x11), round($this->b / 0x11));
            } else {
                return false;
            } case self::COLOR_HEX_6: return sprintf('#%02X%02X%02X', $this->r, $this->g, $this->b);
            case self::COLOR_RGB: return sprintf('rgb(%d, %d, %d)', $this->r, $this->g, $this->b);
            case self::COLOR_RGBA: return sprintf('rgba(%d, %d, %d, %s)', $this->r, $this->g, $this->b, round($this->a, 4));
            case self::COLOR_HSL: $val = Kint_Object_Color::rgbToHsl($this->r, $this->g, $this->b);
                return vsprintf('hsl(%d, %d%%, %d%%)', $val);
            case self::COLOR_HSLA: $val = Kint_Object_Color::rgbToHsl($this->r, $this->g, $this->b);
                return sprintf('hsla(%d, %d%%, %d%%, %s)', $val[0], $val[1], $val[2], round($this->a, 4));
            case self::COLOR_HEX_4: if ($this->r % 0x11 === 0 && $this->g % 0x11 === 0 && $this->b % 0x11 === 0 && ($this->a * 255) % 0x11 === 0) {
                return sprintf('#%1X%1X%1X%1X', round($this->r / 0x11), round($this->g / 0x11), round($this->b / 0x11), round($this->a * 0xF));
            } else {
                return false;
            } case self::COLOR_HEX_8: return sprintf('#%02X%02X%02X%02X', $this->r, $this->g, $this->b, round($this->a * 0xFF));
            case null: return $this->contents;
        } return false;
    }

    public function __construct($value) {
        parent::__construct('Color');
        $this->contents = $value;
        $this->setValues($value);
    }

    public function hasAlpha($variant = null) {
        if ($variant === null) {
            $variant = $this->variant;
        } switch ($variant) {
            case self::COLOR_NAME: return $this->a !== 1;
            case self::COLOR_RGBA: case self::COLOR_HSLA: case self::COLOR_HEX_4: case self::COLOR_HEX_8: return true;
            default: return false;
        }
    }

    protected function setValues($value) {
        $value = strtolower(trim($value));
        if (isset(Kint_Object_Color::$color_map[$value])) {
            $variant = self::COLOR_NAME;
        } elseif (substr($value, 0, 1) === '#') {
            $value = substr($value, 1);
            if (dechex(hexdec($value)) !== $value) {
                return;
            } switch (strlen($value)) {
                case 3: $variant = self::COLOR_HEX_3;
                    break;
                case 6: $variant = self::COLOR_HEX_6;
                    break;
                case 4: $variant = self::COLOR_HEX_4;
                    break;
                case 8: $variant = self::COLOR_HEX_8;
                    break;
            }
        } else {
            if (!preg_match('/^((?:rgb|hsl)a?)\s*\(([0-9\.%,\s]+)\)$/i', $value, $match)) {
                return;
            } switch ($match[1]) {
                case 'rgb': $variant = self::COLOR_RGB;
                    break;
                case 'rgba': $variant = self::COLOR_RGBA;
                    break;
                case 'hsl': $variant = self::COLOR_HSL;
                    break;
                case 'hsla': $variant = self::COLOR_HSLA;
                    break;
            } $value = explode(',', $match[2]);
            if ($this->hasAlpha($variant)) {
                if (count($value) !== 4) {
                    return;
                }
            } elseif (count($value) !== 3) {
                return;
            } foreach ($value as $i => &$color) {
                $color = trim($color);
                if (strpos($color, '%') !== false) {
                    $color = str_replace('%', '', $color);
                    if ($i === 3) {
                        $color = $color / 100;
                    } elseif (in_array($variant, array(self::COLOR_RGB, self::COLOR_RGBA))) {
                        $color = round($color / 100 * 255);
                    } elseif ($i === 0 && in_array($variant, array(self::COLOR_HSL, self::COLOR_HSLA))) {
                        $color = $color / 100 * 360;
                    }
                } if ($i === 0 && in_array($variant, array(self::COLOR_HSL, self::COLOR_HSLA))) {
                    $color = ($color % 360 + 360) % 360;
                }
            }
        } switch ($variant) {
            case self::COLOR_HEX_4: $this->a = hexdec($value[3]) / 0xF;
            case self::COLOR_HEX_3: $this->r = hexdec($value[0]) * 0x11;
                $this->g = hexdec($value[1]) * 0x11;
                $this->b = hexdec($value[2]) * 0x11;
                break;
            case self::COLOR_NAME: $value = Kint_Object_Color::$color_map[$value] . 'FF';
            case self::COLOR_HEX_8: $this->a = hexdec(substr($value, 6, 2)) / 0xFF;
            case self::COLOR_HEX_6: $value = str_split($value, 2);
                $this->r = hexdec($value[0]);
                $this->g = hexdec($value[1]);
                $this->b = hexdec($value[2]);
                break;
            case self::COLOR_RGBA: $this->a = $value[3];
            case self::COLOR_RGB: list($this->r, $this->g, $this->b) = $value;
                break;
            case self::COLOR_HSLA: $this->a = $value[3];
            case self::COLOR_HSL: $value = Kint_Object_Color::hslToRgb($value[0], $value[1], $value[2]);
                list($this->r, $this->g, $this->b) = $value;
                break;
        } if ($this->r > 0xFF || $this->g > 0xFF || $this->b > 0xFF || $this->a > 1) {
            $this->variant = null;
        } else {
            $this->variant = $variant;
        }
    }

}

class Kint_Object_Representation_Docstring extends Kint_Object_Representation {

    public $file = null;
    public $line = null;
    public $class = null;
    public $hints = array('docstring');

    public function __construct($docstring, $file, $line, $class = null) {
        parent::__construct('Docstring');
        $this->file = $file;
        $this->line = $line;
        $this->class = $class;
        $this->contents = $docstring;
    }

    public function docstringWithoutComments() {
        if (!$this->contents) {
            return '';
        } $string = substr($this->contents, 3, -2);
        $string = preg_replace('/^\s*\*\s*?(\S|$)/m', '\1', $string);
        return trim($string);
    }

}

class Kint_Object_Representation_Microtime extends Kint_Object_Representation {

    public $group = null;
    public $lap = null;
    public $total = null;
    public $avg = null;
    public $i = 0;
    public $mem = 0;
    public $mem_real = 0;
    public $mem_peak = null;
    public $mem_peak_real = null;
    public $hints = array('microtime');

    public function __construct($group, $lap = null, $total = null, $i = 0) {
        parent::__construct('Microtime');
        $this->group = $group;
        $this->lap = $lap;
        $this->total = $total;
        $this->i = $i;
        if ($i) {
            $this->avg = $total / $i;
        } $this->mem = memory_get_usage();
        $this->mem_real = memory_get_usage(true);
        if (KINT_PHP52) {
            $this->mem_peak = memory_get_peak_usage();
            $this->mem_peak_real = memory_get_peak_usage(true);
        }
    }

}

class Kint_Object_Representation_Source extends Kint_Object_Representation {

    public $name = 'source';
    public $label = 'Source';
    public $hints = array('source');
    public $source = array();
    public $filename = null;
    public $line = 0;

    public function __construct($filename, $line, $padding = 7) {
        $this->filename = $filename;
        $this->line = $line;
        $start_line = max($line - $padding, 1);
        $length = $line + $padding + 1 - $start_line;
        $this->source = self::getSource($filename, $start_line, $length);
        if ($this->source !== false) {
            $this->contents = implode("\n", $this->source);
        }
    }

    public static function getSource($filename, $start_line = 1, $length = null) {
        if (!$filename or ! is_readable($filename)) {
            return false;
        } $source = preg_split("/\r\n|\n|\r/", file_get_contents($filename));
        $source = array_combine(range(1, count($source)), $source);
        $source = array_slice($source, $start_line - 1, $length, true);
        return $source;
    }

}

class Kint_Object_Representation_SplFileInfo extends Kint_Object_Representation {

    public $perms = null;
    public $flags = null;
    public $path = null;
    public $realpath = null;
    public $linktarget = null;
    public $size = null;
    public $is_dir = false;
    public $is_file = false;
    public $is_link = false;
    public $owner = null;
    public $group = null;
    public $ctime = null;
    public $mtime = null;
    public $typename = 'Unknown file';
    public $typeflag = '-';
    public $hints = array('fspath');

    public function __construct(SplFileInfo $fileInfo) {
        if (!file_exists($fileInfo->getPathname())) {
            return;
        } $this->perms = $fileInfo->getPerms();
        $this->size = $fileInfo->getSize();
        $this->is_dir = $fileInfo->isDir();
        $this->is_file = $fileInfo->isFile();
        $this->is_link = $fileInfo->isLink();
        $this->owner = $fileInfo->getOwner();
        $this->group = $fileInfo->getGroup();
        $this->ctime = $fileInfo->getCTime();
        $this->mtime = $fileInfo->getMTime();
        if (($this->perms & 0xC000) === 0xC000) {
            $this->typename = 'File socket';
            $this->typeflag = 's';
        } elseif ($this->is_file) {
            if ($this->is_link) {
                $this->typename = 'File symlink';
                $this->typeflag = 'l';
            } else {
                $this->typename = 'File';
                $this->typeflag = '-';
            }
        } elseif (($this->perms & 0x6000) === 0x6000) {
            $this->typename = 'Block special file';
            $this->typeflag = 'b';
        } elseif ($this->is_dir) {
            if ($this->is_link) {
                $this->typename = 'Directory symlink';
                $this->typeflag = 'l';
            } else {
                $this->typename = 'Directory';
                $this->typeflag = 'd';
            }
        } elseif (($this->perms & 0x2000) === 0x2000) {
            $this->typename = 'Character special file';
            $this->typeflag = 'c';
        } elseif (($this->perms & 0x1000) === 0x1000) {
            $this->typename = 'FIFO pipe file';
            $this->typeflag = 'p';
        } parent::__construct('SplFileInfo');
        $this->path = $fileInfo->getPathname();
        $this->realpath = realpath($this->path);
        if ($this->is_link && method_exists($fileInfo, 'getLinktarget')) {
            $this->linktarget = $fileInfo->getLinktarget();
        } $this->flags = array($this->typeflag);
        $this->flags[] = (($this->perms & 0400) ? 'r' : '-');
        $this->flags[] = (($this->perms & 0200) ? 'w' : '-');
        $this->flags[] = (($this->perms & 0100) ? (($this->perms & 04000) ? 's' : 'x') : (($this->perms & 04000) ? 'S' : '-'));
        $this->flags[] = (($this->perms & 0040) ? 'r' : '-');
        $this->flags[] = (($this->perms & 0020) ? 'w' : '-');
        $this->flags[] = (($this->perms & 0010) ? (($this->perms & 02000) ? 's' : 'x') : (($this->perms & 02000) ? 'S' : '-'));
        $this->flags[] = (($this->perms & 0004) ? 'r' : '-');
        $this->flags[] = (($this->perms & 0002) ? 'w' : '-');
        $this->flags[] = (($this->perms & 0001) ? (($this->perms & 01000) ? 't' : 'x') : (($this->perms & 01000) ? 'T' : '-'));
        $this->contents = implode($this->flags) . ' ' . $this->owner . ' ' . $this->group . ' ' . $this->getSize() . ' ' . $this->getMTime() . ' ';
        if ($this->is_link && $this->linktarget) {
            $this->contents .= $this->path . ' -> ' . $this->linktarget;
        } elseif (strlen($this->realpath) < strlen($this->path)) {
            $this->contents .= $this->realpath;
        } else {
            $this->contents .= $this->path;
        }
    }

    public function getLabel() {
        return $this->typename . ' (' . $this->getSize() . ')';
    }

    public function getSize() {
        static $unit = array('B', 'KB', 'MB', 'GB', 'TB');
        $size = $this->size;
        if ($this->size) {
            $i = floor(log($this->size, 1024));
            $size = round($this->size / pow(1024, $i), 2) . $unit[$i];
        } return $size;
    }

    public function getMTime() {
        $year = date('Y', $this->mtime);
        if ($year !== date('Y')) {
            return date('M d Y', $this->mtime);
        } else {
            return date('M d H:i', $this->mtime);
        }
    }

}

class Kint_Parser_Base64 extends Kint_Parser_Plugin {

    public static $min_length_hard = 16;
    public static $min_length_soft = 50;

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (strlen($var) < self::$min_length_hard || !preg_match('%^(?:[A-Za-z0-9+/=]{4})+$%', $var)) {
            return;
        } $data = base64_decode($var);
        if ($data === false) {
            return;
        } $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth + 1;
        $base_obj->name = 'base64_decode(' . $o->name . ')';
        if ($o->access_path) {
            $base_obj->access_path = 'base64_decode(' . $o->access_path . ')';
        } $r = new Kint_Object_Representation('Base64');
        $r->contents = $this->parser->parse($data, $base_obj);
        if (strlen($var) > self::$min_length_soft) {
            $o->addRepresentation($r, 0);
        } else {
            $o->addRepresentation($r);
        }
    }

}

class Kint_Parser_Binary extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$o instanceof Kint_Object_Blob || !in_array($o->encoding, array('ASCII', 'UTF-8'))) {
            $o->value->hints[] = 'binary';
        }
    }

}

class Kint_Parser_Blacklist extends Kint_Parser_Plugin {

    public static $blacklist = array();
    public static $shallow_blacklist = array();

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_BEGIN;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        foreach (self::$blacklist as $class) {
            if ($var instanceof $class) {
                return $this->blacklist($var, $o);
            }
        } if ($o->depth <= 0) {
            return;
        } foreach (self::$shallow_blacklist as $class) {
            if ($var instanceof $class) {
                return $this->blacklist($var, $o);
            }
        }
    }

    protected function blacklist(&$var, &$o) {
        if (function_exists('spl_object_hash')) {
            $hash = spl_object_hash($var);
        } else {
            ob_start();
            var_dump($var);
            preg_match('/#(\d+)/', ob_get_clean(), $match);
            $hash = $match[1];
        } $object = $o->transplant(new Kint_Object_Instance());
        $object->classname = get_class($var);
        $object->hash = $hash;
        $object->clearRepresentations();
        $object->value = null;
        $object->size = null;
        $object->hints[] = 'blacklist';
        $o = $object;
        $this->parser->haltParse();
        return;
    }

}

class Kint_Parser_ClassMethods extends Kint_Parser_Plugin {

    private static $cache = array();

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        $class = get_class($var);
        if (!isset(self::$cache[$class])) {
            $methods = array();
            $reflection = new ReflectionClass($class);
            foreach ($reflection->getMethods() as $method) {
                $methods[] = new Kint_Object_Method($method);
            } usort($methods, array('Kint_Parser_ClassMethods', 'sort'));
            self::$cache[$class] = $methods;
        } if (!empty(self::$cache[$class])) {
            $rep = new Kint_Object_Representation('Available methods', 'methods');
            foreach (self::$cache[$class] as $m) {
                $method = clone $m;
                $method->depth = $o->depth + 1;
                if (!$this->parser->childHasPath($o, $method)) {
                    $method->access_path = null;
                } else {
                    $method->setAccessPathFrom($o);
                } if ($method->owner_class !== $class) {
                    $ds = clone $method->getRepresentation('docstring');
                    $ds->class = $method->owner_class;
                    $method->replaceRepresentation($ds);
                } $rep->contents[] = $method;
            } $o->addRepresentation($rep);
        }
    }

    private static function sort(Kint_Object_Method $a, Kint_Object_Method $b) {
        $sort = ((int) $a->static) - ((int) $b->static);
        if ($sort) {
            return $sort;
        } $sort = Kint_Object::sortByAccess($a, $b);
        if ($sort) {
            return $sort;
        } $sort = Kint_Object_Instance::sortByHierarchy($a->owner_class, $b->owner_class);
        if ($sort) {
            return $sort;
        } return $a->startline - $b->startline;
    }

}

class Kint_Parser_ClassStatics extends Kint_Parser_Plugin {

    private static $cache = array();

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        $class = get_class($var);
        $reflection = new ReflectionClass($class);
        if (!isset(self::$cache[$class])) {
            $consts = array();
            foreach ($reflection->getConstants() as $name => $val) {
                $const = Kint_Object::blank($name);
                $const->const = true;
                $const->depth = $o->depth + 1;
                $const->owner_class = $class;
                if (KINT_PHP53) {
                    $const->access_path = '\\' . $class . '::' . $const->name;
                } else {
                    $const->access_path = $class . '::' . $const->name;
                } $const->operator = Kint_Object::OPERATOR_STATIC;
                $const = $this->parser->parse($val, $const);
                $consts[] = $const;
            } self::$cache[$class] = $consts;
        } $statics = new Kint_Object_Representation('Static class properties', 'statics');
        $statics->contents = self::$cache[$class];
        if (!KINT_PHP53) {
            $static_map = $reflection->getStaticProperties();
        } foreach ($reflection->getProperties(ReflectionProperty::IS_STATIC) as $static) {
            $prop = new Kint_Object();
            $prop->name = '$' . $static->getName();
            $prop->depth = $o->depth + 1;
            $prop->static = true;
            $prop->operator = Kint_Object::OPERATOR_STATIC;
            if (KINT_PHP53) {
                $prop->owner_class = $static->getDeclaringClass()->name;
            } else {
                $prop->owner_class = $class;
            } $prop->access = Kint_Object::ACCESS_PUBLIC;
            if ($static->isProtected()) {
                $prop->access = Kint_Object::ACCESS_PROTECTED;
            } elseif ($static->isPrivate()) {
                $prop->access = Kint_Object::ACCESS_PRIVATE;
            } if ($this->parser->childHasPath($o, $prop)) {
                if (KINT_PHP53) {
                    $prop->access_path = '\\' . $prop->owner_class . '::' . $prop->name;
                } else {
                    $prop->access_path = $prop->owner_class . '::' . $prop->name;
                }
            } if (KINT_PHP53) {
                $static->setAccessible(true);
                $val = $static->getValue();
            } else {
                switch ($prop->access) {
                    case Kint_Object::ACCESS_PUBLIC: $val = $static_map[$static->getName()];
                        break;
                    case Kint_Object::ACCESS_PROTECTED: $val = $static_map["\0*\0" . $static->getName()];
                        break;
                    case Kint_Object::ACCESS_PRIVATE: $val = $static_map["\0" . $class . "\0" . $static->getName()];
                        break;
                }
            } $statics->contents[] = $this->parser->parse($val, $prop);
        } if (empty($statics->contents)) {
            return;
        } usort($statics->contents, array('Kint_Parser_ClassStatics', 'sort'));
        $o->addRepresentation($statics);
    }

    private static function sort(Kint_Object $a, Kint_Object $b) {
        $sort = ((int) $a->const) - ((int) $b->const);
        if ($sort) {
            return $sort;
        } $sort = Kint_Object::sortByAccess($a, $b);
        if ($sort) {
            return $sort;
        } return Kint_Object_Instance::sortByHierarchy($a->owner_class, $b->owner_class);
    }

}

class Kint_Parser_Closure extends Kint_Parser_Plugin {

    public function getTypes() {
        if (KINT_PHP53) {
            return array('object');
        } else {
            return array();
        }
    }

    public function getTriggers() {
        if (KINT_PHP53) {
            return Kint_Parser::TRIGGER_SUCCESS;
        } else {
            return Kint_Parser::TRIGGER_NONE;
        }
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof Closure) {
            return;
        } $o = $o->transplant(new Kint_Object_Closure());
        $o->removeRepresentation('properties');
        $closure = new ReflectionFunction($var);
        $o->filename = $closure->getFileName();
        $o->startline = $closure->getStartLine();
        foreach ($closure->getParameters() as $param) {
            $o->parameters[] = new Kint_Object_Parameter($param);
        } $p = new Kint_Object_Representation('Parameters');
        $p->contents = &$o->parameters;
        $o->addRepresentation($p, 0);
        $statics = array();
        if (method_exists($closure, 'getClosureThis') && $v = $closure->getClosureThis()) {
            $statics = array('this' => $v);
        } if (count($statics = $statics + $closure->getStaticVariables())) {
            $statics_parsed = array();
            foreach ($statics as $name => &$static) {
                $obj = Kint_Object::blank('$' . $name);
                $obj->depth = $o->depth + 1;
                $statics_parsed[$name] = $this->parser->parse($static, $obj);
                if ($statics_parsed[$name]->value === null) {
                    $statics_parsed[$name]->access_path = null;
                }
            } $r = new Kint_Object_Representation('Uses');
            $r->contents = $statics_parsed;
            $o->addRepresentation($r, 0);
        }
    }

}

class Kint_Parser_Color extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (strlen($var) > 32) {
            return;
        } $trimmed = strtolower(trim($var));
        if (!isset(Kint_Object_Color::$color_map[$trimmed]) && !preg_match('/^(?:(?:rgb|hsl)[^\)]{6,}\)|#[0-9a-fA-F]{3,8})$/', $trimmed)) {
            return;
        } $rep = new Kint_Object_Representation_Color($var);
        if ($rep->variant) {
            $o = $o->transplant(new Kint_Object_Color($rep));
            $o->removeRepresentation($o->value->name);
            $o->addRepresentation($rep, 0);
        }
    }

}

class Kint_Parser_DOMIterator extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_COMPLETE & ~Kint_Parser::TRIGGER_RECURSION;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!($var instanceof DOMNamedNodeMap || $var instanceof DOMNodeList)) {
            return;
        } $o->size = $var->length;
        if ($o->size === 0) {
            $o->replaceRepresentation(new Kint_Object_Representation('Iterator'));
            $o->size = null;
            return;
        } if ($this->parser->max_depth && $o->depth + 1 >= $this->parser->max_depth) {
            $b = new Kint_Object();
            $b->name = $o->classname . ' Iterator Contents';
            $b->access_path = 'iterator_to_array(' . $o->access_path . ')';
            $b->depth = $o->depth + 1;
            $b->hints[] = 'depth_limit';
            $r = new Kint_Object_Representation('Iterator');
            $r->contents = array($b);
            $o->replaceRepresentation($r, 0);
            return;
        } if (!$var instanceof Traversable) {
            $data = array();
            foreach ($var as $item) {
                $data[] = $item;
            }
        } else {
            $data = iterator_to_array($var);
        } $r = new Kint_Object_Representation('Iterator');
        $o->replaceRepresentation($r, 0);
        foreach ($data as $key => $item) {
            $base_obj = new Kint_Object();
            $base_obj->depth = $o->depth + 1;
            $base_obj->name = $item->nodeName;
            if ($o->access_path) {
                if ($var instanceof DOMNamedNodeMap) {
                    $base_obj->access_path = $o->access_path . '->getNamedItem(' . var_export($key, true) . ')';
                } elseif ($var instanceof DOMNodeList) {
                    $base_obj->access_path = $o->access_path . '->item(' . var_export($key, true) . ')';
                } else {
                    $base_obj->access_path = 'iterator_to_array(' . $o->access_path . ')';
                }
            } $r->contents[] = $this->parser->parse($item, $base_obj);
        }
    }

}

class Kint_Parser_DOMNode extends Kint_Parser_Plugin {

    public static $blacklist = array('parentNode' => 'DOMNode', 'firstChild' => 'DOMNode', 'lastChild' => 'DOMNode', 'previousSibling' => 'DOMNode', 'nextSibling' => 'DOMNode', 'ownerDocument' => 'DOMDocument',);
    public static $verbose = false;

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof DOMNode) {
            return;
        } $known_properties = array('nodeValue', 'childNodes', 'attributes',);
        if (self::$verbose) {
            $known_properties = array('nodeName', 'nodeValue', 'nodeType', 'parentNode', 'childNodes', 'firstChild', 'lastChild', 'previousSibling', 'nextSibling', 'attributes', 'ownerDocument', 'namespaceURI', 'prefix', 'localName', 'baseURI', 'textContent',);
        } $childNodes = array();
        $attributes = array();
        $rep = $o->value;
        foreach ($known_properties as $prop) {
            $prop_obj = $this->parseProperty($o, $prop, $var);
            $rep->contents[] = $prop_obj;
            if ($prop === 'childNodes') {
                $childNodes = $prop_obj->getRepresentation('iterator');
            } elseif ($prop === 'attributes') {
                $attributes = $prop_obj->getRepresentation('iterator');
            }
        } if (!self::$verbose) {
            $o->removeRepresentation('methods');
            $o->removeRepresentation('properties');
        } if (in_array($o->classname, array('DOMAttr', 'DOMText', 'DOMComment'))) {
            return;
        } if ($attributes) {
            $a = new Kint_Object_Representation('Attributes');
            foreach ($attributes->contents as $attribute) {
                $a->contents[] = self::textualNodeToString($attribute);
            } $o->addRepresentation($a, 0);
        } if ($childNodes) {
            $c = new Kint_Object_Representation('Children');
            if (count($childNodes->contents) === 1 && ($node = reset($childNodes->contents)) && in_array('depth_limit', $node->hints)) {
                $node = $node->transplant(new Kint_Object_Instance());
                $node->name = 'childNodes';
                $node->classname = 'DOMNodeList';
                $c->contents = array($node);
            } else {
                foreach ($childNodes->contents as $index => $node) {
                    if ($node->classname === 'DOMText' || $node->classname === 'DOMComment') {
                        $node = self::textualNodeToString($node);
                        if (ctype_space($node->value->contents) || $node->value->contents === '') {
                            continue;
                        }
                    } $c->contents[] = $node;
                }
            } $o->addRepresentation($c, 0);
        } if (isset($c) && count($c->contents)) {
            $o->size = count($c->contents);
        } if (!$o->size) {
            $o->size = null;
        }
    }

    protected function parseProperty(Kint_Object $o, $prop, &$var) {
        $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth + 1;
        $base_obj->owner_class = $o->classname;
        $base_obj->name = $prop;
        $base_obj->operator = Kint_Object::OPERATOR_OBJECT;
        $base_obj->access = Kint_Object::ACCESS_PUBLIC;
        if ($o->access_path !== null) {
            $base_obj->access_path = $o->access_path;
            if (preg_match('/^[A-Za-z0-9_]+$/', $base_obj->name)) {
                $base_obj->access_path .= '->' . $base_obj->name;
            } else {
                $base_obj->access_path .= '->{' . var_export($base_obj->name, true) . '}';
            }
        } if (!isset($var->$prop)) {
            $base_obj->type = 'null';
        } elseif (isset(self::$blacklist[$prop])) {
            $base_obj = $base_obj->transplant(new Kint_Object_Instance());
            $base_obj->hints[] = 'blacklist';
            $base_obj->classname = self::$blacklist[$prop];
        } elseif ($prop === 'attributes') {
            $depth_stash = $this->parser->max_depth;
            $this->parser->max_depth = 0;
            $base_obj = $this->parser->parse($var->$prop, $base_obj);
            $this->parser->max_depth = $depth_stash;
        } else {
            $base_obj = $this->parser->parse($var->$prop, $base_obj);
        } return $base_obj;
    }

    protected static function textualNodeToString(Kint_Object_Instance $o) {
        if (empty($o->value) || empty($o->value->contents) || empty($o->classname)) {
            return;
        } if (!in_array($o->classname, array('DOMText', 'DOMAttr', 'DOMComment'))) {
            return;
        } foreach ($o->value->contents as $property) {
            if ($property->name === 'nodeValue') {
                $ret = clone $property;
                $ret->name = $o->name;
                return $ret;
            }
        }
    }

}

class Kint_Parser_DateTime extends Kint_Parser_Plugin {

    public function getTypes() {
        if (KINT_PHP53) {
            return array('object');
        } else {
            return array();
        }
    }

    public function getTriggers() {
        if (KINT_PHP53) {
            return Kint_Parser::TRIGGER_SUCCESS;
        } else {
            return Kint_Parser::TRIGGER_NONE;
        }
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof DateTime) {
            return;
        } $o = $o->transplant(new Kint_Object_DateTime($var));
    }

}

class Kint_Parser_FsPath extends Kint_Parser_Plugin {

    public static $blacklist = array('/', '.');

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (strlen($var) > 2048 || preg_match('/[:?<>"*|]/', $var) || !preg_match('/[\\/\\.\\' . DIRECTORY_SEPARATOR . ']/', $var) || !@file_exists($var) || in_array($var, self::$blacklist)) {
            return;
        } $r = new Kint_Object_Representation_SplFileInfo(new SplFileInfo($var));
        $r->hints[] = 'fspath';
        $o->addRepresentation($r, 0);
    }

}

class Kint_Parser_Iterator extends Kint_Parser_Plugin {

    public static $blacklist = array('PDOStatement', 'DOMNodeList', 'DOMNamedNodeMap',);

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof Traversable) {
            return;
        } foreach (self::$blacklist as $class) {
            if ($var instanceof $class) {
                $b = new Kint_Object();
                $b->name = $class . ' Iterator Contents';
                $b->access_path = 'iterator_to_array(' . $o->access_path . ', true)';
                $b->depth = $o->depth + 1;
                $b->hints[] = 'blacklist';
                $r = new Kint_Object_Representation('Iterator');
                $r->contents = array($b);
                $o->addRepresentation($r);
                return;
            }
        } $data = iterator_to_array($var);
        if ($data === false) {
            return;
        } $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth;
        if ($o->access_path) {
            $base_obj->access_path = 'iterator_to_array(' . $o->access_path . ')';
        } $r = new Kint_Object_Representation('Iterator');
        $r->contents = $this->parser->parse($data, $base_obj);
        $r->contents = $r->contents->value->contents;
        $primary = reset($o->representations);
        if ($primary && $primary === $o->value && $primary->contents === array()) {
            $o->addRepresentation($r, 0);
        } else {
            $o->addRepresentation($r);
        }
    }

}

class Kint_Parser_Json extends Kint_Parser_Plugin {

    public function getTypes() {
        if (KINT_PHP52) {
            return array('string');
        } else {
            return array();
        }
    }

    public function getTriggers() {
        if (KINT_PHP52) {
            return Kint_Parser::TRIGGER_SUCCESS;
        } else {
            return Kint_Parser::TRIGGER_NONE;
        }
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!isset($var[0]) || ($var[0] !== '{' && $var[0] !== '[') || ($json = json_decode($var, true)) === null) {
            return;
        } $json = (array) $json;
        if (empty($json)) {
            return;
        } $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth;
        if ($o->access_path) {
            $base_obj->access_path = 'json_decode(' . $o->access_path . ', true)';
        } $r = new Kint_Object_Representation('Json');
        $r->contents = $this->parser->parse($json, $base_obj);
        if (!in_array('depth_limit', $r->contents->hints)) {
            $r->contents = $r->contents->value->contents;
        } $o->addRepresentation($r, 0);
    }

}

class Kint_Parser_Microtime extends Kint_Parser_Plugin {

    private static $last = null;
    private static $start = null;
    private static $times = 0;
    private static $group = 0;

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!preg_match('/0\.[0-9]{8} [0-9]{10}/', $var)) {
            return;
        } if ($o->name !== 'microtime()' || $o->depth !== 0) {
            return;
        } list($usec, $sec) = explode(' ', $var);
        $time = (float) $usec + (float) $sec;
        if (self::$last !== null) {
            $last_time = array_sum(array_map('floatval', explode(' ', self::$last)));
            $lap = $time - $last_time;
            ++self::$times;
        } else {
            $lap = null;
            self::$start = $time;
        } self::$last = $var;
        if ($lap !== null) {
            $total = $time - self::$start;
            $r = new Kint_Object_Representation_Microtime(self::$group, $lap, $total, self::$times);
        } else {
            $r = new Kint_Object_Representation_Microtime(self::$group);
        } $r->contents = $var;
        $r->implicit_label = true;
        $o->removeRepresentation($o->value->name);
        $o->addRepresentation($r);
    }

    public static function clean() {
        self::$last = null;
        self::$start = null;
        self::$times = 0;
        ++self::$group;
    }

}

abstract class Kint_Parser_Plugin {

    protected $parser;

    public function setParser(Kint_Parser $p) {
        $this->parser = $p;
    }

    public function getTypes() {
        return array();
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_NONE;
    }

    abstract public function parse(&$variable, Kint_Object &$o, $trigger);
}

class Kint_Parser_Serialize extends Kint_Parser_Plugin {

    public static $safe_mode = true;
    public static $options = array(true);

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        $trimmed = rtrim($var);
        if ($trimmed !== 'N;' && !preg_match('/^(?:[COabis]:\d+[:;]|d:\d+(?:\.\d+);)/', $trimmed)) {
            return;
        } if (!self::$safe_mode || !in_array($trimmed[0], array('C', 'O', 'a'))) {
            $blacklist = false;
            if (KINT_PHP70) {
                $data = @unserialize($trimmed, self::$options);
            } else {
                $data = @unserialize($trimmed);
            } if ($data === false && substr($trimmed, 0, 4) !== 'b:0;') {
                return;
            }
        } else {
            $blacklist = true;
        } $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth + 1;
        $base_obj->name = 'unserialize(' . $o->name . ')';
        if ($o->access_path) {
            $base_obj->access_path = 'unserialize(' . $o->access_path;
            if (!KINT_PHP70 || self::$options === array(true)) {
                $base_obj->access_path .= ')';
            } elseif (self::$options === array(false)) {
                $base_obj->access_path .= ', false)';
            } else {
                $base_obj->access_path .= ', Kint_Parser_Serialize::$options)';
            }
        } $r = new Kint_Object_Representation('Serialized');
        if ($blacklist) {
            $base_obj->hints[] = 'blacklist';
            $r->contents = $base_obj;
        } else {
            $r->contents = $this->parser->parse($data, $base_obj);
        } $o->addRepresentation($r, 0);
    }

}

class Kint_Parser_SimpleXMLElement extends Kint_Parser_Plugin {

    public static $verbose = false;

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof SimpleXMLElement) {
            return;
        } $o->hints[] = 'simplexml_element';
        if (!self::$verbose) {
            $o->removeRepresentation('properties');
            $o->removeRepresentation('iterator');
            $o->removeRepresentation('methods');
        } $a = new Kint_Object_Representation('Attributes');
        $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth;
        if ($o->access_path) {
            $base_obj->access_path = '(string) ' . $o->access_path;
        } if ($var->attributes()) {
            $attribs = iterator_to_array($var->attributes());
            $attribs = array_map('strval', $attribs);
        } else {
            $attribs = array();
        } $depth_stash = $this->parser->max_depth;
        $this->parser->max_depth = 0;
        $a->contents = $this->parser->parse($attribs, $base_obj);
        $this->parser->max_depth = $depth_stash;
        $a->contents = $a->contents->value->contents;
        $o->addRepresentation($a, 0);
        $children = $var->children();
        if ($o->value) {
            $c = new Kint_Object_Representation('Children');
            foreach ($o->value->contents as $value) {
                if ($value->name === '@attributes') {
                    continue;
                } elseif (isset($children->{$value->name})) {
                    $i = 0;
                    while (isset($children->{$value->name}[$i])) {
                        $base_obj = new Kint_Object();
                        $base_obj->depth = $o->depth + 1;
                        $base_obj->name = $value->name;
                        if ($value->access_path) {
                            $base_obj->access_path = $value->access_path . '[' . $i . ']';
                        } $value = $this->parser->parse($children->{$value->name}[$i], $base_obj);
                        if ($value->access_path && $value->type === 'string') {
                            $value->access_path = '(string) ' . $value->access_path;
                        } $c->contents[] = $value;
                        ++$i;
                    }
                }
            } $o->size = count($c->contents);
            if (!$o->size) {
                $o->size = null;
                if (strlen((string) $var)) {
                    $base_obj = new Kint_Object_Blob();
                    $base_obj->depth = $o->depth + 1;
                    $base_obj->name = $o->name;
                    if ($o->access_path) {
                        $base_obj->access_path = '(string) ' . $o->access_path;
                    } $value = (string) $var;
                    $depth_stash = $this->parser->max_depth;
                    $this->parser->max_depth = 0;
                    $value = $this->parser->parse($value, $base_obj);
                    $this->parser->max_depth = $depth_stash;
                    $c = new Kint_Object_Representation('Contents');
                    $c->implicit_label = true;
                    $c->contents = array($value);
                }
            } $o->addRepresentation($c, 0);
        }
    }

}

class Kint_Parser_SplFileInfo extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_COMPLETE;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof SplFileInfo) {
            return;
        } $r = new Kint_Object_Representation_SplFileInfo(clone $var);
        $o->addRepresentation($r, 0);
        $o->size = $r->getSize();
    }

}

class Kint_Parser_SplObjectStorage extends Kint_Parser_Plugin {

    public function getTypes() {
        if (KINT_PHP53) {
            return array('object');
        } else {
            return array();
        }
    }

    public function getTriggers() {
        if (KINT_PHP53) {
            return Kint_Parser::TRIGGER_COMPLETE;
        } else {
            return Kint_Parser::TRIGGER_NONE;
        }
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof SplObjectStorage || !($r = $o->getRepresentation('iterator'))) {
            return;
        } $r = $o->getRepresentation('iterator');
        if ($r) {
            $o->size = !is_array($r->contents) ? null : count($r->contents);
        }
    }

}

class Kint_Parser_Stream extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('resource');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$o instanceof Kint_Object_Resource || $o->resource_type !== 'stream') {
            return;
        } if (!$meta = stream_get_meta_data($var)) {
            return;
        } $rep = new Kint_Object_Representation('Stream');
        $rep->implicit_label = true;
        $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth;
        if ($o->access_path) {
            $base_obj->access_path = 'stream_get_meta_data(' . $o->access_path . ')';
        } $rep->contents = $this->parser->parse($meta, $base_obj);
        if (!in_array('depth_limit', $rep->contents->hints)) {
            $rep->contents = $rep->contents->value->contents;
        } $o->addRepresentation($rep, 0);
        $o = $o->transplant(new Kint_Object_Stream($meta));
    }

}

class Kint_Parser_Table extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('array');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (empty($o->value->contents)) {
            return;
        } $array = $this->parser->getCleanArray($var);
        if (count($array) < 2) {
            return;
        } $keys = null;
        foreach ($array as $elem) {
            if (!is_array($elem) || count($elem) < 2) {
                return;
            } elseif ($keys === null) {
                $keys = array_keys($elem);
            } elseif (array_keys($elem) !== $keys) {
                return;
            }
        } foreach ($o->value->contents as $childarray) {
            if (empty($childarray->value->contents)) {
                return;
            }
        } $table = new Kint_Object_Representation('Table');
        $table->contents = $o->value->contents;
        $table->hints[] = 'table';
        $o->addRepresentation($table, 0);
    }

}

class Kint_Parser_Throwable extends Kint_Parser_Plugin {

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$var instanceof Exception && (!KINT_PHP70 || !$var instanceof Throwable)) {
            return;
        } $o = $o->transplant(new Kint_Object_Throwable($var));
    }

}

class Kint_Parser_Timestamp extends Kint_Parser_Plugin {

    public static $blacklist = array(2147483648, 2147483647, 1073741824, 1073741823,);

    public function getTypes() {
        return array('string', 'integer');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (is_string($var) && !ctype_digit($var)) {
            return;
        } if (in_array($var, self::$blacklist)) {
            return;
        } $len = strlen($var);
        if ($len === 9 || $len === 10) {
            $o->value->label = 'Timestamp';
            $o->value->hints[] = 'timestamp';
        }
    }

}

class Kint_Parser_ToString extends Kint_Parser_Plugin {

    public static $blacklist = array('SimpleXMLElement',);

    public function getTypes() {
        return array('object');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        $reflection = new ReflectionClass($var);
        if (!$reflection->hasMethod('__toString')) {
            return;
        } foreach (self::$blacklist as $class) {
            if ($var instanceof $class) {
                return;
            }
        } $r = new Kint_Object_Representation('toString');
        $r->contents = (string) $var;
        $o->addRepresentation($r);
    }

}

class Kint_Parser_Trace extends Kint_Parser_Plugin {

    public static $blacklist = array('spl_autoload_call');

    public function getTypes() {
        return array('array');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (!$o->value) {
            return;
        } $trace = $this->parser->getCleanArray($var);
        if (count($trace) !== count($o->value->contents) || !self::isTrace($trace)) {
            return;
        } $o = $o->transplant(new Kint_Object_Trace());
        $rep = $o->value;
        $old_trace = $rep->contents;
        self::normalizeAliases(self::$blacklist);
        $rep->contents = array();
        foreach ($old_trace as $frame) {
            $index = $frame->name;
            if (!isset($trace[$index]['function'])) {
                continue;
            } if (self::frameIsListed($trace[$index], self::$blacklist)) {
                continue;
            } $rep->contents[$index] = $frame->transplant(new Kint_Object_TraceFrame());
            $rep->contents[$index]->assignFrame($trace[$index]);
        } ksort($rep->contents);
        $rep->contents = array_values($rep->contents);
        $o->clearRepresentations();
        $o->addRepresentation($rep);
        $o->size = count($rep->contents);
    }

    public static function isTrace(array $trace) {
        if (!Kint_Object::isSequential($trace)) {
            return false;
        } static $bt_structure = array('function' => 'string', 'line' => 'integer', 'file' => 'string', 'class' => 'string', 'object' => 'object', 'type' => 'string', 'args' => 'array',);
        $file_found = false;
        foreach ($trace as $frame) {
            if (!is_array($frame) || !isset($frame['function'])) {
                return false;
            } foreach ($frame as $key => $val) {
                if (!isset($bt_structure[$key])) {
                    return false;
                } elseif (gettype($val) !== $bt_structure[$key]) {
                    return false;
                } elseif ($key === 'file') {
                    $file_found = true;
                }
            }
        } return $file_found;
    }

    public static function frameIsListed(array $frame, array $matches) {
        if (isset($frame['class'])) {
            $called = array(strtolower($frame['class']), strtolower($frame['function']));
        } else {
            $called = strtolower($frame['function']);
        } return in_array($called, $matches, true);
    }

    public static function normalizeAliases(array &$aliases) {
        foreach ($aliases as $index => &$alias) {
            if (is_array($alias) && count($alias) === 2) {
                $alias = array_values(array_filter($alias, 'is_string'));
                if (count($alias) === 2 && preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $alias[1]) && preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff\\\\]*$/', $alias[0])) {
                    $alias = array(strtolower(ltrim($alias[0], '\\')), strtolower($alias[1]),);
                } else {
                    unset($aliases[$index]);
                    continue;
                }
            } elseif (is_string($alias)) {
                if (preg_match('/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $alias)) {
                    $alias = strtolower($alias);
                } else {
                    unset($aliases[$index]);
                    continue;
                }
            } else {
                unset($aliases[$index]);
            }
        } $aliases = array_values($aliases);
    }

}

class Kint_Parser_Xml extends Kint_Parser_Plugin {

    public static $parse_method = 'SimpleXML';

    public function getTypes() {
        return array('string');
    }

    public function getTriggers() {
        return Kint_Parser::TRIGGER_SUCCESS;
    }

    public function parse(&$var, Kint_Object &$o, $trigger) {
        if (substr($var, 0, 5) !== '<?xml') {
            return;
        } if (!method_exists(get_class($this), 'xmlTo' . self::$parse_method)) {
            return;
        } $xml = call_user_func(array(get_class($this), 'xmlTo' . self::$parse_method), $var, $o->access_path);
        if (empty($xml)) {
            return;
        } list($xml, $access_path, $name) = $xml;
        $base_obj = new Kint_Object();
        $base_obj->depth = $o->depth + 1;
        $base_obj->name = $name;
        $base_obj->access_path = $access_path;
        $r = new Kint_Object_Representation('XML');
        $r->contents = $this->parser->parse($xml, $base_obj);
        $o->addRepresentation($r, 0);
    }

    protected static function xmlToSimpleXML($var, $parent_path) {
        try {
            $errors = libxml_use_internal_errors(true);
            $xml = simplexml_load_string($var);
            libxml_use_internal_errors($errors);
        } catch (Exception $e) {
            if (isset($errors)) {
                libxml_use_internal_errors($errors);
            } return;
        } if (!$xml) {
            return;
        } if ($parent_path === null) {
            $access_path = null;
        } else {
            $access_path = 'simplexml_load_string(' . $parent_path . ')';
        } $name = $xml->getName();
        return array($xml, $access_path, $name);
    }

    protected static function xmlToDOMDocument($var, $parent_path) {
        if (!self::xmlToSimpleXML($var, $parent_path)) {
            return;
        } $xml = new DOMDocument();
        $xml->loadXML($var);
        $xml = $xml->firstChild;
        if ($parent_path === null) {
            $access_path = null;
        } else {
            $access_path = '@DOMDocument::loadXML(' . $parent_path . ')->firstChild';
        } $name = $xml->nodeName;
        return array($xml, $access_path, $name);
    }

}

class Kint_Renderer_Cli extends Kint_Renderer_Text {

    public static $cli_colors = true;
    public static $force_utf8 = false;
    public static $detect_width = true;
    public static $min_terminal_width = 40;
    protected static $terminal_width = null;
    protected $windows_output = false;

    public function __construct(array $params = array()) {
        parent::__construct($params);
        if (!self::$force_utf8) {
            $this->windows_output = KINT_WIN;
        } if (!self::$terminal_width) {
            if (!KINT_WIN && self::$detect_width) {
                self::$terminal_width = exec('tput cols');
            } if (self::$terminal_width < self::$min_terminal_width) {
                self::$terminal_width = self::$default_width;
            }
        } $this->header_width = self::$terminal_width;
    }

    protected function utf8_to_windows($string) {
        return str_replace(array('┌', '═', '┐', '│', '└', '─', '┘'), array("\xda", "\xdc", "\xbf", "\xb3", "\xc0", "\xc4", "\xd9"), $string);
    }

    public function colorValue($string) {
        if (!self::$cli_colors) {
            return $string;
        } else {
            return "\x1b[32m" . str_replace("\n", "\x1b[0m\n\x1b[32m", $string) . "\x1b[0m";
        }
    }

    public function colorType($string) {
        if (!self::$cli_colors) {
            return $string;
        } else {
            return "\x1b[35;1m" . str_replace("\n", "\x1b[0m\n\x1b[35;1m", $string) . "\x1b[0m";
        }
    }

    public function colorTitle($string) {
        if (!self::$cli_colors) {
            return $string;
        } else {
            return "\x1b[36m" . str_replace("\n", "\x1b[0m\n\x1b[36m", $string) . "\x1b[0m";
        }
    }

    public function renderTitle(Kint_Object $o) {
        if ($this->windows_output) {
            return $this->utf8_to_windows(parent::renderTitle($o));
        } else {
            return parent::renderTitle($o);
        }
    }

    public function preRender() {
        return PHP_EOL;
    }

    public function postRender() {
        if ($this->windows_output) {
            return $this->utf8_to_windows(parent::postRender());
        } else {
            return parent::postRender();
        }
    }

    public function escape($string, $encoding = false) {
        return str_replace("\x1b", '\\x1b', $string);
    }

}

class Kint_Renderer_Plain extends Kint_Renderer_Text {

    public static $pre_render_sources = array('script' => array(), 'style' => array(array('Kint_Renderer_Plain', 'renderCss'),), 'raw' => array(),);
    public static $theme = 'plain.css';
    public static $disable_utf8 = false;
    protected static $been_run = false;
    protected $mod_return = false;
    protected $file_link_format = false;

    public function __construct(array $params = array()) {
        parent::__construct($params);
        if (isset($params['settings']['return'])) {
            $this->mod_return = $params['settings']['return'];
        } if (isset($params['settings']['file_link_format'])) {
            $this->file_link_format = $params['settings']['file_link_format'];
        }
    }

    protected function utf8_to_htmlentity($string) {
        return str_replace(array('┌', '═', '┐', '│', '└', '─', '┘'), array('&#9484;', '&#9552;', '&#9488;', '&#9474;', '&#9492;', '&#9472;', '&#9496;'), $string);
    }

    public function colorValue($string) {
        return '<i>' . $string . '</i>';
    }

    public function colorType($string) {
        return '<b>' . $string . '</b>';
    }

    public function colorTitle($string) {
        return '<u>' . $string . '</u>';
    }

    public function renderTitle(Kint_Object $o) {
        if (self::$disable_utf8) {
            return $this->utf8_to_htmlentity(parent::renderTitle($o));
        } else {
            return parent::renderTitle($o);
        }
    }

    protected static function renderCss() {
        if (file_exists(KINT_DIR . '/resources/compiled/' . self::$theme)) {
            return file_get_contents(KINT_DIR . '/resources/compiled/' . self::$theme);
        } else {
            return file_get_contents(self::$theme);
        }
    }

    public function preRender() {
        $output = '';
        if (!self::$been_run || $this->mod_return) {
            foreach (self::$pre_render_sources as $type => $values) {
                $contents = '';
                foreach ($values as $v) {
                    if (is_callable($v)) {
                        $contents .= call_user_func($v, $this);
                    } elseif (is_string($v)) {
                        $contents .= $v;
                    }
                } if (!strlen($contents)) {
                    continue;
                } switch ($type) {
                    case 'script': $output .= '<script class="kint-script">' . $contents . '</script>';
                        break;
                    case 'style': $output .= '<style class="kint-style">' . $contents . '</style>';
                        break;
                    default: $output .= $contents;
                }
            } if (!$this->mod_return) {
                self::$been_run = true;
            }
        } return $output . '<div class="kint-plain">';
    }

    public function postRender() {
        if (self::$disable_utf8) {
            return $this->utf8_to_htmlentity(parent::postRender()) . '</div>';
        } else {
            return parent::postRender() . '</div>';
        }
    }

    public function ideLink($file, $line) {
        $shortenedPath = $this->escape(Kint::shortenPath($file));
        if (!$this->file_link_format) {
            return $shortenedPath . ':' . $line;
        } $ideLink = Kint::getIdeLink($file, $line);
        $class = (strpos($ideLink, 'http://') === 0) ? 'class="kint-ide-link" ' : '';
        return "<a {$class}href=\"{$ideLink}\">{$shortenedPath}:{$line}</a>";
    }

    public function escape($string, $encoding = false) {
        if ($encoding === false) {
            $encoding = Kint_Object_Blob::detectEncoding($string);
        } $original_encoding = $encoding;
        if ($encoding === false || $encoding === 'ASCII') {
            $encoding = 'UTF-8';
        } $string = htmlspecialchars($string, ENT_NOQUOTES, $encoding);
        if (extension_loaded('mbstring') && $original_encoding !== 'ASCII') {
            $string = mb_encode_numericentity($string, array(0x80, 0xffff, 0, 0xffff), $encoding);
        } return $string;
    }

}

class Kint_Renderer_Rich extends Kint_Renderer {

    public static $object_renderers = array('blacklist' => 'Kint_Renderer_Rich_Blacklist', 'callable' => 'Kint_Renderer_Rich_Callable', 'closure' => 'Kint_Renderer_Rich_Closure', 'color' => 'Kint_Renderer_Rich_Color', 'depth_limit' => 'Kint_Renderer_Rich_DepthLimit', 'nothing' => 'Kint_Renderer_Rich_Nothing', 'recursion' => 'Kint_Renderer_Rich_Recursion', 'simplexml_element' => 'Kint_Renderer_Rich_SimpleXMLElement', 'trace_frame' => 'Kint_Renderer_Rich_TraceFrame',);
    public static $tab_renderers = array('binary' => 'Kint_Renderer_Rich_Binary', 'color' => 'Kint_Renderer_Rich_ColorDetails', 'docstring' => 'Kint_Renderer_Rich_Docstring', 'microtime' => 'Kint_Renderer_Rich_Microtime', 'source' => 'Kint_Renderer_Rich_Source', 'table' => 'Kint_Renderer_Rich_Table', 'timestamp' => 'Kint_Renderer_Rich_Timestamp',);
    public static $pre_render_sources = array('script' => array(array('Kint_Renderer_Rich', 'renderJs'), array('Kint_Renderer_Rich_Microtime', 'renderJs'),), 'style' => array(array('Kint_Renderer_Rich', 'renderCss'),), 'raw' => array(),);
    public static $access_paths = true;
    public static $strlen_max = 150;
    public static $theme = 'original.css';
    public static $escape_types = false;
    protected static $been_run = false;
    protected $plugin_objs = array();
    protected $mod_return = false;
    protected $callee;
    protected $mini_trace;
    protected $previous_caller;
    protected $file_link_format = false;
    protected $show_minitrace = true;
    protected $auto_expand = false;

    public function __construct(array $params = array()) {
        parent::__construct($params);
        $params += array('modifiers' => array(), 'minitrace' => array(), 'callee' => null, 'caller' => null,);
        $this->callee = $params['callee'];
        $this->mini_trace = $params['minitrace'];
        $this->previous_caller = $params['caller'];
        if (isset($params['settings']['return'])) {
            $this->mod_return = $params['settings']['return'];
        } if (isset($params['settings']['file_link_format'])) {
            $this->file_link_format = $params['settings']['file_link_format'];
        } if (empty($params['settings']['display_called_from'])) {
            $this->show_minitrace = false;
        } if (!empty($params['settings']['expanded'])) {
            $this->auto_expand = true;
        }
    }

    public function render(Kint_Object $o) {
        if ($plugin = $this->getPlugin(self::$object_renderers, $o->hints)) {
            if (strlen($output = $plugin->render($o))) {
                return $output;
            }
        } $children = $this->renderChildren($o);
        $header = $this->renderHeaderWrapper($o, (bool) strlen($children), $this->renderHeader($o));
        return '<dl>' . $header . $children . '</dl>';
    }

    public function renderHeaderWrapper(Kint_Object $o, $has_children, $contents) {
        $out = '<dt';
        if ($has_children) {
            $out .= ' class="kint-parent';
            if ($this->auto_expand) {
                $out .= ' kint-show';
            } $out .= '"';
        } $out .= '>';
        if (self::$access_paths && $o->depth > 0 && $ap = $o->getAccessPath()) {
            $out .= '<span class="kint-access-path-trigger" title="Show access path">&rlarr;</span>';
        } if ($has_children) {
            $out .= '<span class="kint-popup-trigger" title="Open in new window">&rarr;</span><nav></nav>';
        } $out .= $contents;
        if (!empty($ap)) {
            $out .= '<div class="access-path">' . $this->escape($ap) . '</div>';
        } return $out . '</dt>';
    }

    public function renderHeader(Kint_Object $o) {
        $output = '';
        if (($s = $o->getModifiers()) !== null) {
            $output .= '<var>' . $s . '</var> ';
        } if (($s = $o->getName()) !== null) {
            $output .= '<dfn>' . $this->escape($s) . '</dfn> ';
            if ($s = $o->getOperator()) {
                $output .= $this->escape($s, 'ASCII') . ' ';
            }
        } if (($s = $o->getType()) !== null) {
            if (self::$escape_types) {
                $s = $this->escape($s);
            } if ($o->reference) {
                $s = '&amp;' . $s;
            } $output .= '<var>' . $s . '</var> ';
        } if (($s = $o->getSize()) !== null) {
            if (self::$escape_types) {
                $s = $this->escape($s);
            } $output .= '(' . $s . ') ';
        } if (($s = $o->getValueShort()) !== null) {
            $s = preg_replace('/\s+/', ' ', $s);
            if (self::$strlen_max && Kint_Object_Blob::strlen($s) > self::$strlen_max) {
                $s = substr($s, 0, self::$strlen_max) . '...';
            } $output .= $this->escape($s);
        } return trim($output);
    }

    public function renderChildren(Kint_Object $o) {
        $contents = array();
        $tabs = array();
        foreach ($o->getRepresentations() as $rep) {
            $result = $this->renderTab($o, $rep);
            if (is_null($result)) {
                $result = '';
            }
            if (strlen($result)) {
                $contents[] = $result;
                $tabs[] = $rep;
            }
        } if (empty($tabs)) {
            return '';
        } $output = '<dd>';
        if (count($tabs) === 1 && $tabs[0]->labelIsImplicit()) {
            $output .= reset($contents);
        } else {
            $output .= '<ul class="kint-tabs">';
            foreach ($tabs as $i => $tab) {
                if ($i === 0) {
                    $output .= '<li class="kint-active-tab">';
                } else {
                    $output .= '<li>';
                } $output .= $this->escape($tab->getLabel()) . '</li>';
            } $output .= '</ul><ul>';
            foreach ($contents as $i => $tab) {
                $output .= '<li '.(($i !== 0)? 'style="display:none"':'').'>' . $tab . '</li>';
            } $output .= '</ul>';
        } return $output . '</dd>';
    }

    protected function renderTab(Kint_Object $o, Kint_Object_Representation $rep) {
        if ($plugin = $this->getPlugin(self::$tab_renderers, $rep->hints)) {
            if (strlen($output = $plugin->render($rep))) {
                return $output;
            }
        } if (is_array($rep->contents)) {
            $output = '';
            foreach ($rep->contents as $obj) {
                $output .= $this->render($obj);
            } return $output;
        } elseif (is_string($rep->contents)) {
            $show_contents = false;
            if ($o->type !== 'string' || $o->value !== $rep) {
                $show_contents = true;
            } elseif (preg_match('/(:?[\r\n\t\f\v]| {2})/', $rep->contents)) {
                $show_contents = true;
            } elseif (self::$strlen_max && Kint_Object_Blob::strlen($rep->contents) > self::$strlen_max) {
                $show_contents = true;
            } if ($o->type === 'string' && $o->value === $rep && $o->encoding === false) {
                $show_contents = false;
            } if ($show_contents) {
                return '<pre>' . $this->escape($rep->contents) . "\n</pre>";
            }
        } elseif ($rep->contents instanceof Kint_Object) {
            return $this->render($rep->contents);
        } return;
    }

    protected static function renderJs() {
        return file_get_contents(KINT_DIR . '/resources/compiled/rich.js');
    }

    protected static function renderCss() {
        if (file_exists(KINT_DIR . '/resources/compiled/' . self::$theme)) {
            return file_get_contents(KINT_DIR . '/resources/compiled/' . self::$theme);
        } else {
            return file_get_contents(self::$theme);
        }
    }

    public function preRender() {
        $output = '';
        if (!self::$been_run || $this->mod_return) {
            foreach (self::$pre_render_sources as $type => $values) {
                $contents = '';
                foreach ($values as $v) {
                    if (is_callable($v)) {
                        $contents .= call_user_func($v, $this);
                    } elseif (is_string($v)) {
                        $contents .= $v;
                    }
                } if (!strlen($contents)) {
                    continue;
                } switch ($type) {
                    case 'script': $output .= '<script class="kint-script">' . $contents . '</script>';
                        break;
                    case 'style': $output .= '<style class="kint-style">' . $contents . '</style>';
                        break;
                    default: $output .= $contents;
                }
            } if (!$this->mod_return) {
                self::$been_run = true;
            }
        } return $output . '<div class="kint-rich">';
    }

    public function postRender() {
        if (!$this->show_minitrace) {
            return '</div>';
        } $output = '<footer>';
        $output .= '<span class="kint-popup-trigger" title="Open in new window">&rarr;</span> ';
        if (isset($this->callee['file'])) {
            if (!empty($this->mini_trace)) {
                $output .= '<nav></nav>';
            } $output .= 'Called from ' . $this->ideLink($this->callee['file'], $this->callee['line']);
        } $caller = '';
        if (isset($this->previous_caller['class'])) {
            $caller .= $this->previous_caller['class'];
        } if (isset($this->previous_caller['type'])) {
            $caller .= $this->previous_caller['type'];
        } if (isset($this->previous_caller['function']) && !in_array($this->previous_caller['function'], array('include', 'include_once', 'require', 'require_once'))) {
            $caller .= $this->previous_caller['function'] . '()';
        } if ($caller) {
            $output .= ' [' . $caller . ']';
        } if (!empty($this->mini_trace)) {
            $output .= '<ol>';
            foreach ($this->mini_trace as $step) {
                $output .= '<li>' . $this->ideLink($step['file'], $step['line']);
                if (isset($step['function']) && !in_array($step['function'], array('include', 'include_once', 'require', 'require_once'))) {
                    $output .= ' [';
                    if (isset($step['class'])) {
                        $output .= $step['class'];
                    } if (isset($step['type'])) {
                        $output .= $step['type'];
                    } $output .= $step['function'] . '()]';
                }
            } $output .= '</ol>';
        } $output .= '</footer></div>';
        return $output;
    }

    public function escape($string, $encoding = false) {
        if ($encoding === false) {
            $encoding = Kint_Object_Blob::detectEncoding($string);
        } $original_encoding = $encoding;
        if ($encoding === false || $encoding === 'ASCII') {
            $encoding = 'UTF-8';
        } $string = htmlspecialchars($string, ENT_NOQUOTES, $encoding);
        if (extension_loaded('mbstring') && $original_encoding !== 'ASCII') {
            $string = mb_encode_numericentity($string, array(0x80, 0xffff, 0, 0xffff), $encoding);
        } return $string;
    }

    protected function getPlugin(array $plugins, array $hints) {
        if ($plugins = $this->matchPlugins($plugins, $hints)) {
            $plugin = end($plugins);
            if (!isset($this->plugin_objs[$plugin])) {
                $this->plugin_objs[$plugin] = new $plugin($this);
            } return $this->plugin_objs[$plugin];
        }
    }

    protected function ideLink($file, $line) {
        $shortenedPath = $this->escape(Kint::shortenPath($file));
        if (!$this->file_link_format) {
            return $shortenedPath . ':' . $line;
        } $ideLink = Kint::getIdeLink($file, $line);
        $class = (strpos($ideLink, 'http://') === 0) ? 'class="kint-ide-link" ' : '';
        return "<a {$class}href=\"{$ideLink}\">{$shortenedPath}:{$line}</a>";
    }

}

class Kint_Renderer_Text extends Kint_Renderer {

    public static $object_renderers = array('blacklist' => 'Kint_Renderer_Text_Blacklist', 'depth_limit' => 'Kint_Renderer_Text_DepthLimit', 'nothing' => 'Kint_Renderer_Text_Nothing', 'recursion' => 'Kint_Renderer_Text_Recursion', 'trace' => 'Kint_Renderer_Text_Trace',);
    public static $parser_plugin_whitelist = array('Kint_Parser_Blacklist', 'Kint_Parser_Stream', 'Kint_Parser_Trace',);
    public static $strlen_max = 0;
    public static $default_width = 80;
    public static $default_indent = 4;
    public static $decorations = true;
    public $header_width = 80;
    public $indent_width = 4;
    protected $plugin_objs = array();
    protected $previous_caller;
    protected $callee;
    protected $show_minitrace = true;

    public function __construct(array $params = array()) {
        parent::__construct($params);
        $params += array('callee' => null, 'caller' => null,);
        $this->callee = $params['callee'];
        $this->previous_caller = $params['caller'];
        $this->show_minitrace = !empty($params['settings']['display_called_from']);
        $this->header_width = self::$default_width;
        $this->indent_width = self::$default_indent;
    }

    public function render(Kint_Object $o) {
        if ($plugin = $this->getPlugin(self::$object_renderers, $o->hints)) {
            if (strlen($output = $plugin->render($o))) {
                return $output;
            }
        } $out = '';
        if ($o->depth == 0) {
            $out .= $this->colorTitle($this->renderTitle($o)) . PHP_EOL;
        } $out .= $this->renderHeader($o);
        $out .= $this->renderChildren($o) . PHP_EOL;
        return $out;
    }

    public function boxText($text, $width) {
        if (Kint_Object_Blob::strlen($text) > $width - 4) {
            $text = Kint_Object_Blob::substr($text, 0, $width - 7) . '...';
        } $text .= str_repeat(' ', $width - 4 - Kint_Object_Blob::strlen($text));
        $out = '┌' . str_repeat('─', $width - 2) . '┐' . PHP_EOL;
        $out .= '│ ' . $this->escape($text) . ' │' . PHP_EOL;
        $out .= '└' . str_repeat('─', $width - 2) . '┘';
        return $out;
    }

    public function renderTitle(Kint_Object $o) {
        if (($name = $o->getName()) === null) {
            $name = 'literal';
        } if (self::$decorations) {
            return $this->boxText($name, $this->header_width);
        } elseif (Kint_Object_Blob::strlen($name) > $this->header_width) {
            return Kint_Object_Blob::substr($name, 0, $this->header_width - 3) . '...';
        } else {
            return $name;
        }
    }

    public function renderHeader(Kint_Object $o) {
        $output = array();
        if ($o->depth) {
            if (($s = $o->getModifiers()) !== null) {
                $output[] = $s;
            } if ($o->name !== null) {
                $output[] = $this->escape(var_export($o->name, true));
                if (($s = $o->getOperator()) !== null) {
                    $output[] = $this->escape($s);
                }
            }
        } if (($s = $o->getType()) !== null) {
            if ($o->reference) {
                $s = '&' . $s;
            } $output[] = $this->colorType($this->escape($s));
        } if (($s = $o->getSize()) !== null) {
            $output[] = '(' . $this->escape($s) . ')';
        } if (($s = $o->getValueShort()) !== null) {
            if (self::$strlen_max && Kint_Object_Blob::strlen($s) > self::$strlen_max) {
                $s = substr($s, 0, self::$strlen_max) . '...';
            } $output[] = $this->colorValue($this->escape($s));
        } return str_repeat(' ', $o->depth * $this->indent_width) . implode(' ', $output);
    }

    public function renderChildren(Kint_Object $o) {
        if ($o->type === 'array') {
            $output = ' [';
        } elseif ($o->type === 'object') {
            $output = ' (';
        } else {
            return '';
        } $children = '';
        if ($o->value && is_array($o->value->contents)) {
            foreach ($o->value->contents as $child) {
                $children .= $this->render($child);
            }
        } if ($children) {
            $output .= PHP_EOL . $children;
            $output .= str_repeat(' ', $o->depth * $this->indent_width);
        } if ($o->type === 'array') {
            $output .= ']';
        } elseif ($o->type === 'object') {
            $output .= ')';
        } return $output;
    }

    public function colorValue($string) {
        return $string;
    }

    public function colorType($string) {
        return $string;
    }

    public function colorTitle($string) {
        return $string;
    }

    public function postRender() {
        if (self::$decorations) {
            $output = str_repeat('═', $this->header_width);
        } else {
            $output = '';
        } if (!$this->show_minitrace) {
            return $this->colorTitle($output);
        } else {
            if ($output) {
                $output .= PHP_EOL;
            } return $this->colorTitle($output . $this->calledFrom() . PHP_EOL);
        }
    }

    public function parserPlugins(array $plugins) {
        $return = array();
        foreach ($plugins as $index => $plugin) {
            foreach (self::$parser_plugin_whitelist as $whitelist) {
                if ($plugin instanceof $whitelist) {
                    $return[] = $plugin;
                    continue 2;
                }
            }
        } return $return;
    }

    protected function calledFrom() {
        $output = '';
        if (isset($this->callee['file'])) {
            $output .= 'Called from ' . $this->ideLink($this->callee['file'], $this->callee['line']);
        } $caller = '';
        if (isset($this->previous_caller['class'])) {
            $caller .= $this->previous_caller['class'];
        } if (isset($this->previous_caller['type'])) {
            $caller .= $this->previous_caller['type'];
        } if (isset($this->previous_caller['function']) && !in_array($this->previous_caller['function'], array('include', 'include_once', 'require', 'require_once'))) {
            $caller .= $this->previous_caller['function'] . '()';
        } if ($caller) {
            $output .= ' [' . $caller . ']';
        } return $output;
    }

    public function ideLink($file, $line) {
        return $this->escape(Kint::shortenPath($file)) . ':' . $line;
    }

    protected function getPlugin(array $plugins, array $hints) {
        if ($plugins = $this->matchPlugins($plugins, $hints)) {
            $plugin = end($plugins);
            if (!isset($this->plugin_objs[$plugin])) {
                $this->plugin_objs[$plugin] = new $plugin($this);
            } return $this->plugin_objs[$plugin];
        }
    }

    public function escape($string, $encoding = false) {
        return $string;
    }

}

class Kint_Renderer_Rich_Binary extends Kint_Renderer_Rich_Plugin {

    public static $line_length = 0x10;
    public static $chunk_length = 0x4;

    public function render($r) {
        $out = '<pre>';
        $chunks = str_split($r->contents, self::$line_length);
        foreach ($chunks as $index => $chunk) {
            $out .= sprintf('%08X', $index * self::$line_length) . ":\t";
            $out .= implode(' ', str_split(str_pad(bin2hex($chunk), 2 * self::$line_length, ' '), self::$chunk_length));
            $out .= "\t" . preg_replace('/[^\x20-\x7E]/', '.', $chunk) . "\n";
        } $out .= '</pre>';
        return $out;
    }

}

class Kint_Renderer_Rich_Blacklist extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        return '<dl>' . $this->renderHeaderLocked($o, '<var>Blacklisted</var>') . '</dl>';
    }

}

class Kint_Renderer_Rich_Callable extends Kint_Renderer_Rich_Plugin {

    protected static $method_cache = array();

    public function render($o) {
        if ($o instanceof Kint_Object_Method && strlen($o->owner_class) && strlen($o->name) && !empty(self::$method_cache[$o->owner_class][$o->name])) {
            $children = self::$method_cache[$o->owner_class][$o->name]['children'];
            $header = $this->renderer->renderHeaderWrapper($o, (bool) strlen($children), self::$method_cache[$o->owner_class][$o->name]['header']);
            return '<dl>' . $header . $children . '</dl>';
        } $children = $this->renderer->renderChildren($o);
        $header = '';
        if (($s = $o->getModifiers()) !== null) {
            $header .= '<var>' . $s . '</var> ';
        } if (($s = $o->getName()) !== null) {
            $function = $this->renderer->escape($s) . '(' . $this->renderer->escape($o->getParams()) . ')';
            if (($url = $o->getPhpDocUrl()) !== null) {
                $function = '<a href="' . $url . '" target=_blank>' . $function . '</a>';
            } $header .= '<dfn>' . $function . '</dfn>';
        } if (!empty($o->returntype)) {
            $header .= ': <var>' . $this->renderer->escape($o->returntype) . '</var>';
        } if (($s = $o->getValueShort()) !== null) {
            if (Kint_Renderer_Rich::$strlen_max && Kint_Object_Blob::strlen($s) > Kint_Renderer_Rich::$strlen_max) {
                $s = substr($s, 0, Kint_Renderer_Rich::$strlen_max) . '...';
            } $header .= ' ' . $this->renderer->escape($s);
        } if ($o instanceof Kint_Object_Method && strlen($o->owner_class) && strlen($o->name)) {
            $cache = array('header' => $header, 'children' => $children,);
            if (!isset(self::$method_cache[$o->owner_class])) {
                self::$method_cache[$o->owner_class] = array($o->name => $cache);
            } elseif (!isset(self::$method_cache[$o->owner_class][$o->name])) {
                self::$method_cache[$o->owner_class][$o->name] = $cache;
            }
        } $header = $this->renderer->renderHeaderWrapper($o, (bool) strlen($children), $header);
        return '<dl>' . $header . $children . '</dl>';
    }

}

class Kint_Renderer_Rich_Closure extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        $children = $this->renderer->renderChildren($o);
        if (!($o instanceof Kint_Object_Closure)) {
            $header = $this->renderer->renderHeader($o);
        } else {
            $header = '';
            if (($s = $o->getModifiers()) !== null) {
                $header .= '<var>' . $s . '</var> ';
            } if (($s = $o->getName()) !== null) {
                $header .= '<dfn>' . $this->renderer->escape($s) . '(' . $this->renderer->escape($o->getParams()) . ')</dfn> ';
            } $header .= '<var>Closure</var> ';
            $header .= $this->renderer->escape(Kint::shortenPath($o->filename)) . ':' . (int) $o->startline;
        } $header = $this->renderer->renderHeaderWrapper($o, (bool) strlen($children), $header);
        return '<dl>' . $header . $children . '</dl>';
    }

}

class Kint_Renderer_Rich_Color extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        $children = $this->renderer->renderChildren($o);
        $header = $this->renderer->renderHeader($o);
        $header .= '<div class="kint-color-preview"><div style="background:';
        $header .= $o->color->getColor(Kint_Object_Representation_Color::COLOR_RGBA);
        $header .= '"></div></div>';
        $header = $this->renderer->renderHeaderWrapper($o, (bool) strlen($children), $header);
        return '<dl>' . $header . $children . '</dl>';
    }

}

class Kint_Renderer_Rich_ColorDetails extends Kint_Renderer_Rich_Plugin {

    public function render($r) {
        if (!$r instanceof Kint_Object_Representation_Color) {
            return false;
        } $out = '';
        if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_NAME)) {
            $out .= '<dfn>' . $color . "</dfn>\n";
        } if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_HEX_3)) {
            $out .= '<dfn>' . $color . "</dfn>\n";
        } if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_HEX_6)) {
            $out .= '<dfn>' . $color . "</dfn>\n";
        } if ($r->hasAlpha()) {
            if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_HEX_4)) {
                $out .= '<dfn>' . $color . "</dfn>\n";
            } if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_HEX_8)) {
                $out .= '<dfn>' . $color . "</dfn>\n";
            } if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_RGBA)) {
                $out .= '<dfn>' . $color . "</dfn>\n";
            } if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_HSLA)) {
                $out .= '<dfn>' . $color . "</dfn>\n";
            }
        } else {
            if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_RGB)) {
                $out .= '<dfn>' . $color . "</dfn>\n";
            } if ($color = $r->getColor(Kint_Object_Representation_Color::COLOR_HSL)) {
                $out .= '<dfn>' . $color . "</dfn>\n";
            }
        } if (!strlen($out)) {
            return false;
        } return '<pre>' . $out . '</pre>';
    }

}

class Kint_Renderer_Rich_DepthLimit extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        return '<dl>' . $this->renderHeaderLocked($o, '<var>Depth Limit</var>') . '</dl>';
    }

}

class Kint_Renderer_Rich_Docstring extends Kint_Renderer_Rich_Plugin {

    public function render($r) {
        if (!($r instanceof Kint_Object_Representation_Docstring)) {
            return false;
        } $docstring = array();
        foreach (explode("\n", $r->contents) as $line) {
            $docstring[] = trim($line);
        } $docstring = implode("\n", $docstring);
        $location = array();
        if ($r->class) {
            $location[] = 'Inherited from ' . $this->renderer->escape($r->class);
        } if ($r->file && $r->line) {
            $location[] = 'Defined in ' . $this->renderer->escape(Kint::shortenPath($r->file)) . ':' . ((int) $r->line);
        } if ($location) {
            if (strlen($docstring)) {
                $docstring .= "\n\n";
            } $location = '<small>' . implode("\n", $location) . '</small>';
        } elseif (strlen($docstring) === 0) {
            return '';
        } return '<pre>' . $this->renderer->escape($docstring) . $location . '</pre>';
    }

}

class Kint_Renderer_Rich_Microtime extends Kint_Renderer_Rich_Plugin {

    public function render($r) {
        if (!($r instanceof Kint_Object_Representation_Microtime)) {
            return false;
        } list($usec, $sec) = explode(' ', $r->contents);
        $out = @date('Y-m-d H:i:s', $sec) . '.' . substr($usec, 2, 4);
        if ($r->lap !== null) {
            $out .= "\n<b>SINCE LAST CALL:</b> <b class=\"kint-microtime-lap\">" . round($r->lap, 4) . '</b>s.';
        } if ($r->total !== null) {
            $out .= "\n<b>SINCE START:</b> " . round($r->total, 4) . 's.';
        } if ($r->avg !== null) {
            $out .= "\n<b>AVERAGE DURATION:</b> <span class=\"kint-microtime-avg\">" . round($r->avg, 4) . '</span>s.';
        } $unit = array('B', 'KB', 'MB', 'GB', 'TB');
        $out .= "\n<b>MEMORY USAGE:</b> " . $r->mem . ' bytes (';
        $i = floor(log($r->mem, 1024));
        $out .= round($r->mem / pow(1024, $i), 3) . ' ' . $unit[$i] . ')';
        $i = floor(log($r->mem_real, 1024));
        $out .= ' (real ' . round($r->mem_real / pow(1024, $i), 3) . ' ' . $unit[$i] . ')';
        if ($r->mem_peak !== null && $r->mem_peak_real !== null) {
            $out .= "\n<b>PEAK MEMORY USAGE:</b> " . $r->mem_peak . ' bytes (';
            $i = floor(log($r->mem_peak, 1024));
            $out .= round($r->mem_peak / pow(1024, $i), 3) . ' ' . $unit[$i] . ')';
            $i = floor(log($r->mem_peak_real, 1024));
            $out .= ' (real ' . round($r->mem_peak_real / pow(1024, $i), 3) . ' ' . $unit[$i] . ')';
        } return '<pre data-kint-microtime-group="' . $r->group . '">' . $out . '</pre>';
    }

    public static function renderJs() {
        return file_get_contents(KINT_DIR . '/resources/compiled/rich_microtime.js');
    }

}

class Kint_Renderer_Rich_Nothing extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        return '<dl><dt><var>No argument</var></dt></dl>';
    }

}

abstract class Kint_Renderer_Rich_Plugin {

    protected $renderer;

    public function __construct(Kint_Renderer_Rich $r) {
        $this->renderer = $r;
    }

    public function renderHeaderLocked(Kint_Object $o, $content) {
        $header = '<dt class="kint-parent kint-locked">';
        if (Kint_Renderer_Rich::$access_paths && $o->depth > 0 && $ap = $o->getAccessPath()) {
            $header .= '<span class="kint-access-path-trigger" title="Show access path">&rlarr;</span>';
        } $header .= '<span class="kint-popup-trigger" title="Open in new window">&rarr;</span><nav></nav>';
        if (($s = $o->getModifiers()) !== null) {
            $header .= '<var>' . $s . '</var> ';
        } if (($s = $o->getName()) !== null) {
            $header .= '<dfn>' . $this->renderer->escape($s) . '</dfn> ';
            if ($s = $o->getOperator()) {
                $header .= $this->renderer->escape($s, 'ASCII') . ' ';
            }
        } if (($s = $o->getType()) !== null) {
            $s = $this->renderer->escape($s);
            if ($o->reference) {
                $s = '&amp;' . $s;
            } $header .= '<var>' . $s . '</var> ';
        } if (($s = $o->getSize()) !== null) {
            $header .= '(' . $this->renderer->escape($s) . ') ';
        } $header .= $content;
        if (!empty($ap)) {
            $header .= '<div class="access-path">' . $this->renderer->escape($ap) . '</div>';
        } return $header . '</dt>';
    }

    public static function renderLockedHeader(Kint_Object $o, $content) {
        static $show_dep = true;
        if ($show_dep) {
            trigger_error('Kint_Renderer_Rich_Plugin::renderLockedHeader() is deprecated and will be removed in Kint 3.0. Use renderHeaderLocked instead.', KINT_PHP53 ? E_USER_DEPRECATED : E_USER_NOTICE);
            $show_dep = false;
        } $header = '<dt class="kint-parent kint-locked">';
        if (Kint_Renderer_Rich::$access_paths && $o->depth > 0 && $ap = $o->getAccessPath()) {
            $header .= '<span class="kint-access-path-trigger" title="Show access path">&rlarr;</span>';
        } $header .= '<span class="kint-popup-trigger" title="Open in new window">&rarr;</span><nav></nav>';
        if (($s = $o->getModifiers()) !== null) {
            $header .= '<var>' . $s . '</var> ';
        } if (($s = $o->getName()) !== null) {
            $header .= '<dfn>' . Kint_Object_Blob::escape($s) . '</dfn> ';
            if ($s = $o->getOperator()) {
                $header .= Kint_Object_Blob::escape($s, 'ASCII') . ' ';
            }
        } if (($s = $o->getType()) !== null) {
            $s = Kint_Object_Blob::escape($s);
            if ($o->reference) {
                $s = '&amp;' . $s;
            } $header .= '<var>' . $s . '</var> ';
        } if (($s = $o->getSize()) !== null) {
            $header .= '(' . Kint_Object_Blob::escape($s) . ') ';
        } $header .= $content;
        if (!empty($ap)) {
            $header .= '<div class="access-path">' . Kint_Object_Blob::escape($ap) . '</div>';
        } return $header . '</dt>';
    }

    abstract public function render($o);
}

class Kint_Renderer_Rich_Recursion extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        return '<dl>' . $this->renderHeaderLocked($o, '<var>Recursion</var>') . '</dl>';
    }

}

class Kint_Renderer_Rich_SimpleXMLElement extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        $children = $this->renderer->renderChildren($o);
        $header = '';
        if (($s = $o->getModifiers()) !== null) {
            $header .= '<var>' . $s . '</var> ';
        } if (($s = $o->getName()) !== null) {
            $header .= '<dfn>' . $this->renderer->escape($s) . '</dfn> ';
            if ($s = $o->getOperator()) {
                $header .= $this->renderer->escape($s, 'ASCII') . ' ';
            }
        } if (($s = $o->getType()) !== null) {
            $s = $this->renderer->escape($s);
            if ($o->reference) {
                $s = '&amp;' . $s;
            } $header .= '<var>' . $this->renderer->escape($s) . '</var> ';
        } if (($s = $o->getSize()) !== null) {
            $header .= '(' . $this->renderer->escape($s) . ') ';
        } if ($s === null && $c = $o->getRepresentation('contents')) {
            $c = reset($c->contents);
            if ($c && ($s = $c->getValueShort()) !== null) {
                if (Kint_Renderer_Rich::$strlen_max && Kint_Object_Blob::strlen($s) > Kint_Renderer_Rich::$strlen_max) {
                    $s = substr($s, 0, Kint_Renderer_Rich::$strlen_max) . '...';
                } $header .= $this->renderer->escape($s);
            }
        } $header = $this->renderer->renderHeaderWrapper($o, (bool) strlen($children), $header);
        return '<dl>' . $header . $children . '</dl>';
    }

}

class Kint_Renderer_Rich_Source extends Kint_Renderer_Rich_Plugin {

    public function render($r) {
        if (!($r instanceof Kint_Object_Representation_Source) || empty($r->source)) {
            return false;
        } $source = $r->source;
        foreach ($source as $linenum => $line) {
            if (trim($line) || $linenum === $r->line) {
                break;
            } else {
                unset($source[$linenum]);
            }
        } foreach (array_reverse($source, true) as $linenum => $line) {
            if (trim($line) || $linenum === $r->line) {
                break;
            } else {
                unset($source[$linenum]);
            }
        } $start = '';
        $highlight = '';
        $end = '';
        foreach ($source as $linenum => $line) {
            if ($linenum < $r->line) {
                $start .= $line . "\n";
            } elseif ($linenum === $r->line) {
                $highlight = '<div class="kint-highlight">' . $this->renderer->escape($line) . '</div>';
            } else {
                $end .= $line . "\n";
            }
        } $output = $this->renderer->escape($start) . $highlight . $this->renderer->escape(substr($end, 0, -1));
        if ($output) {
            reset($source);
            return '<pre class="kint-source" data-kint-sourcerange="@@ ' . ((int) key($source)) . ',' . count($source) . ' @@">' . $output . '</pre>';
        }
    }

}

class Kint_Renderer_Rich_Table extends Kint_Renderer_Rich_Plugin {

    public static $respect_str_length = true;

    public function render($r) {
        $out = '<pre><table><thead><tr><th></th>';
        $firstrow = reset($r->contents);
        foreach ($firstrow->value->contents as $field) {
            $out .= '<th>' . $this->renderer->escape($field->name) . '</th>';
        } $out .= '</tr></thead><tbody>';
        foreach ($r->contents as $row) {
            $out .= '<tr><th>';
            $out .= $this->renderer->escape($row->name);
            $out .= '</th>';
            foreach ($row->value->contents as $field) {
                $out .= '<td';
                $type = '';
                $size = '';
                $ref = '';
                if (($s = $field->getType()) !== null) {
                    $type = $this->renderer->escape($s);
                    if ($field->reference) {
                        $ref = '&amp;';
                        $type = $ref . $type;
                    } if (($s = $field->getSize()) !== null) {
                        $size .= ' (' . $this->renderer->escape($s) . ')';
                    }
                } if ($type) {
                    $out .= ' title="' . $type . $size . '"';
                } $out .= '>';
                switch ($field->type) {
                    case 'boolean': $out .= $field->value->contents ? '<var>' . $ref . 'true</var>' : '<var>' . $ref . 'false</var>';
                        break;
                    case 'integer': case 'double': $out .= (string) $field->value->contents;
                    break;
                    case 'null': $out .= '<var>' . $ref . 'null</var>';
                        break;
                    case 'string': $val = $field->value->contents;
                        if (Kint_Renderer_Rich::$strlen_max && self::$respect_str_length && Kint_Object_Blob::strlen($val) > Kint_Renderer_Rich::$strlen_max) {
                            $val = substr($val, 0, Kint_Renderer_Rich::$strlen_max) . '...';
                        } $out .= $this->renderer->escape($val);
                        break;
                    case 'array': $out .= '<var>' . $ref . 'array</var>' . $size;
                        break;
                    case 'object': $out .= '<var>' . $ref . $this->renderer->escape($field->classname) . '</var>' . $size;
                        break;
                    case 'resource': $out .= '<var>' . $ref . 'resource</var>';
                        break;
                    default: $out .= '<var>' . $ref . 'unknown</var>';
                        break;
                } if (in_array('blacklist', $field->hints)) {
                    $out .= ' <var>Blacklisted</var>';
                } elseif (in_array('recursion', $field->hints)) {
                    $out .= ' <var>Recursion</var>';
                } elseif (in_array('depth_limit', $field->hints)) {
                    $out .= ' <var>Depth Limit</var>';
                } $out .= '</td>';
            } $out .= '</tr>';
        } $out .= '</tbody></table></pre>';
        return $out;
    }

}

class Kint_Renderer_Rich_Timestamp extends Kint_Renderer_Rich_Plugin {

    public function render($r) {
        return '<pre>' . @date('Y-m-d H:i:s', $r->contents) . '</pre>';
    }

}

class Kint_Renderer_Rich_TraceFrame extends Kint_Renderer_Rich_Plugin {

    public function render($o) {
        $children = $this->renderer->renderChildren($o);
        if (!($o instanceof Kint_Object_TraceFrame)) {
            $header = $this->renderer->renderHeader($o);
        } else {
            if (!empty($o->trace['file']) && !empty($o->trace['line'])) {
                $header = '<var>' . $this->renderer->escape(Kint::shortenPath($o->trace['file'])) . ':' . (int) $o->trace['line'] . '</var> ';
            } else {
                $header = '<var>PHP internal call</var> ';
            } if ($o->trace['class']) {
                $header .= $this->renderer->escape($o->trace['class'] . $o->trace['type']);
            } if (is_string($o->trace['function'])) {
                $function = $this->renderer->escape($o->trace['function'] . '()');
            } else {
                $function = $this->renderer->escape($o->trace['function']->getName() . '(' . $o->trace['function']->getParams() . ')');
                if (($url = $o->trace['function']->getPhpDocUrl()) !== null) {
                    $function = '<a href="' . $url . '" target=_blank>' . $function . '</a>';
                }
            } $header .= '<dfn>' . $function . '</dfn>';
        } $header = $this->renderer->renderHeaderWrapper($o, (bool) strlen($children), $header);
        return '<dl>' . $header . $children . '</dl>';
    }

}

class Kint_Renderer_Text_Blacklist extends Kint_Renderer_Text_Plugin {

    public function render($o) {
        $out = '';
        if ($o->depth == 0) {
            $out .= $this->renderer->colorTitle($this->renderer->renderTitle($o)) . PHP_EOL;
        } $out .= $this->renderer->renderHeader($o) . ' ' . $this->renderer->colorValue('BLACKLISTED') . PHP_EOL;
        return $out;
    }

}

class Kint_Renderer_Text_DepthLimit extends Kint_Renderer_Text_Plugin {

    public function render($o) {
        $out = '';
        if ($o->depth == 0) {
            $out .= $this->renderer->colorTitle($this->renderer->renderTitle($o)) . PHP_EOL;
        } $out .= $this->renderer->renderHeader($o) . ' ' . $this->renderer->colorValue('DEPTH LIMIT') . PHP_EOL;
        return $out;
    }

}

class Kint_Renderer_Text_Nothing extends Kint_Renderer_Text_Plugin {

    public function render($o) {
        if (Kint_Renderer_Text::$decorations) {
            return $this->renderer->colorTitle($this->renderer->boxText('No argument', $this->renderer->header_width)) . PHP_EOL;
        } else {
            return $this->renderer->colorTitle('No argument') . PHP_EOL;
        }
    }

}

abstract class Kint_Renderer_Text_Plugin {

    protected $renderer;

    public function __construct(Kint_Renderer_Text $r) {
        $this->renderer = $r;
    }

    abstract public function render($o);
}

class Kint_Renderer_Text_Recursion extends Kint_Renderer_Text_Plugin {

    public function render($o) {
        $out = '';
        if ($o->depth == 0) {
            $out .= $this->renderer->colorTitle($this->renderer->renderTitle($o)) . PHP_EOL;
        } $out .= $this->renderer->renderHeader($o) . ' ' . $this->renderer->colorValue('RECURSION') . PHP_EOL;
        return $out;
    }

}

class Kint_Renderer_Text_Trace extends Kint_Renderer_Text_Plugin {

    public function render($o) {
        $out = '';
        if ($o->depth == 0) {
            $out .= $this->renderer->colorTitle($this->renderer->renderTitle($o)) . PHP_EOL;
        } $out .= $this->renderer->renderHeader($o) . ':' . PHP_EOL;
        $indent = str_repeat(' ', ($o->depth + 1) * $this->renderer->indent_width);
        $i = 1;
        foreach ($o->value->contents as $frame) {
            $framedesc = $indent . str_pad($i . ': ', 4, ' ');
            if ($frame->trace['file']) {
                $framedesc .= $this->renderer->ideLink($frame->trace['file'], $frame->trace['line']) . PHP_EOL;
            } else {
                $framedesc .= 'PHP internal call' . PHP_EOL;
            } $framedesc .= $indent . '    ';
            if ($frame->trace['class']) {
                $framedesc .= $this->renderer->escape($frame->trace['class']);
                if ($frame->trace['object']) {
                    $framedesc .= $this->renderer->escape('->');
                } else {
                    $framedesc .= '::';
                }
            } if (is_string($frame->trace['function'])) {
                $framedesc .= $this->renderer->escape($frame->trace['function']) . '(...)';
            } elseif ($frame->trace['function'] instanceof Kint_Object_Method) {
                $framedesc .= $this->renderer->escape($frame->trace['function']->getName());
                $framedesc .= '(' . $this->renderer->escape($frame->trace['function']->getParams()) . ')';
            } $out .= $this->renderer->colorType($framedesc) . PHP_EOL . PHP_EOL;
            if ($source = $frame->getRepresentation('source')) {
                $line_wanted = $source->line;
                $source = $source->source;
                foreach ($source as $linenum => $line) {
                    if (trim($line) || $linenum === $line_wanted) {
                        break;
                    } else {
                        unset($source[$linenum]);
                    }
                } foreach (array_reverse($source, true) as $linenum => $line) {
                    if (trim($line) || $linenum === $line_wanted) {
                        break;
                    } else {
                        unset($source[$linenum]);
                    }
                } foreach ($source as $lineno => $line) {
                    if ($lineno == $line_wanted) {
                        $out .= $indent . $this->renderer->colorValue($this->renderer->escape($line)) . PHP_EOL;
                    } else {
                        $out .= $indent . $this->renderer->escape($line) . PHP_EOL;
                    }
                }
            } ++$i;
        } return $out;
    }

}

Kint::$file_link_format = ini_get('xdebug.file_link_format');
if (isset($_SERVER['DOCUMENT_ROOT'])) {
    Kint::$app_root_dirs = array($_SERVER['DOCUMENT_ROOT'] => '<ROOT>', realpath($_SERVER['DOCUMENT_ROOT']) => '<ROOT>',);
}

Kint_Renderer_Rich::$pre_render_sources['script'] = array(0 => 'void 0===window.kintRich&&(window.kintRich=function(){"use strict";var e={selectText:function(e){var t=window.getSelection(),a=document.createRange();a.selectNodeContents(e.lastChild),a.setStart(e.firstChild,0),t.removeAllRanges(),t.addRange(a)},each:function(e,t){Array.prototype.slice.call(document.querySelectorAll(e),0).forEach(t)},hasClass:function(e,t){return!!e.classList&&(void 0===t&&(t="kint-show"),e.classList.contains(t))},addClass:function(e,t){void 0===t&&(t="kint-show"),e.classList.add(t)},removeClass:function(e,t){return void 0===t&&(t="kint-show"),e.classList.remove(t),e},toggle:function(t,a){var o=e.getChildren(t);o&&(void 0===a&&(a=e.hasClass(t)),a?e.removeClass(t):e.addClass(t),1===o.childNodes.length&&(o=o.childNodes[0].childNodes[0])&&e.hasClass(o,"kint-parent")&&e.toggle(o,a))},toggleChildren:function(t,a){var o=e.getChildren(t);if(o){var r=o.getElementsByClassName("kint-parent"),s=r.length;for(void 0===a&&(a=!e.hasClass(t));s--;)e.toggle(r[s],a)}},toggleAll:function(t){for(var a=document.getElementsByClassName("kint-parent"),o=a.length,r=!e.hasClass(t.parentNode);o--;)e.toggle(a[o],r)},switchTab:function(t){var a,o=t.previousSibling,r=0;for(t.parentNode.getElementsByClassName("kint-active-tab")[0].className="",t.className="kint-active-tab";o;)1===o.nodeType&&r++,o=o.previousSibling;a=t.parentNode.nextSibling.childNodes;for(var s=0;s<a.length;s++)s===r?(a[s].style.display="block",1===a[s].childNodes.length&&(o=a[s].childNodes[0].childNodes[0])&&e.hasClass(o,"kint-parent")&&e.toggle(o,!1)):a[s].style.display="none"},mktag:function(e){return"<"+e+">"},openInNewWindow:function(t){var a=window.open();a&&(a.document.open(),a.document.write(e.mktag("html")+e.mktag("head")+e.mktag("title")+"Kint ("+(new Date).toISOString()+")"+e.mktag("/title")+e.mktag(\'meta charset="utf-8"\')+document.getElementsByClassName("kint-script")[0].outerHTML+document.getElementsByClassName("kint-style")[0].outerHTML+e.mktag("/head")+e.mktag("body")+\'<input style="width: 100%" placeholder="Take some notes!"><div class="kint-rich">\'+t.parentNode.outerHTML+"</div>"+e.mktag("/body")),a.document.close())},sortTable:function(e,t){var a=e.tBodies[0];[].slice.call(e.tBodies[0].rows).sort(function(e,a){if(e=e.cells[t].textContent.trim().toLocaleLowerCase(),a=a.cells[t].textContent.trim().toLocaleLowerCase(),isNaN(e)||isNaN(a)){if(isNaN(e)&&!isNaN(a))return 1;if(isNaN(a)&&!isNaN(e))return-1}else e=parseFloat(e),a=parseFloat(a);return e<a?-1:e>a?1:0}).forEach(function(e){a.appendChild(e)})},showAccessPath:function(t){for(var a=t.childNodes,o=0;o<a.length;o++)if(e.hasClass(a[o],"access-path"))return void(e.hasClass(a[o],"kint-show")?e.removeClass(a[o]):(e.addClass(a[o]),e.selectText(a[o])))},getParentByClass:function(t,a){for(void 0===a&&(a="kint-rich");(t=t.parentNode)&&!e.hasClass(t,a););return t},getParentHeader:function(t,a){for(var o=t.nodeName.toLowerCase();"dd"!==o&&"dt"!==o&&e.getParentByClass(t);)t=t.parentNode,o=t.nodeName.toLowerCase();return e.getParentByClass(t)?("dd"===o&&a&&(t=t.previousElementSibling),t&&"dt"===t.nodeName.toLowerCase()&&e.hasClass(t,"kint-parent")?t:void 0):null},getChildren:function(e){do{e=e.nextElementSibling}while(e&&"dd"!==e.nodeName.toLowerCase());return e},keyboardNav:{targets:[],target:0,active:!1,fetchTargets:function(){e.keyboardNav.targets=[],e.each(".kint-rich nav, .kint-tabs>li:not(.kint-active-tab)",function(t){0===t.offsetWidth&&0===t.offsetHeight||e.keyboardNav.targets.push(t)})},sync:function(t){var a=document.querySelector(".kint-focused");if(a&&e.removeClass(a,"kint-focused"),e.keyboardNav.active){var o=e.keyboardNav.targets[e.keyboardNav.target];e.addClass(o,"kint-focused"),t||e.keyboardNav.scroll(o)}},scroll:function(e){var t=function(e){return e.offsetTop+(e.offsetParent?t(e.offsetParent):0)},a=t(e)-window.innerHeight/2;window.scrollTo(0,a)},moveCursor:function(t){for(e.keyboardNav.target+=t;e.keyboardNav.target<0;)e.keyboardNav.target+=e.keyboardNav.targets.length;for(;e.keyboardNav.target>=e.keyboardNav.targets.length;)e.keyboardNav.target-=e.keyboardNav.targets.length;e.keyboardNav.sync()},setCursor:function(t){e.keyboardNav.fetchTargets();for(var a=0;a<e.keyboardNav.targets.length;a++)if(t===e.keyboardNav.targets[a])return e.keyboardNav.target=a,!0;return!1}},mouseNav:{lastClickTarget:null,lastClickTimer:null,lastClickCount:0,renewLastClick:function(){window.clearTimeout(e.mouseNav.lastClickTimer),e.mouseNav.lastClickTimer=window.setTimeout(function(){e.mouseNav.lastClickTarget=null,e.mouseNav.lastClickTimer=null,e.mouseNav.lastClickCount=0},250)}}};return window.addEventListener("click",function(t){var a=t.target,o=a.nodeName.toLowerCase();if(e.mouseNav.lastClickTarget&&e.mouseNav.lastClickTimer&&e.mouseNav.lastClickCount)return a=e.mouseNav.lastClickTarget,1===e.mouseNav.lastClickCount?(e.toggleChildren(a.parentNode),e.keyboardNav.setCursor(a),e.keyboardNav.sync(!0),e.mouseNav.lastClickCount++,e.mouseNav.renewLastClick()):(e.toggleAll(a),e.keyboardNav.setCursor(a),e.keyboardNav.sync(!0),e.keyboardNav.scroll(a),window.clearTimeout(e.mouseNav.lastClickTimer),e.mouseNav.lastClickTarget=null,e.mouseNav.lastClickTarget=null,e.mouseNav.lastClickCount=0),!1;if(e.getParentByClass(a)){if("dfn"===o)e.selectText(a);else if("th"===o)return t.ctrlKey||e.sortTable(a.parentNode.parentNode.parentNode,a.cellIndex),!1;if(a=e.getParentHeader(a),a&&(e.keyboardNav.setCursor(a.querySelector("nav")),e.keyboardNav.sync(!0)),a=t.target,"li"===o&&"kint-tabs"===a.parentNode.className)return"kint-active-tab"!==a.className&&e.switchTab(a),a=e.getParentHeader(a,!0),a&&(e.keyboardNav.setCursor(a.querySelector("nav")),e.keyboardNav.sync(!0)),!1;if("nav"===o)return"footer"===a.parentNode.nodeName.toLowerCase()?(e.keyboardNav.setCursor(a),e.keyboardNav.sync(!0),a=a.parentNode,e.hasClass(a)?e.removeClass(a):e.addClass(a)):(e.toggle(a.parentNode),e.keyboardNav.fetchTargets(),e.mouseNav.lastClickCount=1,e.mouseNav.lastClickTarget=a,e.mouseNav.renewLastClick()),!1;if(e.hasClass(a,"kint-ide-link")){var r=new XMLHttpRequest;return r.open("GET",a.href),r.send(null),!1}if(e.hasClass(a,"kint-popup-trigger")){var s=a.parentNode;if("footer"===s.nodeName.toLowerCase())s=s.previousSibling;else for(;s&&!e.hasClass(s,"kint-parent");)s=s.parentNode;e.openInNewWindow(s)}else{if(e.hasClass(a,"kint-access-path-trigger"))return e.showAccessPath(a.parentNode),!1;if("pre"===o&&3===t.detail)e.selectText(a);else if(e.getParentByClass(a,"kint-source")&&3===t.detail)e.selectText(e.getParentByClass(a,"kint-source"));else if(e.hasClass(a,"access-path"))e.selectText(a);else if("a"!==o)return a=e.getParentHeader(a),a&&(e.toggle(a),e.keyboardNav.fetchTargets()),!1}}},!1),window.onkeydown=function(t){if(t.target===document.body&&!t.altKey&&!t.ctrlKey){if(68===t.keyCode){if(e.keyboardNav.active)e.keyboardNav.active=!1;else if(e.keyboardNav.active=!0,e.keyboardNav.fetchTargets(),0===e.keyboardNav.targets.length)return e.keyboardNav.active=!1,!0;return e.keyboardNav.sync(),!1}if(!e.keyboardNav.active)return!0;if(9===t.keyCode)return e.keyboardNav.moveCursor(t.shiftKey?-1:1),!1;if(38===t.keyCode||75===t.keyCode)return e.keyboardNav.moveCursor(-1),!1;if(40===t.keyCode||74===t.keyCode)return e.keyboardNav.moveCursor(1),!1;var a=e.keyboardNav.targets[e.keyboardNav.target];if("li"===a.nodeName.toLowerCase()){if(32===t.keyCode||13===t.keyCode)return e.switchTab(a),e.keyboardNav.fetchTargets(),e.keyboardNav.sync(),!1;if(39===t.keyCode||76===t.keyCode)return e.keyboardNav.moveCursor(1),!1;if(37===t.keyCode||72===t.keyCode)return e.keyboardNav.moveCursor(-1),!1}if(a=a.parentNode,65===t.keyCode)return e.showAccessPath(a),!1;if("footer"===a.nodeName.toLowerCase()&&e.hasClass(a.parentNode,"kint-rich")){if(32===t.keyCode||13===t.keyCode)e.hasClass(a)?e.removeClass(a):e.addClass(a);else if(37===t.keyCode||72===t.keyCode)e.removeClass(a);else{if(39!==t.keyCode&&76!==t.keyCode)return!0;e.addClass(a)}return!1}if(32===t.keyCode||13===t.keyCode)return e.toggle(a),e.keyboardNav.fetchTargets(),!1;if(39===t.keyCode||76===t.keyCode||37===t.keyCode||72===t.keyCode){var o=37===t.keyCode||72===t.keyCode;if(e.hasClass(a))e.toggleChildren(a,o),e.toggle(a,o);else{if(o){var r=e.getParentHeader(a.parentNode.parentNode,!0);r&&(a=r,e.keyboardNav.setCursor(a.querySelector("nav")),e.keyboardNav.sync())}e.toggle(a,o)}return e.keyboardNav.fetchTargets(),!1}}},e}());
void 0===window.kintRichMicrotimeInitialized&&(window.kintRichMicrotimeInitialized=1,window.addEventListener("load",function(){"use strict";var i={},t=Array.prototype.slice.call(document.querySelectorAll("[data-kint-microtime-group]"),0);t.forEach(function(t){if(t.querySelector(".kint-microtime-lap")){var e=t.getAttribute("data-kint-microtime-group"),r=parseFloat(t.querySelector(".kint-microtime-lap").innerHTML),o=parseFloat(t.querySelector(".kint-microtime-avg").innerHTML);void 0===i[e]&&(i[e]={}),(void 0===i[e].min||i[e].min>r)&&(i[e].min=r),(void 0===i[e].max||i[e].max<r)&&(i[e].max=r),i[e].avg=o}}),t=Array.prototype.slice.call(document.querySelectorAll("[data-kint-microtime-group]>.kint-microtime-lap"),0),t.forEach(function(t){var e,r=t.parentNode.getAttribute("data-kint-microtime-group"),o=parseFloat(t.innerHTML),a=i[r].avg,n=i[r].max,c=i[r].min;t.parentNode.querySelector(".kint-microtime-avg").innerHTML=a,o===a&&o===c&&o===n||(o>a?(e=(o-a)/(n-a),t.style.background="hsl("+(40-40*e)+", 100%, 65%)"):(e=a===c?0:(a-o)/(a-c),t.style.background="hsl("+(40+80*e)+", 100%, 65%)"))})}));
',);
Kint_Renderer_Plain::$pre_render_sources['style'] = array(0 => '.kint-plain{background:rgba(255,255,255,0.9);white-space:pre;display:block;font-family:monospace}.kint-plain i{color:#d00;font-style:normal}.kint-plain u{color:#030;text-decoration:none;font-weight:bold}
',);
Kint_Renderer_Rich::$pre_render_sources['style'] = array(
    0 => '.kint-rich{font-size:13px;overflow-x:auto;white-space:nowrap;background:rgba(255,255,255,0.9)}.kint-rich::selection,.kint-rich::-moz-selection,.kint-rich::-webkit-selection{background:#0092db;color:#1d1e1e}.kint-rich .kint-focused{box-shadow:0 0 3px 2px #5cb730}.kint-rich,.kint-rich::before,.kint-rich::after,.kint-rich *,.kint-rich *::before,.kint-rich *::after{box-sizing:border-box;border-radius:0;color:#1d1e1e;float:none !important;font-family:Consolas, Menlo, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace, serif;line-height:15px;margin:0;padding:0;text-align:left}.kint-rich{margin:8px 0}.kint-rich dt,.kint-rich dl{width:auto}.kint-rich dt,.kint-rich div.access-path{background:#e0eaef;border:1px solid #b6cedb;color:#1d1e1e;display:block;font-weight:bold;list-style:none outside none;overflow:auto;padding:4px}.kint-rich dt:hover,.kint-rich div.access-path:hover{border-color:#0092db}.kint-rich li>dl>dt>.kint-popup-trigger,.kint-rich li>dl>dt>.kint-access-path-trigger{background:rgba(224,234,239,0.8)}.kint-rich>dl dl{padding:0 0 0 12px}.kint-rich dt.kint-parent>nav,.kint-rich>footer>nav{background:url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 150"><g stroke-width="2" fill="%23FFF"><path d="M1 1h28v28H1zm5 14h18m-9 9V6M1 61h28v28H1zm5 14h18" stroke="%23379"/><path d="M1 31h28v28H1zm5 14h18m-9 9V36M1 91h28v28H1zm5 14h18" stroke="%235A3"/><path d="M1 121h28v28H1zm5 5l18 18m-18 0l18-18" stroke="%23CCC"/></g></svg>\') no-repeat scroll 0 0/100% auto transparent;cursor:pointer;display:inline-block;height:15px;width:15px;margin-right:3px;vertical-align:middle}.kint-rich dt.kint-parent:hover>nav,.kint-rich>footer>nav:hover{background-position:0 25%}.kint-rich dt.kint-parent.kint-show>nav,.kint-rich>footer.kint-show>nav{background-position:0 50%}.kint-rich dt.kint-parent.kint-show:hover>nav,.kint-rich>footer.kint-show>nav:hover{background-position:0 75%}.kint-rich>footer>nav,.kint-rich dt.kint-parent>nav{background:url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 150"><g stroke-width="2" fill="%23FFF"><path d="M1 1h28v28H1zm5 14h18m-9 9V6M1 61h28v28H1zm5 14h18" stroke="%23379"/><path d="M1 31h28v28H1zm5 14h18m-9 9V36M1 91h28v28H1zm5 14h18" stroke="%235A3"/><path d="M1 121h28v28H1zm5 5l18 18m-18 0l18-18" stroke="%23CCC"/></g></svg>\') no-repeat scroll 0 0/100% auto transparent;cursor:pointer;display:inline-block;height:15px;width:15px;margin-right:3px;vertical-align:middle}.kint-rich>footer.kint-locked>nav,.kint-rich dt.kint-parent.kint-locked>nav{background-position:0 100%}.kint-rich dt.kint-parent+dd{display:none;border-left:1px dashed #b6cedb}.kint-rich dt.kint-parent.kint-show+dd{display:block}.kint-rich var,.kint-rich var a{color:#0092db;font-style:normal}.kint-rich dt:hover var,.kint-rich dt:hover var a{color:#5cb730}.kint-rich dfn{font-style:normal;font-family:monospace;color:#1d1e1e}.kint-rich pre{color:#1d1e1e;margin:0 0 0 12px;padding:5px;overflow-y:hidden;border-top:0;border:1px solid #b6cedb;background:#e0eaef;display:block;word-break:normal}.kint-rich .kint-popup-trigger,.kint-rich .kint-access-path-trigger{float:right !important;cursor:pointer;padding:0 3px;color:#0092db;position:relative}.kint-rich .kint-popup-trigger:hover,.kint-rich .kint-access-path-trigger:hover{color:#b6cedb}.kint-rich dt.kint-parent>.kint-popup-trigger{font-size:13px}.kint-rich div.access-path{background:#c1d4df;display:none;margin-top:5px;padding:4px;white-space:pre}.kint-rich div.access-path.kint-show{display:block}.kint-rich footer{padding:0 3px 3px;font-size:9px}.kint-rich footer>.kint-popup-trigger{font-size:12px}.kint-rich footer nav{height:10px;width:10px}.kint-rich footer>ol{display:none;margin-left:32px}.kint-rich footer.kint-show>ol{display:block}.kint-rich a{color:#1d1e1e;text-shadow:none;text-decoration:underline}.kint-rich a:hover{color:#1d1e1e;border-bottom:1px dotted #1d1e1e}.kint-rich ul{list-style:none;padding-left:12px}.kint-rich ul:not(.kint-tabs) li{border-left:1px dashed #b6cedb}.kint-rich ul:not(.kint-tabs) li>dl{border-left:none}.kint-rich ul.kint-tabs{margin:0 0 0 12px;padding-left:0;background:#e0eaef;border:1px solid #b6cedb;border-top:0}.kint-rich ul.kint-tabs>li{background:#c1d4df;border:1px solid #b6cedb;cursor:pointer;display:inline-block;height:24px;margin:2px;padding:0 12px;vertical-align:top}.kint-rich ul.kint-tabs>li:hover,.kint-rich ul.kint-tabs>li.kint-active-tab:hover{border-color:#0092db;color:#5cb730}.kint-rich ul.kint-tabs>li.kint-active-tab{background:#e0eaef;border-top:0;margin-top:-1px;height:27px;line-height:24px}.kint-rich ul.kint-tabs>li:not(.kint-active-tab){line-height:20px}.kint-rich ul.kint-tabs li+li{margin-left:0}.kint-rich ul:not(.kint-tabs)>li:not(:first-child){display:none}.kint-rich dt:hover+dd>ul>li.kint-active-tab{border-color:#0092db;color:#5cb730}.kint-rich dt>.kint-color-preview{width:16px;height:16px;display:inline-block;vertical-align:middle;margin-left:10px;border:1px solid #b6cedb;background-color:#ccc;background-image:url(\'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2 2"><path fill="%23FFF" d="M0 0h1v2h1V1H0z"/></svg>\');background-size:100%}.kint-rich dt>.kint-color-preview:hover{border-color:#0092db}.kint-rich dt>.kint-color-preview>div{width:100%;height:100%}.kint-rich table{border-collapse:collapse;empty-cells:show;border-spacing:0}.kint-rich table *{font-size:12px}.kint-rich table dt{background:none;padding:2px}.kint-rich table dt .kint-parent{min-width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.kint-rich table td,.kint-rich table th{border:1px solid #b6cedb;padding:2px;vertical-align:center}.kint-rich table th{cursor:alias}.kint-rich table td:first-child,.kint-rich table th{font-weight:bold;background:#c1d4df;color:#1d1e1e}.kint-rich table td{background:#e0eaef;white-space:pre}.kint-rich table td>dl{padding:0}.kint-rich table pre{border-top:0;border-right:0}.kint-rich table thead th:first-child{background:none;border:0}.kint-rich table tr:hover>td{box-shadow:0 0 1px 0 #0092db inset}.kint-rich table tr:hover var{color:#5cb730}.kint-rich table ul.kint-tabs li.kint-active-tab{height:20px;line-height:17px}.kint-rich pre.kint-source{margin-left:-1px}.kint-rich pre.kint-source:before{display:block;content:attr(data-kint-sourcerange);margin-bottom:0.5em;padding-bottom:0.5em;border-bottom:1px solid #c1d4df}.kint-rich pre.kint-source>div.kint-highlight{background:#c1d4df}.kint-rich .kint-microtime-lap{box-shadow:0 0 2px 0 #b6cedb;height:16px;text-align:center;text-shadow:-1px 0 #839496, 0 1px #839496, 1px 0 #839496, 0 -1px #839496;width:230px;color:#fdf6e3}.kint-rich>dl>dt{background:linear-gradient(to bottom, #e3ecf0 0, #c0d4df 100%)}.kint-rich ul.kint-tabs{background:linear-gradient(to bottom, #9dbed0 0px, #b2ccda 100%)}.kint-rich>dl:not(.kint-trace)>dd>ul.kint-tabs li{background:#e0eaef}.kint-rich>dl:not(.kint-trace)>dd>ul.kint-tabs li.kint-active-tab{background:#c1d4df}.kint-rich>dl.kint-trace>dt{background:linear-gradient(to bottom, #c0d4df 0px, #e3ecf0 100%)}.kint-rich .kint-source .kint-highlight{background:#f0eb96}
',
);
 
