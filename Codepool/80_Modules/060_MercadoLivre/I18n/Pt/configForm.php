<?php
/*
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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->{'mercadolivre_config_account_title'} = 'Dados de Acesso';
MLI18n::gi()->{'mercadolivre_config_account_prepare'} = 'Preparação de Artigos';
MLI18n::gi()->{'mercadolivre_config_account_price'} = 'Cálculo de Preço';
MLI18n::gi()->{'mercadolivre_config_account_sync'} = 'Sincronização de Inventário';
MLI18n::gi()->{'mercadolivre_config_account_orderimport'} = 'Pedidos';
MLI18n::gi()->{'mercadolivre_config_checkin_badshippingcost'} = 'Custo do frete deve ser um número.';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate'} = 'Modelo para E-mail Promocional';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_sender'} = 'Loja Exemplo';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_sender_email'} = 'exemplo@lojaonline.com.br';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_subject'} = 'Seu pedido em #SHOPURL#';
MLI18n::gi()->{'mercadolivre_config_account_emailtemplate_content'} = '  <style>
        <!--body { font: 12px sans-serif; }
        table.ordersummary { width: 100%; border: 1px solid #e8e8e8; }
        table.ordersummary td { padding: 3px 5px; }
        table.ordersummary thead td { background: #cfcfcf; color: #000; font-weight: bold; text-align: center; }
        table.ordersummary thead td.name { text-align: left; }
        table.ordersummary tbody tr.even td { background: #e8e8e8; color: #000; }
        table.ordersummary tbody tr.odd td { background: #f8f8f8; color: #000; }
        table.ordersummary td.price, table.ordersummary td.fprice { text-align: right; white-space: nowrap; }
        table.ordersummary tbody td.qty { text-align: center; }-->
    </style>
    <p>Ol&aacute; #FIRSTNAME# #LASTNAME#,</p>
    <p>Muito obrigado pelo seu pedido! Voc&ecirc; comprou, atrav&eacute;s do #MARKETPLACE#, o seguinte em nossa loja:</p>
    #ORDERSUMMARY#
    <p>Acrescido de eventuais custos de frete.</p>
    <p>Mais ofertas interessantes você encontra em nossa loja em <strong>#SHOPURL#</strong>.</p>
    <p>&nbsp;</p>
    <p>Atenciosamente,</p>
    <p>Sua Loja Online</p>
';
MLI18n::gi()->{'mercadolivre_config_account__legend__account'} = 'Dados de Acesso';
MLI18n::gi()->{'mercadolivre_config_account__legend__tabident'} = '';
MLI18n::gi()->{'mercadolivre_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'mercadolivre_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'mercadolivre_config_account__field__mpusername__label'} = 'Nome do Usu&aacute;rio';
MLI18n::gi()->{'mercadolivre_config_account__field__mppassword__label'} = 'Senha';
MLI18n::gi()->{'mercadolivre_config_account__field__gettoken__label'} = 'Token de Autentica&ccedil;&atilde;o';
MLI18n::gi()->{'mercadolivre_config_account__field__gettoken__help'} = 'Para obter o token de autenticação clique no botão Obter Token, entre com seus dados no MercadoLivre e, quando a janela fechar, clique no botão "Salvar" abaixo. ';
MLI18n::gi()->{'mercadolivre_config_account__field__gettoken__buttontext'} = 'Obter Token';
MLI18n::gi()->{'mercadolivre_config_prepare__legend__prepare'} = 'Prepara&ccedil;&atilde;o dos Artigos';
MLI18n::gi()->{'mercadolivre_config_prepare__legend__upload'} = 'Enviar artigos: configura&ccedil;&atilde; padr&atilde;o';
MLI18n::gi()->{'mercadolivre_config_prepare__field__prepare.status__label'} = 'Filtro de Status';
MLI18n::gi()->{'mercadolivre_config_prepare__field__prepare.status__valuehint'} = 'Apenas processar artigos ativos';
MLI18n::gi()->{'mercadolivre_config_prepare__field__lang__label'} = 'Descri&ccedil;&atilde;o do Artigo';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.status__label'} = 'Filtro de Status';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.status__valuehint'} = 'Apenas processar artigos ativos';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.quantity__label'} = 'Quantidade en Estoque';
MLI18n::gi()->{'mercadolivre_config_prepare__field__checkin.quantity__help'} = 'Informe a quantidade em estoque de um artigo que deve estar dispon&iacute;vel no Marketplace.<br>
                <br>
                Voc&ecirc; pode alterar a quantidade de forma individual diretamente em <i>Enviar</i> - 
                neste caso &eacute; recomend&aacute;vel<br>
                desativar a sincroniza&ccedil;&atilde;o autom&aacute;tica em "<i>Sincroniza&ccedil;&atilde;o de Invent&aacute;rio</i>"
                > "<i>Altera&ccedil;&atilde;o de Estoque na Loja</i>".<br>
                <br>
                A fim de evitar vendas em excesso, voc&ecirc; pode ativar o valor "Utilizar estoque da loja menos o valor do campo
                a direita".<br>
                <br>
                <strong>Exemplo:</strong> Definir valor como "<i>2</i>" resulta em &#8594; Estoque na loja: 10 &#8594;
                Estoque no MercadoLivre: 8<br>
                <br>
                <strong>Observa&ccedil;&atilde;o:</strong> Se você quiser tratar produtos inativos na loja como estoque "<i>0</i>"<br>
                no MercadoLivre, independentemente das quantidades em estoque, por favor proceda conforme abaixo:<br>
                <ul>
                <li>Configurar "<i>Sincroniza&ccedil;&atilde;o do Invent&aacute;rio</i>" &rarr; "<i>Antera&ccedil;&atilde;o de Estoque na
                      Loja</i>" para "<i>sincroniza&ccedil;&atilde;o autom&aacute;tica via CronJob"</i></li>
                <li>Configurar "<i>Configura&ccedil;&atilde;o Global" &rarr; "<i>Status do Produto</i>" &rarr; "<i>Quando produto estiver
                      inativo, a quantidade em estoque será tratada como 0</i>"</li>
                </ul>';
MLI18n::gi()->{'mercadolivre_config_prepare__field__currency__label'} = 'Moeda';
MLI18n::gi()->{'mercadolivre_config_prepare__field__currency__help'} = 'A seleção da moeda será definida por padrão no formul&aacute;rio de login, quando dispon&iacute;vel.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__label'} = 'Condição do item';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__help'} = 'A seleção da condi&ccedl;&atilde;o do item será definida por padrão no formul&aacute;rio de login, quando dispon&iacute;vel.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__'} = '{#i18n:ML_AMAZON_LABEL_APPLY_PLEASE_SELECT#}
';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__new'} = 'Novo';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__not_specified'} = 'N&atilde;o especificado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__itemcondition__values__used'} = 'Usado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__listingtype__label'} = 'Tipo de listagem';
MLI18n::gi()->{'mercadolivre_config_prepare__field__listingtype__help'} = 'A seleção do tipo de listagem será definida por padrão no formul&aacute;rio de login, quando dispon&iacute;vel.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__label'} = 'Modo de compra';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__help'} = 'A seleção do modo de compra será definida por padrão no formul&aacute;rio de login, quando dispon&iacute;vel.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__'} = '{#i18n:ML_AMAZON_LABEL_APPLY_PLEASE_SELECT#}
';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__buy_it_now'} = 'Compre agora';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__auction'} = 'Leil&atilde;o';
MLI18n::gi()->{'mercadolivre_config_prepare__field__buyingmode__values__classified'} = 'Classificado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmodecontainer__label'} = 'M&eacute;todo de envio';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmodecontainer__help'} = 'A seleção do m&eacute;todo de envio será definida por padrão no formul&aacute;rio de login, quando dispon&iacute;vel.';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__label'} = '';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__not_specified'} = 'N&atilde;o especificado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__custom'} = 'Personalizado';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__me1'} = 'MercadoEnvios 1';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmode__values__me2'} = 'MercadoEnvios 2';
MLI18n::gi()->{'mercadolivre_config_prepare__field__shippingmodeajax__label'} = '';
MLI18n::gi()->{'mercadolivre_config_prepare__field__customshipping__keytitle'} = 'Texto para envio';
MLI18n::gi()->{'mercadolivre_config_prepare__field__customshipping__valuetitle'} = 'Custo do frete';
MLI18n::gi()->{'mercadolivre_config_price__legend__price'} = 'C&aacute;lculo do pre&ccedil;o';
MLI18n::gi()->{'mercadolivre_config_price__field__price__label'} = 'Preço';
MLI18n::gi()->{'mercadolivre_config_price__field__price__help'} = 'Informe um valor percentual ou absoluto para acréscimo ou desconto no preço. Descontos com valores negativos. ';
MLI18n::gi()->{'mercadolivre_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'mercadolivre_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'mercadolivre_config_price__field__price.signal__label'} = 'Decimais';
MLI18n::gi()->{'mercadolivre_config_price__field__price.signal__hint'} = 'Valores pós vírgula (Centavos)';
MLI18n::gi()->{'mercadolivre_config_price__field__price.signal__help'} = 'O conteúdo deste campo é utilizado como o valor após a vírgula (centavos) do preço na transferência dos dados para o MercadoLivre.<br><br>
                <strong>Exemplo:</strong><br>
                Conteúdo do campo: 99<br>
                Preço original: 5.58<br>
                Resultado final: 5.99<br><br>
                Esta função ajuda especialmente no caso de acréscimos ou decréscimos percentuais nos preços.<br>
                Deixe este campo vazio se não quiser transferir valores após a vírgula (centavos).<br>
                O formato deste campo é um valor numérico com até duas posições.
            ';
MLI18n::gi()->{'mercadolivre_config_price__field__priceoptions__label'} = 'Opções de preço';
MLI18n::gi()->{'mercadolivre_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'mercadolivre_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'mercadolivre_config_price__field__price.usespecialoffer__label'} = 'utilizar também preços promocionais';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__label'} = 'Câmbio';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__valuehint'} = 'Atualizar câmbio automaticamente';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__help'} = '                Se função estiver ativa: no caso da moeda na loja diferir daquela do Marketplace, durante a transmissão de dados
                o preço será convertido automaticamente utilizando-se a taxa de câmbio atual informada pelo "alphavantage".<br><br>
		<b>Aviso:</b> A RedGecko GmbH não assume qualquer responsabilidade pela validade da taxa de câmbio. 
                Por favor verifique os valores transmitidos na sua conta no MercadoLivre.';
MLI18n::gi()->{'mercadolivre_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'mercadolivre_config_sync__legend__sync'} = 'Sincronização de Inventário';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.tomarketplace__label'} = 'Alteração de estoque na loja';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.tomarketplace__help'} = '                <p>
                    A função "Sincronização Automática" ajusta, a cada 4 horas (começando às 0:00), o estoque no MercadoLivre
                    ao estoque da loja (com eventual decréscimo, conforme configuração).<br>
                    Durante esta operação os valores contidos na base de dados são verificados e enviados, mesmo que esta mudança
                    tenha sido efetuada somente na base de dados (por exemplo por um ERP).<br><br>
                    Uma sincronização manual pode ser iniciada clicando-se no botão correspondente no topo da página do magnalister
                    (à esquerda da formiga).<br><br>
                    Adicionalmente, uma sincronização de estoque também pode ser disparada através de um CronJob (a partir da tarifa
                    Flat - com intervalo mínimo de 15 minutos). Para isto, siga o seguinte link para a sua loja: <br>                   
                    <i>{#setting:sSyncInventoryUrl#}</i><br>
                    Disparos de CronJobs por clientes fora da tarifa Flat ou com intervalos inferiores a 15 minutos são bloqueados.<br><br>
                    <b>Observação:</b> as configurações definidas em "Configuração" &rarr; "Configuração de Envio" &rarr;
                    "Quantidade em Estoque" são respeitadas.  
                </p>
            ';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.frommarketplace__label'} = 'Alteração de estoque no MercadoLivre';
MLI18n::gi()->{'mercadolivre_config_sync__field__stocksync.frommarketplace__help'} = '               Se no MercadoLivre forem vendidos, por exemplo, 3 artigos, o estoque na loja será também decrescido de 3.<br><br>
               <strong>Importante:</strong> Esta função é executada somente se a Importação de pedidos estiver ativa!';
MLI18n::gi()->{'mercadolivre_config_sync__field__inventorysync.price__label'} = 'Preço do artigo';
MLI18n::gi()->{'mercadolivre_config_sync__field__inventorysync.price__help'} = '                 <p>
                     A função "Sincronização Automática" ajusta, a cada 4 horas (começando às 0:00), o preço no MercadoLivre com o
                     preço atual na loja.<br>
                     Durante esta operação os valores contidos na base de dados são verificados e enviados, mesmo que esta mudança
                     tenha ocorrido somente na base de dados (por exemplo através de um ERP).<br><br>
                     <b>Observação:</b> as configurações definidas em "Configuração" &rarr; "Cálculo de Preços" são respeitadas.  
                 </p>
            ';
MLI18n::gi()->{'mercadolivre_config_orderimport__legend__importactive'} = 'Importação de Pedidos';
MLI18n::gi()->{'mercadolivre_config_orderimport__legend__mwst'} = 'Imposto';
MLI18n::gi()->{'mercadolivre_config_orderimport__legend__orderstatus'} = 'Sincronização da situação do pedido da loja para o MercadoLivre';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.sync__label'} = 'Sincronização da Situação';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.sync__help'} = '                    <dl>
                      <dt>Sincronização automática via CronJob (recomendado)</dt>
                        <dd>
                        A função "Sincronização Automática via CronJob" envia, a cada 2 horas, a situação atual dos pedidos ao
                        MercadoLivre.<br/>
                        Durante esta operação os valores contidos na base de dados são verificados e enviados, mesmo que esta mudança
                        tenha ocorrido somente na base de dados (por exemplo através de um ERP).<br><br>
                        Um sincronização manual pode ser disparada editando-se a situação do pedido diretamente na loja, ajustando-o para 
                        o valor desejado e clicando, à seguir, em "Atualizar".<br/>
                        Você pode também clicar no botão correspondente no topo da página do magnalister (à esquerda da formiga), para
                        enviar a situação do pedido imediatamente.<br/><br/>
                        Adicionalmente, uma sincronização das situações dos pedidos pode também ser disparada através de um CronJob (a
                        partir da tarifa Flat - com intervalo mínimo de 15 minutos). Para isto, siga o seguinte link para a sua loja: <br>                   
                        <i>{#setting:sSyncOrderStatusUrl#}</i><br/><br/>
                       Disparos de CronJobs por clientes fora da tarifa Flat ou com intervalos inferiores a 15 minutos são bloqueados.<br><br>
                       </dd>
                    </dl>
            ';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.shipped__label'} = 'Confirmar envio com';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.shipped__help'} = 'Defina aqui a situação de pedido na loja que ajuste automaticamente a situação no MercadoLivre para "Confirmar envio".';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.canceled__label'} = 'Pedido estornado com';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.canceled__help'} = '                Defina aqui o código que irá definir automaticamente a situação do pedido como "Pedido Estornado" no 
                MercadoLivre.<br/><br/>
                Observação: um estorno parcial não é possível aqui. Através desta função o pedido completo é estornado e creditado
                ao cliente.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__mwst.fallback__label'} = 'Imposto sobre artigos estranhos à loja';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__mwst.fallback__hint'} = 'Imposto, em %, a seu utilizado em artigos estranhos à loja na importação dos pedidos. ';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__mwst.fallback__help'} = '                Quando um artigo não é transferido via o magnalister, o valor do imposto sobre este não pode ser determinado.<br/>
                Como solução, o valor aqui fornecido (em porcentual) é atribuído a todos os produtos cujo imposto não pode ser obtido
                durante a importação dos pedidos do MercadoLivre. ';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__importactive__label'} = 'Ativar importação';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__importactive__help'} = '                Os pedidos do MercadoLivre deve ser importados?<br/><br/>
                Uma importação manual pode ser iniciada clicando-se no botão correspondente no topo da página do magnalister
                (à esquerda da formiga).<br><br>
                Adicionalmente, uma importação dos pedidos também pode ser disparada através de um CronJob (a partir da tarifa
                Flat - com intervalo mínimo de 15 minutos). Para isto, siga o seguinte link para a sua loja: <br>                   
                <i>{#setting:sImportOrdersUrl#}</i><br>
                Disparos de CronJobs por clientes fora da tarifa Flat ou com intervalos inferiores a 15 minutos são bloqueados.<br><br>
';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__preimport.start__label'} = 'começando em';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__preimport.start__hint'} = 'Data e horário de início';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__preimport.start__help'} = 'Data e horário em que a importação deve ocorrer pela primeira vez. Por favor note que não é possível definir este valor em um instante qualquer do passado, um vez que o MercadoLivre mantém os dados correspondentes apenas por algumas semanas.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__customergroup__label'} = 'Grupo de Cliente';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__customergroup__help'} = 'Grupo ao qual o cliente deverá ser atribuído em novos pedidos.';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.open__label'} = 'Situação do pedido na loja';
MLI18n::gi()->{'mercadolivre_config_orderimport__field__orderstatus.open__help'} = '                A situação de pedido que deverá ser atribuído automaticamente a novos pedidos provenientes do MercadoLivre.<br/>
                Caso um mecanismo automático de cobrança seja utilizado, é recomendável configurar a situação como "paga"
                ("Configuração" &rarr; "Situação do Pedido").';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__legend__mail'} = 'Modelo de e-mail promocional';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.send__label'} = 'Enviar e-mail?';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.send__help'} = 'Um e-mail promocional deverá ser enviado ao comprador pela sua loja? ';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.originator.name__label'} = 'Nome do remetente';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.originator.adress__label'} = 'Endereço de e-mail do remetente';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.subject__label'} = 'Assunto';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.content__label'} = 'Conteúdo do e-mail';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.content__hint'} = 'Lista de <i>placeholders</i> disponíveis para o assunto e conteúdo: 
                <dl>
                    <dt>#FIRSTNAME#</dt>
                    <dd>Nome do comprador</dd>
                    <dt>#LASTNAME#</dt>
                    <dd>Sobrenome do comprador</dd>
                    <dt>#EMAIL#</dt>
                    <dd>Endereço de e-mail do comprador</dd>
                    <dt>#PASSWORD#</dt>
                    <dd>Senha do comprador para login em sua loja. Apenas no caso de clientes cadastrados / incluídos automaticamente,
                            caso contrário substituído por "(conforme conhecido)".</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Resumo dos artigos comprados. Utilização recomendada em uma linha individual / em separado.<br>
                        <i>Não pode ser utilizado no campo "Assunto"!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>Nome deste Marketplace</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>URL da sua loja</dd>
                    <dt>#ORIGINATOR#</dt>
                    <dd>Nome do remetente</dd>
                </dl>';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.copy__label'} = 'Cópia para o remetente';
MLI18n::gi()->{'mercadolivre_config_emailtemplate__field__mail.copy__help'} = 'Uma cópia será enviada para o endereço de e-mail do remetente.';
