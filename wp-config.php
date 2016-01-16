<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Le script de création wp-config.php utilise ce fichier lors de l'installation.
 * Vous n'avez pas à utiliser l'interface web, vous pouvez directement
 * renommer ce fichier en "wp-config.php" et remplir les variables à la main.
 * 
 * Ce fichier contient les configurations suivantes :
 * 
 * * réglages MySQL ;
 * * clefs secrètes ;
 * * préfixe de tables de la base de données ;
 * * ABSPATH.
 * 
 * @link https://codex.wordpress.org/Editing_wp-config.php 
 * 
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', 'C:\Users\gbrutkiewicz\Desktop\PROJETS\GESTION\site-laurent\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'laurentdjcldaidb');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'laurentdjcldaidb');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'Ldai24031977');

/** Adresse de l'hébergement MySQL. */
//define('DB_HOST', 'laurentdjcldaidb.mysql.db');
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
define('AUTH_KEY',         'jb,tqD]BaGGWFJ3(|i?>xIm_-8cX%^>[/66Qi&P,d{,Rpu=+yE-DkO4PN|eUKCo2');
define('SECURE_AUTH_KEY',  '#&j6cyr^9_M5|&Xw7/KN(a?`[&OQA5<9!``Dla=.+e=8}VekW;3/0$ATKk{|yC=U');
define('LOGGED_IN_KEY',    'nZ~@ZSd,9AYleo lfL%MLlgc,6)gK% t~<fnNU_8{Om|67?@XwCPpKLQwCmbxRK*');
define('NONCE_KEY',        'F~>%iLBjoNYiDkBe~w)9#M+npilwEQ&NGO|+2`;;=csvX?It:s2(&;J7sJ7EGH! ');
define('AUTH_SALT',        'oi@]j)*NEbMD+D-%Iuwp-B/rq1-_HFI:tM:y&.8mF2Vn+Q ; /7f.aw-e+3|3;n=');
define('SECURE_AUTH_SALT', '@53yBR7,kwpLBZ|yd>lwdlk@w|+1K`oix?bm#}xfX<!H]zk)MQ5em+@P+k73P3+*');
define('LOGGED_IN_SALT',   '-C@%%k$/P,p|gO4JWOtbWpIMieXWe~>dwzc(qg(^KCo,&^T&1M!154W+C=+3q-`~');
define('NONCE_SALT',       '+dLw+a3+m&geH#vtW5*j0s?!J#W0! C411Jn+++X[WR=T%Juu9uyEKb<4S!F]Uf0');
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
 * Pour les développeurs : le mode déboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 * 
 * Pour obtenir plus d'information sur les constantes 
 * qui peuvent être utilisée pour le déboguage, consultez le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');