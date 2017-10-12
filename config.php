<?php
/**
 *
 * SGS Config
 *
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package PNP Tools
 * @subpackage SGS
 *
 */
/*### GAMESITE DETAILS ###*/
/* ### SYSTEM VERSION ### */
$config['generator'] = 'Satellite Gamesite System';
$config['sgs_version'] = '1.0';
$config['builddate'] = '2-14-11';
/*### SGS ACCOUNT INFORMATION ###*/
$config['sgs_username'] = 'awdev';
$config['sgs_password'] = 'be427f2ffbca4b7fa9963e55591b54d9';
/*### SYSTEM AUTH SETTINGS ###*/
$config['sgs_authenticate_key'] = 'sgscookie';
$config['sgs_authenticate_method'] = 'cookie'; // session
/*## AFFILIATE USER NAME #*/
$config['username']                         = 'WAndErr';
/*## CHANNEL AND  IDENTIFIER SETTINGS #*/
$config['channel_param']                    = 'channel';
$config['channel']                          = 'affiliates';
$config['identifier_param']                 = 'identifier';
$config['identifier']                       = 'af09a1175156';
/**## DIRECTORIES #*/
$config['dir_admin']                        ='admin';
$config['dir_cache']                        = '_cache';
$config['dir_custom']                       = '_custom';
$config['dir_data']                         = '_data';
$config['dir_docs']                         = 'docs';
$config['dir_include']                      = '_include';
$config['dir_module']                       = 'modules';
$config['dir_language']                     = 'language';
$config['dir_templates']                    = 'templates';
$config['dir_test']                         = 'test';
/**## Fetch Method Settings ##*/
$config['fetch_method']                     = 'getcontents';
$config['fetch_timeout']                    = 20; // time in seconds
/**## Cache Life Time Settings ##*/
$config['lifetime_cache']                   = 24; // time in hours
$config['lifetime_cache_genre']             = 24; // time in hours
$config['lifetime_cache_page_mod']          = 5; // time in minutes
/* ### DEFAULT LANGUAGE AND PLATFORM ### */
$config['locale']                           = 'en';
$config['platform']                         = 'pc';
/*## XML and ASSET SERVER #*/
$config['xml_server']                       = 'http://rss.bigfishgames.com/rss.php';
$config['asset_server']                     = 'http://games.bigfishgames.com';
/*## BFG SERVERS ##*/
$config['bfg_servers']['da']                = 'http://www.bigfishgames.dk';
$config['bfg_servers']['de']                = 'http://www.bigfishgames.de';
$config['bfg_servers']['en']                = 'http://www.bigfishgames.com';
$config['bfg_servers']['es']                = 'http://www.bigfishgames.es';
$config['bfg_servers']['fr']                = 'http://www.bigfishgames.fr';
$config['bfg_servers']['it']                = 'http://www.bigfishgames.it';
$config['bfg_servers']['ja']                = 'http://www.bigfishgames.jp';
$config['bfg_servers']['jp']                = 'http://www.bigfishgames.jp';
$config['bfg_servers']['nl']                = 'http://www.bigfishgames.nl';
$config['bfg_servers']['pt']                = 'http://www.bigfishgames.com.br';
$config['bfg_servers']['sv']                = 'http://www.bigfishgames.se';
/*## BFG STORE SERVERS ##*/
$config['bfg_store_servers']['da']          = 'https://store.bigfishgames.dk';
$config['bfg_store_servers']['de']          = 'https://store.bigfishgames.de';
$config['bfg_store_servers']['en']          = 'https://store.bigfishgames.com';
$config['bfg_store_servers']['es']          = 'https://store.bigfishgames.es';
$config['bfg_store_servers']['fr']          = 'https://store.bigfishgames.fr';
$config['bfg_store_servers']['it']          = 'https://store.bigfishgames.it';
$config['bfg_store_servers']['ja']          = 'https://store.bigfishgames.jp';
$config['bfg_store_servers']['jp']          = 'https://store.bigfishgames.jp';
$config['bfg_store_servers']['nl']          = 'https://store.bigfishgames.nl';
$config['bfg_store_servers']['pt']          = 'https://store.bigfishgames.com.br';
$config['bfg_store_servers']['sv']          = 'https://store.bigfishgames.se';
/*##  BFG SITE IDS ## */
$config['bfg_site_ids']['da']               = '17';
$config['bfg_site_ids']['de']               = '2';
$config['bfg_site_ids']['en']               = '1';
$config['bfg_site_ids']['es']               = '4';
$config['bfg_site_ids']['fr']               = '5';
$config['bfg_site_ids']['it']               = '18';
$config['bfg_site_ids']['ja']               = '6';
$config['bfg_site_ids']['jp']               = '6';
$config['bfg_site_ids']['nl']               = '15';
$config['bfg_site_ids']['pt']               = '19';
$config['bfg_site_ids']['sv']               = '16';
/*## DOWNLOAD FOLDER NAMES ##*/
$config['bfg_download_games_folders']['da'] ='download-spil';
$config['bfg_download_games_folders']['de'] ='download-spiele';
$config['bfg_download_games_folders']['en'] ='download-games';
$config['bfg_download_games_folders']['es'] ='juegos-de-descarga';
$config['bfg_download_games_folders']['fr'] ='jeux-a-telecharger';
$config['bfg_download_games_folders']['it'] ='scarica-giochi';
$config['bfg_download_games_folders']['ja'] ='download-games';
$config['bfg_download_games_folders']['jp'] ='download-games';
$config['bfg_download_games_folders']['nl'] ='download-spellen';
$config['bfg_download_games_folders']['pt'] ='jogos-para-baixar';
$config['bfg_download_games_folders']['sv'] ='ladda-ner-spel';
/*## ONLINE FOLDER NAMES ##*/
$config['bfg_online_games_folders']['da']   ='onlinespil';
$config['bfg_online_games_folders']['de']   ='online-spiele';
$config['bfg_online_games_folders']['en']   ='online-games';
$config['bfg_online_games_folders']['es']   ='juegos-en-linea';
$config['bfg_online_games_folders']['fr']   ='jeux-en-ligne';
$config['bfg_online_games_folders']['it']   ='giochi-online';
$config['bfg_online_games_folders']['ja']   ='online-games';
$config['bfg_online_games_folders']['jp']   ='online-games';
$config['bfg_online_games_folders']['nl']   ='online-spellen';
$config['bfg_online_games_folders']['pt']   ='jogos-online';
$config['bfg_online_games_folders']['sv']   ='online-games';
/**## REQUEST URL STRINGS #*/
$config['game_xml_request']                 = '{XML_SERVER}?username={USERNAME}&type=6&locale={LOCALE}&gametype={PLATFORM}'; 
$config['ogplaycount_xml_request']          = '{XML_SERVER}?ogplaycount&locale={LOCALE}'; 
$config['genre_xml_request']                ='{XML_SERVER}?genre&locale={LOCALE}';
/**## Game Info pages #*/
$config['game_info_pc']                     = '{BFG_SERVER}/{DOWNLOAD_GAMES_FOLDER}/{GAMEID}/{FOLDER}/index.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
$config['game_info_mac']                    = '{BFG_SERVER}/{DOWNLOAD_GAMES_FOLDER}/{GAMEID}/mac/{FOLDER}/index.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
$config['game_info_og']                     = '{BFG_SERVER}/{ONLINE_GAMES_FOLDER}/{GAMEID}/{FOLDER}/index.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
$config['game_info_pc_seo']                     = '{BFG_SERVER}/{DOWNLOAD_GAMES_FOLDER}/{GAMEID}/{FOLDER}/index.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
$config['game_info_mac_seo']                    = '{BFG_SERVER}/{DOWNLOAD_GAMES_FOLDER}/{GAMEID}/mac/{FOLDER}/index.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
$config['game_info_og_seo']                     = '{BFG_SERVER}/{ONLINE_GAMES_FOLDER}/{GAMEID}/{FOLDER}/index.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
/**## DOWNLOAD URL'S #*/
$config['download_pc']                      = '{BFG_SERVER}/{DOWNLOAD_GAMES_FOLDER}/{GAMEID}/{FOLDER}/download.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
$config['download_mac']                     = '{BFG_SERVER}/{DOWNLOAD_GAMES_FOLDER}/{GAMEID}/mac/{FOLDER}/download.html?{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
/**## ASSET SERVER PLAY URL #*/
$config['play_og']                          = '{ASSET_SERVER}/{FOLDERNAME}/online/index.html';
/**## PURCHASE URL #*/
$config['purchase_game']                    = '{BFG_STORE_SERVER}/cart.php?productID={PRODUCTID}&siteID={BFG_SITE_ID}&{CHANNEL_PARAM}={CHANNEL}&{IDENTIFIER_PARAM}={IDENTIFIER}';
/*### DEVELOPER SETTINGS ###*/
/*### ERROR_REPORTING CHART ###*/
/*
value	constant
1		E_ERROR
2		E_WARNING
4		E_PARSE
8		E_NOTICE
16		E_CORE_ERROR
32		E_CORE_WARNING
64		E_COMPILE_ERROR
128		E_COMPILE_WARNING
256		E_USER_ERROR
512		E_USER_WARNING
1024	E_USER_NOTICE
6143	E_ALL
*/
$config['error_reporting'] = '0';
/*##########################################*/
?>