<?php
/**
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass("model_db_abstract");

class ML_Database_Model_Db_Mysqli extends ML_Database_Model_Db_Abstract {

    /**
     * @var false|mysqli
     */
    protected $oInstance = null;

    protected $access = array(
        'type' => '', // [pipe|socket|tcpip]
        'host' => '',
        'user' => '',
        'pass' => '',
        'port' => '', // will only be explicitly set for tcpip connections
        'sock' => '', // will only be explicitly set for non tcpip connections, includes windows pipes
        'persistent' => false,
    );

    public function __construct($access) {
        $this->access = array_merge($this->access, $access);
        $this->detectConnectionType();
    }

    protected function detectConnectionType() {
        if (strpos($this->access['host'], '\\') !== false) {
            $this->access['type'] = 'pipe'; // Windows named pipe based connection. e.g. \\.\pipe\MySQL
            $this->access['sock'] = $this->access['host'];
            $this->access['host'] = '.';
        } else if (strpos($this->access['host'], '.sock') !== false) {
            $this->access['type'] = 'socket'; // Unix domain sockets use the file system as their address name space.
            $msock = array();
            if (preg_match('/^([^\:]+)\:(.*)$/', $this->access['host'], $msock)) {
                $this->access['host'] = $msock[1];
                $this->access['sock'] = $msock[2];
            } else {
                $this->access['sock'] = $this->access['host'];
                $this->access['host'] = '';
            }
        } elseif (!isset($this->access['port'])) {
            $this->access['type'] = 'tcpip';
            $mport = array();
            if (preg_match('/^[^\:]+\:([0-9]+)$/', $this->access['host'], $mport)) {
                $this->access['port'] = (int)$mport[1];
                $this->access['host'] = str_replace(':'.$this->access['port'], '', $this->access['host']);
            } else {
                $this->access['port'] = (int)ini_get('mysqli.default_port');
            }
            if (empty($this->access['port'])) {
                $this->access['port'] = 3306;
            }
        }
        // for non tcpip connections
        if (empty($this->access['port'])) {
            $this->access['port'] = (int)ini_get('mysqli.default_port');
        }
        $this->access['host'] = str_replace(':'.$this->access['port'], '', $this->access['host']);//if the port is added to host it will remove it
    }

    public function isConnected() {
        try {
            // there seems to be no other way than to surpress the error message
            // in order to detect that the connection has been closed,
            // which is a shame.
            //*/
            return is_object($this->oInstance) && @$this->oInstance->ping();


        } catch (Exception $e) {
            MLMessage::gi()->addError($e);
            return false;
        }
    }

    protected $counterman = 0;

    public function connect() {
        ob_start();

        $this->oInstance = mysqli_init();
        $client_flags = 0;

        if (!empty($this->access['encrypt']) && $this->access['encrypt']['ssl']) {
            if ($this->access['encrypt']['ssl_verify']) {
                $client_flags |= MYSQLI_CLIENT_SSL;

                $this->oInstance->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
            }

            if (!empty($this->access['encrypt']['key'])) {
                $client_flags |= MYSQLI_CLIENT_SSL;

                $this->oInstance->ssl_set(
                    isset($this->access['encrypt']['key']) ? $this->access['encrypt']['key'] : null,
                    isset($this->access['encrypt']['cert']) ? $this->access['encrypt']['cert'] : null,
                    isset($this->access['encrypt']['ca']) ? $this->access['encrypt']['ca'] : null,
                    isset($this->access['encrypt']['capath']) ? $this->access['encrypt']['capath'] : null,
                    isset($this->access['encrypt']['cipher']) ? $this->access['encrypt']['cipher'] : null
                );
            }
        }


        switch ($this->access['type']) {
            case 'socket':
            case 'pipe': {
                $this->oInstance->real_connect(
                    ($this->access['persistent'] ? 'p:' : '').$this->access['host'],
                    $this->access['user'], $this->access['pass'], '', (int)$this->access['port'],
                    $this->access['sock'], $client_flags
                );
                break;
            }
            case 'tcpip':
            default: {
                $this->oInstance->real_connect(
                    ($this->access['persistent'] ? 'p:' : '').$this->access['host'],
                    $this->access['user'], $this->access['pass'], '', (int)$this->access['port'],
                    null, $client_flags
                );
                break;
            }
        }
        $warn = ob_get_clean();
        if (!$this->isConnected()) {
            if (
                   ($this->access['type'] == 'tcpip') && ($this->access['host'] == 'localhost')
                || ($this->access['type'] == '') && ($this->access['host'] == 'localhost')
            ) {
                // Fix for broken estugo php config.
                //
                // From: http://stackoverflow.com/questions/13870362/php-mysql-test-database-server
                //
                // This seems to be a common issue, as googling for it yields quite a few results.
                // I experienced this on my two linux boxes as well (never under Windows though) and
                // at some point I resolved to just use 127.0.0.1 on all dev servers. Basically,
                // localhost makes the connection to the MySQL server use a socket, but your
                // configuration doesn't point to the socket file correctly.
                $this->access['type'] = 'tcpip';
                $this->access['host'] = '127.0.0.1';
                return $this->connect();
            }

            if ( //in some case , we should put port at the end of host
                   (strpos($this->access['host'], ':'.$this->access['port']) === false)
                && $this->access['port'] != ''
                && ($this->access['socket'] == '' || strpos($this->access['host'], ':'.$this->access['socket']) !== false)
            ) {
                $this->access['host'] .= ':'.$this->access['port'];
                return $this->connect();
            }

            throw new Exception("Can not connect to database");
        }

        if (!empty($this->charset)) {
            $this->setCharset($this->charset);
        }
    }

    public function close() {

        if ($this->isConnected()) {
            return $this->oInstance->close();
        }
        return false;
    }

    public function getLastErrorMessage() {
        if (is_object($this->oInstance) && isset($this->oInstance->error)) {
            return $this->oInstance->error;
        }
        return '';
    }

    public function getLastErrorNumber() {
        if (is_object($this->oInstance) && isset($this->oInstance->errno)) {
            return $this->oInstance->errno;
        }
        return 0;
    }

    public function getServerInfo() {
        if ($this->isConnected()) {
            return $this->oInstance->server_info;
        }
        return false;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
        if ($this->isConnected()) {
            $this->oInstance->set_charset($this->charset);
        }
    }

    public function query($query) {
        if ($this->isConnected()) {
            return $this->oInstance->query($query);
        }
        return false;
    }

    public function escape($str) {
        if ($this->isConnected()) {
            return $this->oInstance->real_escape_string($str);
        }
        return self::fallbackEscape($str);
    }

    public function affectedRows() {
        if (is_object($this->oInstance) && isset($this->oInstance->affected_rows)) {
            return $this->oInstance->affected_rows;
        }
        // re-establishing a connection doesn't make sense here as the new connection
        // can't return the affected row count of the old connection.
        return false;
    }

    public function getInsertId() {
        if ($this->isConnected()) {
            return $this->oInstance->insert_id;
        }
        // same reason as in $this->affectedRows();
        return false;
    }

    public function isResult($m) {
        return $m instanceof mysqli_result;
    }

    public function numRows($result) {
        return $result->num_rows;
    }

    public function fetchArray($result) {
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    public function freeResult($result) {
        return $result->free_result();
    }
}
