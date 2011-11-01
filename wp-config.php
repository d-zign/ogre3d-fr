<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'ogredfr_main');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'ogredfr_ogredfr');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9^`,g.|pY]H|~lbh03%SHX:G>cZn-np#1BN0v|XT-.sDOxq- +3;,4g_U^qjYZ*`'); 
define('SECURE_AUTH_KEY',  '5JYyWo$nbv8`CP!.iaM<D[@I,[~!3:Lb4Z>w|7%vmIWQ~ewQ@@Rk(+.xl{*LP`{X'); 
define('LOGGED_IN_KEY',    'L#.8VlBHc|013alpn6rp{jx,p3)~5T}KJDy8oL[C9$vP;L}]u>OB=rr-dic=XzL4'); 
define('NONCE_KEY',        '.R.ITuw;+c:GmpCB|3@Z,t<:a,PZuWL?yI13FGSJ@U8N+f,cMGZ=W@8uc4!/-vH{'); 
define('AUTH_SALT',        'x6r5^ZXdJ-3r,NAAo<|,oUfKBP`-V<jo}gm0@%r,An: EnkD=AZLzT7yE`-z#0~]'); 
define('SECURE_AUTH_SALT', '{LO`,;*p#0@02=+=AdF?.pKO;##HUsA[ddzo[?0+x&E&tenaU=Fmr:PM?{^*hz$E'); 
define('LOGGED_IN_SALT',   'ZL!n/8cC!}-B,BmuF+teOV:SU?wvh)Bb^kJfj|JhREBA,@-h6^n]7RmO|r2wuGqY'); 
define('NONCE_SALT',       'd0Yfr=2BAY@paOUU1R_9Z+AaoGdi]Xkh=Zb@<h-CQp?_Y&`m4.d8@*R*_MZ:gO]d'); 
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
