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

MLI18n::gi()->{'ml_ebay_note_product_required_short'} = '<b>Remarque</b> : Pour cette catégorie, il est oligatoire de faire figurer l‘identifiant du produit eBay. Pour les détails, voir l‘icône Info.';
MLI18n::gi()->{'ml_ebay_note_product_required'} = 'eBay exige pour cette catégorie un rattachement à des produits existant sur eBay par le biais d‘un ePID.<br /><br /> magnalister exécute cet appariement grâce au code EAN renseigné sur l’article et ses déclinaisons.<br /><br />Dans le cas où le catalogue eBay ne présente aucune offre correspondante ni ePID, la crátion du produit est automatiquement demandé après le téléchargement. Vérifiez ensuite le statut de la demande sous l‘onglet inventaire et dans le journal des dysfonctionnements.';
MLI18n::gi()->{'ebay_prepare_apply'} = 'Créer de nouveaux produits';
MLI18n::gi()->{'ml_ebay_no_conditions_applicable_for_cat'} = 'Cette catégorie n\'autorise pas d\'indication sur l\'état de l\'article.';
MLI18n::gi()->{'ml_ebay_prepare_form_category_notvalid'} = 'Cette catégorie n\'est pas valable.';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__details'} = 'Détails de l\'article';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__pictures'} = 'Paramètre d\'images';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__auction'} = 'paramètres des enchères';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__category'} = 'Catégorie eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatching__0'} = 'Attribut eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatching__1'} = 'Appariement des attributs et des valeurs d\'attribut';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingoptional__0'} = 'Attribut optionnel eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingoptional__1'} = 'Appariement des attributs et des valeurs d\'attribut';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingcustom__0'} = 'Attributs personnalisés eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingcustom__1'} = 'Appariement des attributs et des valeurs d\'attribut';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__shipping'} = 'Livraison';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__mwst'} = 'TVA';
MLI18n::gi()->{'ebay_prepare_apply_form__field__title__label'} = 'Nom du produit';
MLI18n::gi()->{'ebay_prepare_apply_form__field__title__hint'} = 'Titre max. 80 caractères<br />Rubriques disponibles:<br />#BASEPRICE# - Prix de base.<br /> Veuillez tenir compte du texte d\'info dans la configuration (template nom du modèle).';
MLI18n::gi()->{'ebay_prepare_apply_form__field__title__optional__checkbox__labelNegativ'} = 'Reprendre toujours le nom de l\'article actuel du magasin';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__label'} = 'Sous-titre';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__hint'} = 'Sous-titre max. 55 caractères <span style="color:#e31a1c">option payante</span>';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__optional__select__false'} = 'Ne pas transmettre';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__optional__select__true'} = 'Transmettre';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pictureurl__label'} = 'Photo sur eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pictureurl__hint'} = 'Image';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pictureurl__optional__checkbox__labelNegativ'} = 'Toujours utiliser les images de la boutique';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationdimensionforpictures__label'} = 'Pack d\'images pour variantes';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationdimensionforpictures__help'} = 'Avec l\'activation du Pack d\'images pour variantes, les images que vous avez ajoutées aux déclinaisons de vos produits seront transmises à eBay.<br>
eBay ne permet d\'utiliser qu\'une seule image par variante (si vous sélectionnez par exemple, "Couleur", eBay affichera une image différente chaque fois que l\'acheteur sélectionne une couleur différente).<br>
Dans la rubrique préparation de l\'article, vous pouvez modifier à tout moment la valeur standard enregistrée ici.<br><br>
Les modifications ultérieures nécessitent une modification de la préparation et une retransmission des produits concernés.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationpictures__label'} = 'Images de variantes';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationpictures__hint'} = '';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationpictures__optional__checkbox__labelNegativ'} = 'Toujours utiliser les images de la boutique';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__label'} = 'Galerie d\'images';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__help'} = '<b>Galerie de photos</b><br>
<br>En activant cette fonction, une image miniature de vos produits illustrera vos annonces dans la liste des résultats sur eBay. Ainsi vos opportunités de ventes sont considérablement augmentées puisque les clients ont tendance à consulter les offres dotés d\'une image.<br>
<br><b>Galerie Plus</b>
<br>
<br>En activant cette fonction vos offres sur eBay bénéficieront d\'une meilleure visibilité : Lorsqu\'un client passera au dessus de votre annonce avec sa souris une page avec une image agrandie s\'affichera. Les images doivent au moins avoir une résolution de <b>800x800 pixels</b><br>
<br>  <b>Particularités pour la catégorie "Vêtements, accesoires"</b>
<br>
<br>Si vous téléchargez un article dans la catégorie  "Vêtements, accesoires"  et que vous avez activé  l\'option "Galerie de photos" ou "Galerie plus" l\'aperçu rapide de vos annonces dans la liste des résultats eBay sera automatiquement activée. Vous n\'êtes pas obligé d\'activer l\'option dans votre compte eBay.
<b>eBay-Gebühren</b><br>
L\'utilisation de l\'option "Galerie Plus", peux occasionner des frais supplémentaires auprès d\'eBay</span> ! RedGecko GmbH décline toute responsabilité pour les frais qui en résultent.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__hint'} = 'configuration de la galerie d\'image<br />(L\'option "plus" est une option <font color="red">payante</font>)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__alert__Plus__title'} = 'Galerie plus';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__alert__Plus__content'} = 'Avec l\'activation de l\'option <b>Galerie plus</b>votre photo d\'article apparaîtra comme une vignette agrandie dans les résultats de recherche et dans la galerie.
<br> Les images téléchragés doivent au-moins avoir une résolution de 800 x 800 pixels.<br>
<br> Des <span style="color:#e31a1c;">frais supplémentaires</span> peuvent-être facturés par eBay!<br>
<br> Pour plus d\'informations, reportez-vous à l\'aide en ligne de eBay, sous la rubrique galerie d\'images.<br> <br>
<br>RedGecko GmbH n\'assume aucune responsabilité quant aux frais supplémentaires.<br>
<br>
Veuillez confirmer avoir pris connaissance des conditions d\'utilisations en appuyant sur "accepter" ou annuler en appuyant sur "annuler" .';
MLI18n::gi()->{'ebay_prepare_apply_form__field__description__label'} = 'Description';
MLI18n::gi()->{'ebay_prepare_apply_form__field__description__hint'} = 'Liste des champs disponibles pour la description du produit : <dl><dt>#TITLE#</dt><dd>Nom du produit(titre)</dd><dt>#ARTNR#</dt><dd>Référence de l\'article</dd><dt>#PID#</dt><dd>ID de produit</dd><dt>#SHORTDESCRIPTION#</dt><dd>Courte description</dd><dt>#DESCRIPTION#</dt><dd>Description</dd><dt>#MOBILEDESCRIPTION#</dt><dd>Courte description pour les mobiles, si nécessaire</dd><dt> #PICTURE1#</dt><dd>première photo de l\'article</dd><dt>#PICTURE2# etc.</dt><dd>deuxième photo de l\'article, avec #PICTURE3#, #PICTURE4# etc. vous pouvez envoyer d\'autres photos, autant que disponible en magasin.</dd></dl>';
MLI18n::gi()->{'ebay_prepare_apply_form__field__description__optional__checkbox__labelNegativ'} = 'Utilisez toujours la description actuelle de l\'article en magasin ';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__label'} = 'Description pour mobile';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__hint'} = 'Liste des champs disponibles pour la description du produit :
<dl>
<dt>#TITLE#</dt><dd> Nom du produit (Titre)</dd>
<dt>#ARTNR#</dt><dd> Référence boutique de l’article</dd>
<dt>#PID#</dt><dd> ID boutique de l’article</dd>
<dt>#SHORTDESCRIPTION#</dt><dd> Courte description importé de la boutique </dd>
<dt>#DESCRIPTION#</dt><dd> Description importé de la boutique </dd>
<dt>#WEIGHT#</dt><dd> Poids du produit</dd>
</dl>';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__optional__checkbox__labelNegativ'} = 'Toujours utiliser la description d’article de la boutique. ';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__hint2'} = '<b>Indication</b>:<br /> L’utilisation des tags HTLM n’est autorisée, que pour la mise en forme des listes et les retours à la ligne, aucune autre ne sera prise en compte.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pricecontainer__label'} = 'Prix eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pricecontainer__hint'} = 'Prix pour eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__buyitnowprice__optional__select__true'} = 'Activez l\'achat immédiat';
MLI18n::gi()->{'ebay_prepare_apply_form__field__buyitnowprice__optional__select__false'} = 'Pas d\'achat immédiat';
MLI18n::gi()->{'ebay_prepare_apply_form__field__site__label'} = 'Site eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__site__hint'} = 'Place de marché eBay sur laquelle vous vendez';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingtype__label'} = 'Format de la vente';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingtype__hint'} = 'Choisissez le format de votre vente';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingduration__label'} = 'Durée de l\'annonce';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingduration__hint'} = 'Durée de l’enchère ';
MLI18n::gi()->{'ebay_prepare_apply_form__field__strikeprice__label'} = 'Prix barr&eacute';
MLI18n::gi()->{'ebay_prepare_apply_form__field__strikeprice__hint'} = 'Prix barr&eacute;';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentsellerprofile__label'} = 'Conditions de vente: paiement';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentsellerprofile__help'} = '<b>Sélection du profil de conditions générales de ventes</b><br /><br />
Vous utilisez la fonction “Gestionnaire des conditions de vente” sur eBay. Cela signifie que les options de paiement, d\'expédition et de retour ne peuvent plus être sélectionnées individuellement, mais sont déterminées par les conditions du profil eBay correspondant.<br /><br />
Choisissez le profil souhaité pour les conditions de vente. Ce choix deviendra la valeur par défaut. Si sur eBay, vous avez créé plusieurs profils, vous avez la possibilité d\'en choir un différent, du profil par défaut, en le sélectionnant sous la rubrique préparation de l\'article.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentsellerprofile__help_subfields'} = '<br>
                <br><b>Remarque</b>:<br />
               Ce champ n’est pas modifiable, car vous utilisez les conditions de vente eBay.
Veuillez sélectionner une condition de paiement dans le menu déroulant <b>Conditions de vente: mode de paiement</b>, pour pouvoir définir un profil des conditions de vente.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentmethods__label'} = 'Modes de paiement';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentmethods__hint'} = 'Modes de paiement proposés';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentmethods__help'} = 'Préférences pour les modes de paiement ( sélection multiple avec Ctrl+clic).<br /><br />Vous pouvez sélectionner ici les modes de paiement proposés par eBay.<br /><br />Si vous utilisez "Paiements gérés par eBay", eBay ne fournira pas d&apos;autres informations sur le mode de paiement utilisé par l&apos;acheteur.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditionid__label'} = 'État de l\'article';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditionid__hint'} = 'État de l\'article (s\'affiche dans la plupart des catégories sur eBay)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescriptors__label'} = 'Informations sur l\'état de l\'article';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescriptors__hint'} = 'Informations supplémentaires sur l\'état des articles (pour certaines catégories)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescription__label'} = 'Description de l\'état';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescription__hint'} = 'Informations complémentaires sur l\'état de l\'article. Ne s\'affiche pas si l\'état de l\'article est "Nouveau" ou "Nouveau avec..."';
MLI18n::gi()->{'ebay_prepare_apply_form__field__privatelisting__label'} = 'Offre privée';
MLI18n::gi()->{'ebay_prepare_apply_form__field__privatelisting__hint'} = 'Si l\'option est activée, la liste des enchérisseurs ne peut pas être consultée par un tiers. <span style="color:#e31a1c">option payante</span>';
MLI18n::gi()->{'ebay_prepare_apply_form__field__privatelisting__valuehint'} = 'Acheteur / Liste des enchérisseurs non accessible au public';
MLI18n::gi()->{'ebay_prepare_apply_form__field__bestofferenabled__label'} = 'prix proposé';
MLI18n::gi()->{'ebay_prepare_apply_form__field__bestofferenabled__hint'} = 'Si l\'option est activée,l\'acheteur peut proposer un prix';
MLI18n::gi()->{'ebay_prepare_apply_form__field__bestofferenabled__valuehint'} = 'Activer l\'option prix par défaut (concerne uniquement les articles sans variantes)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__ebayplus__label'} = 'eBay Plus';
MLI18n::gi()->{'ebay_prepare_apply_form__field__ebayplus__hint'} = 'Disponible uniquement si cette fonctionnalité est activée et active sur eBay.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__ebayplus__valuehint'} = 'Activez eBay Plus';

MLI18n::gi()->{'ebay_prepare_apply_form__field__starttime__label'} = 'Heure de démarrage<br /> (si préréglée)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__starttime__hint'} = 'Normalement, un article est actif sur eBay immédiatement après son téléchargement. Mais en remplissant ce champ, vous pouvez choisir l\'heure du début de la vente(<span style="color: red">option payante</span>).';
MLI18n::gi()->{'ebay_prepare_apply_form__field__primarycategory__label'} = 'Catégorie principale';
MLI18n::gi()->{'ebay_prepare_apply_form__field__primarycategory__hint'} = 'Choisissez';
MLI18n::gi()->{'ebay_prepare_apply_form__field__secondarycategory__label'} = 'Catégorie secondaire';
MLI18n::gi()->{'ebay_prepare_apply_form__field__secondarycategory__hint'} = 'Choisissez';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory__label'} = 'Catégorie boutique eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory__hint'} = 'Choisissez';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory2__label'} = 'Catégorie boutique eBay secondaire';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory2__hint'} = 'Choisissez';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippingsellerprofile__label'} = 'Conditions générales : Expédition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippingsellerprofile__help'} = '<b> Sélectionnez vos conditions de vente relatives à l\'expédition</b><br /><br />
Si vous utilisez la fonction “Gestionnaire des conditions de vente” sur eBay.
Les conditions de paiement, d’expédition et de retour définis dans votre compte vendeur eBay seront alors appliquées.<br /><br />
Choisissez le profil souhaité pour les conditions de vente. Ce choix deviendra la valeur par défaut. Si sur eBay, vous avez créé plusieurs profils, vous avez la possibilité d\'en choir un différent, du profil par défaut, en le sélectionnant sous la rubrique préparation de l\'article.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippingsellerprofile__help_subfields'} = '<b>Remarque</b>:<br />
               Ce champ n’est pas éditable, car vous utilisez les conditions de vente eBay.
Veuillez sélectionner une condition d\'expédition dans le menu déroulant <b>Conditions de vente: expédition</b> pour définir le profil des conditions d\'expédition.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalcontainer__label'} = 'Expédition nationale';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalcontainer__hint'} = 'Options d\'expédition nationale<br /><br /><br />La mention "=GEWICHT" dans les frais d\'expéditio, calcule automatiquement le coût de l\'expédition par rapport au poids de l\'article.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalcontainer__label'} = 'Expédition internationale';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalcontainer__hint'} = 'Modes de livraison pour l\'international';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocal__cost'} = 'Frais de port';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalprofile__option'} = '{#NAME#} ({#AMOUNT#} pour chaque article supplémentaire)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalprofile__optional__select__false'} = 'Ne pas utiliser le profil d\'expédition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalprofile__optional__select__true'} = 'Utiliser le profil d\'expédition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocaldiscount__label'} = 'Appliquer les règles d\'expédition à un prix spécial';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationaldiscount__label'} = 'Appliquer les règles d\'expédition à un prix spécial';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternational__cost'} = 'Frais de port';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternational__optional__select__false'} = 'Ne pas expédier à l\'étranger';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternational__optional__select__true'} = 'Envoyé à l\'étranger';
MLI18n::gi()->{'ebay_prepare_apply_form__field__dispatchtimemax__label'} = 'Délai de livraison';
MLI18n::gi()->{'ebay_prepare_apply_form__field__dispatchtimemax__optional__checkbox__labelNegativ'} = 'Prendre toujours en compte le temps d\'expédier à partir de la configuration eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__option'} = '{#NAME#} ({#AMOUNT#} pour chaque article supplémentaire)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__notavailible'} = 'Seulement si `<i>l\'expédition à l\'étranger</i>` est active.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__optional__select__false'} = 'Ne pas utiliser le profil d\'expédition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__optional__select__true'} = 'Utiliser le profil d\'expédition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationgroups__label'} = 'Catégorie eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationgroups.value__label'} = '1er catégorie de place de marché:';
MLI18n::gi()->{'ebay_prepare_apply_form__field__webshopattribute__label'} = 'Attribut boutique';
MLI18n::gi()->{'ebay_prepare_apply_form__field__attributematching__matching__titlesrc'} = 'Valeur Boutique';
MLI18n::gi()->{'ebay_prepare_apply_form__field__attributematching__matching__titledst'} = 'Valeur eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__mwst__label'} = 'Taux de TVA';
MLI18n::gi()->{'ebay_prepare_variations__legend__variations'} = 'Sélectionnez une catégorie eBay';
MLI18n::gi()->{'ebay_prepare_variations__legend__attributes'} = 'Sélectionnez une catégorie eBay';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatching__0'} = 'Attribut eBay ';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatching__1'} = 'Appariement des attributs et des valeurs d\'attribut';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingoptional__0'} = 'Attributs optionnels eBay';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingoptional__1'} = 'Appariement des attributs et des valeurs d\'attribut';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingcustom__0'} = 'Attributs personnalisés eBay';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingcustom__1'} = 'Appariement des attributs et des valeurs d\'attribut';
MLI18n::gi()->{'ebay_prepare_variations__legend__action'} = '{#i18n:form_action_default_legend#}';
MLI18n::gi()->{'ebay_prepare_variations__field__variationgroups__label'} = '{#i18n:attributes_matching_category_title#}';
MLI18n::gi()->{'ebay_prepare_variations__field__variationgroups.value__label'} = '1er Catégorie de la place de marché';
MLI18n::gi()->{'ebay_prepare_variations__field__deleteaction__label'} = '{#i18n:ML_BUTTON_LABEL_DELETE#}';
MLI18n::gi()->{'ebay_prepare_variations__field__groupschanged__label'} = '';
MLI18n::gi()->{'ebay_prepare_variations__field__attributename__label'} = 'Nom de l\'attribut';
MLI18n::gi()->{'ebay_prepare_variations__field__attributenameajax__label'} = '';
MLI18n::gi()->{'ebay_prepare_variations__field__customidentifier__label'} = 'identifiant';
MLI18n::gi()->{'ebay_prepare_variations__field__webshopattribute__label'} = 'Attribut boutique ';
MLI18n::gi()->{'ebay_prepare_variations__field__saveaction__label'} = 'ENREGISTRER ET FERMER';
MLI18n::gi()->{'ebay_prepare_variations__field__resetaction__label'} = '{#i18n:ebay_varmatch_reset_matching#}';
MLI18n::gi()->{'ebay_prepare_variations__field__resetaction__confirmtext'} = '{#i18n:ebay_prepare_variations_reset_info#}';
MLI18n::gi()->{'ebay_prepare_variations__field__attributematching__matching__titlesrc'} = '{#i18n:attributes_matching_shop_value#}';
MLI18n::gi()->{'ebay_prepare_variations__field__attributematching__matching__titledst'} = '{#i18n:attributes_matching_marketplace_value#}';
MLI18n::gi()->{'ebay_prepareform_max_length_part1'} = 'Longueur maximale ';
MLI18n::gi()->{'ebay_prepareform_max_length_part2'} = 'L\'attribut est';
MLI18n::gi()->{'ebay_prepareform_category'} = 'L\'attribut de catégorie est obligatoire.';
MLI18n::gi()->{'ebay_prepareform_title'} = 'Veuillez entrer un titre.';
MLI18n::gi()->{'ebay_prepareform_description'} = 'Veuillez entrer une description du produit.';
MLI18n::gi()->{'ebay_prepareform_category_attribute'} = 'Champs obligatoire, ne peut être vide.';
MLI18n::gi()->{'ebay_category_no_attributes'} = 'Il n\' y a aucun attribut pour cette catégorie.';
MLI18n::gi()->{'ebay_prepare_variations_title'} = '{#i18n:attributes_matching_tab_title#}';
MLI18n::gi()->{'ebay_prepare_variations_groups'} = 'Groupes eBay';
MLI18n::gi()->{'ebay_prepare_variations_groups_custom'} = 'Groupes particuliers';
MLI18n::gi()->{'ebay_prepare_variations_groups_new'} = 'Créez vos groupes particuliers';
MLI18n::gi()->{'ebay_prepare_match_variations_no_selection'} = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->{'ebay_prepare_match_variations_custom_ident_missing'} = 'Veuillez sélectionner les identifiants.';
MLI18n::gi()->{'ebay_prepare_match_variations_attribute_missing'} = 'Veuillez sélectionner le nom de l\'attribut.';
MLI18n::gi()->{'ebay_prepare_match_variations_not_all_matched'} = 'Veuillez attribuer un attribut boutique à tous les attributs eBay.';
MLI18n::gi()->{'ebay_prepare_match_notice_not_all_auto_matched'} = 'Toutes les valeurs sélectionnées n\'ont pas pu être appariées. Les valeurs non appariées sont toujours affichées dans les champs déroulants. Les valeurs déjà appariées sont prises en compte dans la préparation du produit.';
MLI18n::gi()->{'ebay_prepare_match_variations_saved'} = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->{'ebay_prepare_variations_saved'} = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->{'ebay_prepare_match_variations_delete'} = 'Voulez-vous vraiment supprimer votre propre groupe? Toutes les appariements de variantes associées seront alors également supprimés.';
MLI18n::gi()->{'ebay_error_checkin_variation_config_empty'} = 'Les variations ne sont pas configurées.';
MLI18n::gi()->{'ebay_error_checkin_variation_config_cannot_calc_variations'} = 'Aucune variation n\'a pu être calculée.';
MLI18n::gi()->{'ebay_error_checkin_variation_config_missing_nameid'} = 'Il n\' a pas été possible de trouver un appariement d\'attribut boutique "{#Attribute#}", dans le groupe de variantes eBay "{#MpIdentifier#}" sélectionné, pour la variantes de l\'article SKU "{#SKU#}".';
MLI18n::gi()->{'ebay_prepare_variations_free_text'} = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->{'ebay_prepare_variations_additional_category'} = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->{'ebay_prepare_variations_error_text'} = 'L\'attribut {#attribute_name#} est obligatoire. Veuillez attribuer toutes les valeurs.';
MLI18n::gi()->{'ebay_prepare_variations_error_empty_custom_attribute_name'} = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->{'ebay_prepare_variations_error_maximal_number_custom_attributes_exceeded'} = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->{'ebay_prepare_variations_theme_mandatory_error'} = 'ebay_prepare_variations_theme_mandatory_error';
MLI18n::gi()->{'ebay_prepare_variations_error_missing_value'} = 'L\'attribut {#attribute_name#} est obligatoire, et votre produit n\'a pas de valeur pour l\'attribut choisi dans la boutique.';
MLI18n::gi()->{'ebay_prepare_variations_error_free_text'} = ' : Le champ de texte libre ne doit pas être vide.';
MLI18n::gi()->{'ebay_prepare_variations_matching_table'} = 'Apparié';
MLI18n::gi()->{'ebay_prepare_variations_manualy_matched'} = ' - (appariement manuel)';
MLI18n::gi()->{'ebay_prepare_variations_auto_matched'} = ' - (appariement automatic)';
MLI18n::gi()->{'ebay_prepare_variations_free_text_add'} = '- (donnée personnelle)';
MLI18n::gi()->{'ebay_prepare_variations_reset_info'} = 'Voulez-vous vraiment modifier l\'appariement ?';
MLI18n::gi()->{'ebay_prepare_variations_change_attribute_info'} = 'Avant de pouvoir modifier des attributs, veuillez supprimer toutes les appariements.';
MLI18n::gi()->{'ebay_prepare_variations_additional_attribute_label'} = 'Attributs personnalisés';
MLI18n::gi()->{'ebay_prepare_variations_separator_line_label'} = '-------------------------------------------------------------';
MLI18n::gi()->{'ebay_prepare_variations_mandatory_fields_info'} = '<b>Note :</b> Les champs marqués d\'un <span class="bull">&bull;</span> sont obligatoires et doivent être remplis.';
MLI18n::gi()->{'ebay_prepare_variations_already_matched'} = '(déjà apparié)';
MLI18n::gi()->{'ebay_prepare_variations_category_without_attributes_info'} = 'eBay ne prend pas en charge les attributs pour la catégorie sélectionnée.';
MLI18n::gi()->{'ebay_prepare_variations_error_duplicated_custom_attribute_name'} = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->{'ebay_prepare_variations_choose_mp_value'} = 'Utiliser la valeur d\'attribut eBay';
MLI18n::gi()->{'ebay_prepare_variations_notice'} = 'Noter que vous avez apparié certains articles de la catégorie "{#category_name#}}" différemment sous l\'onglet "Préparation les articles". Les valeurs stockées dans cet onglet ont priorité et sont transférées au marché.';
MLI18n::gi()->{'ebay_varmatch_attribute_changed_on_mp'} = 'Attention : eBay a supprimé ou modifié certaines valeurs d\'attributs déjà appariées.
Vérifiez s\'il vous plaît, vos assignations et faites correspondre à nouveau les valeurs concernées si nécessaire.';
MLI18n::gi()->{'ebay_varmatch_attribute_different_on_product'} = 'Remarque : Vous avez sauvegardé cette valeur différemment de l\'attribut global correspondant.
Les valeurs enregistrées différemment ici sont transférées au marché.';
MLI18n::gi()->{'ebay_varmatch_attribute_deleted_from_mp'} = 'Cet attribut a été supprimé ou modifié par eBay. Les jumelages ont donc été annulés.
Si nécessaire, veuillez recorrespondre à un attribut eBay approprié.';
MLI18n::gi()->{'ebay_varmatch_attribute_value_deleted_from_mp'} = 'Cet attribut a été supprimé ou modifié par eBay. Les appariements ont donc été annulés.
Veuillez si nécessaire, refaire l\'appariement.';
MLI18n::gi()->{'ebay_varmatch_attribute_deleted_from_shop'} = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';
MLI18n::gi()->{'ebay_varmatch_define_name'} = 'Veuillez entrer un identifiant';
MLI18n::gi()->{'ebay_varmatch_ajax_error'} = 'Une erreur s\'est produite';
MLI18n::gi()->{'ebay_varmatch_all_select'} = 'Tout';
MLI18n::gi()->{'ebay_varmatch_please_select'} = 'Veuillez choisir...';
MLI18n::gi()->{'ebay_varmatch_auto_matchen'} = 'Appariement automatique';
MLI18n::gi()->{'ebay_varmatch_reset_matching'} = 'Supprimer l\'appariement';
MLI18n::gi()->{'ebay_varmatch_delete_custom_title'} = 'Supprimer l\'appariement du groupe de variantes ';
MLI18n::gi()->{'ebay_varmatch_delete_custom_content'} = 'Voulez-vous vraiment supprimer votre propre groupe?<br />Toutes les appariements de variantes associées seront alors également supprimés.';
MLI18n::gi()->{'ebay_prepare_variations_multiselect_hint'} = 'Appuyez sur la touche cmd de votre clavier et sélectionnez tous les attributs requis à transmettre.';
MLI18n::gi()->{'ebay_prepare_verfiyproduct_error_1605109425'} = 'Erreur lors de la validation des articles : l\'article (UGS : {#sku#}) n\'a pas de déclinaisons valides';
