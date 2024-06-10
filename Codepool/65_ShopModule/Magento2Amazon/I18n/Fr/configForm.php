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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__help'} = '
Sélectionnez le transporteur qui sera utilisé pour les commandes Amazon.<br>
<br>
Les options suivantes s’offrent à vous :<br>
<ul>
	<li><span class="bold underline">Société de livraison Amazon</span></li>
</ul>
Sélectionnez un transporteurs dans le menu déroulant. Les sociétés recommandées par Amazon y sont affichées.<br>
<br>
Cette option est idéale si vous souhaitez <strong>toujours utiliser le même transporteur</strong> pour les commandes Amazon.<br>
<ul>
	<li><span class="bold underline">Apparier les sociétés de livraison Amazon avec les sociétés de livraison de votre boutique</span></li>
</ul>
Vous pouvez faire correspondre les transporteurs proposés par Amazon avec les transporteurs créés dans le module d\'expédition de Magento. Pour ajouter un nouvel appariement, cliquez sur le symbole "+".<br>
<br>
Pour savoir quelle entrée du module d\'expédition de Magento est utilisée pour l\'importation des commandes Amazon, veuillez vous référer à l\'icône info sous "Importation des commandes" -> "Service d\'expédition des commandes".<br>
<br>
Choisissez cette option si vous souhaitez <strong>utiliser les sociétés de livraisons existantes du module d\'expédition de Magento.</strong><br>
<ul>
    <li><span class="bold underline">magnalister ajoute un champ supplémentaire dans les détails de la commande</span></li>
</ul>
Si vous sélectionnez cette option, un champ sera ajouté dans l’aperçu de la commande dans Magento dans lequel vous pouvez renseigner la société de livraison.<br>
<br>
Choisissez cette option si vous souhaitez <strong>utiliser différents transporteurs</strong> pour les commandes Amazon.<br>
<ul>
	<li><span class="bold underline">Saisir manuellement le nom de la société de transport pour toutes les commande</span></li>
</ul>
Si vous sélectionnez "Entrer le nom de la société de livraison manuellement dans un champ " sous l’option "Société de livraison" vous pouvez saisir le nom de la société de livraison manuellement.<br>
<br>
Sélectionnez cette option, si vous souhaitez <strong>définir une société de livraison qui sera utilisée pour toutes les commandes Amazon.</strong><br>
<br>
<span class="bold underline">Important :</span>
<ul>
	<li>La société de livraison doit obligatoirement être renseignée pour que l’expédition de la commande puisse être confirmée sur Amazon.<br><br></li>
	<li>Le non-renseignement de la société de livraison lors de la confirmation de l’expédition sur amazon peut entrainer la suspension de votre compte vendeur.</li>
</ul>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__help'} = '
Sélectionnez le service de livraison qui sera utilisé pour les commandes Amazon.<br>
<br>
Les options suivantes s’offrent à vous :
<ul>
	<li><span class="bold underline">Apparier les services de livraison Amazon avec les services de livraison de votre boutique</span></li>
</ul>
Vous pouvez faire correspondre les services de livraison proposés par Amazon avec les services de livraisons créés dans le module d\'expédition de Magento. Pour ajouter un nouvel appariement, cliquez sur le symbole "+".<br>
<br>
Pour savoir quelle entrée du module d\'expédition de Magento est utilisée pour l\'importation des commandes Amazon, veuillez vous référer à l\'icône info sous "Importation des commandes" -> "Service d\'expédition des commandes".<br>
<br>
Choisissez cette option si vous souhaitez <strong>utiliser les services d’expédition existants du module d’expédition de Magento.</strong><br>
<ul>
	<li><span class="bold underline">magnalister ajoute un champ supplémentaire dans les détails de la commande</span></li>
</ul>
Si vous sélectionnez cette option, un champ sera ajouté dans l’aperçu de la commande dans <strong>Magento</strong> dans lequel vous pouvez renseigner le service de livraison.<br>
<br>
Choisissez cette option si vous souhaitez <strong>utiliser différents transporteurs</strong> pour les commandes Amazon.<br>
<ul>
	<li><span class="bold underline">Saisir manuellement le nom du service d\'expédition pour toutes les commande</span></li>
</ul>
Si vous sélectionnez "Entrer le nom du service d’expédition manuellement dans un champ " sous l’option "Service d’expédition" vous pouvez saisir le nom de la société de livraison manuellement dans le champ de droite.<br>
<br>
Sélectionnez cette option, si vous souhaitez <strong>définir un service d’expédition qui sera utilisée pour toutes les commandes Amazon.</strong><br>
<br>
<span class="bold underline">Important :</span>
<ul>
	<li>Le service d’expédition doit obligatoirement être renseigné pour que l’expédition de la commande puisse être confirmée sur Amazon<br><br></li>
	<li>Le non-renseignement du service d’expédition lors de la confirmation de l’expédition sur amazon peut entrainer la suspension de votre compte vendeur.</li>
</ul>
';
