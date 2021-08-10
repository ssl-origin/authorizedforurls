<?php
/**
*
* Authorized for urls [French]
* 
* Authorized for urls extension for the phpBB Forum Software package.
*
* @package language Authorized for urls
* @copyright (c) 2020 RMcGirr83
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//
$lang = array_merge($lang, [
	// ACP
	'AFU_ACP_TITLE'			=> 'Autorisé pour les URL',
	'AFU_CONFIG'			=> 'Paramètres',
	'AFU_IMAGE_BBCODE'		=> 'Vérifier le bbcode de image',
	'AFU_IMAGE_BBCODE_EXPLAIN'	=> 'Si défini sur oui, les URL dans le bbcode img seront vérifiées.',
	'AFU_EMAIL'				=> 'Vérifier les liens dans les e-mails',
	'AFU_EMAIL_EXPLAIN'		=> 'Si défini sur oui, les liens avec les adresses e-mail seront vérifiés.',
	'AFU_DENY_POST'			=> 'Si une correspondance est trouvée, la publication est refusée',
	'AFU_DENY_POST_EXPLAIN'	=> 'Si défini sur oui, la publication sera refusée, sinon la publication sera placée dans la file d‘attente de modération.',
	'AFU_TLDS'				=> 'Vérifier les TLD',
	'AFU_TLDS_EXPLAIN'		=> 'Les TLD à inclure, séparés par une virgule (Exemple : com, de). Ajoutez ou supprimez selon vos besoins.',
	'AFU_SAVED'				=> 'Changements sauvegardés',
	//Donation
	'PAYPAL_IMAGE_URL'          => 'https://www.paypalobjects.com/webstatic/en_US/i/btn/png/silver-pill-paypal-26px.png',
	'PAYPAL_ALT'                => 'Faire un don avec PayPal',
	'BUY_ME_A_BEER_URL'         => 'https://paypal.me/RMcGirr83',
	'BUY_ME_A_BEER'				=> 'Payez-moi une bière pour la création de cette extension',
	'BUY_ME_A_BEER_SHORT'		=> 'Faites un don pour cette extension',
	'BUY_ME_A_BEER_EXPLAIN'		=> 'Cette extension est totalement gratuite. C’est un projet sur lequel je passe mon temps pour le plaisir et l’utilisation de la communauté phpBB. Si vous aimez utiliser cette extension, ou si elle a profité à votre forum, pensez à <a href="https://paypal.me/RMcGirr83" target="_blank" rel="noreferrer noopener">me payer une bière</a>. Ce serait vivement apprécié. <i class="fa fa-smile-o" style="color:green;font-size:1.5em;" aria-hidden="true"></i>',
]);
