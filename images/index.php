<?php
/**
 * SGS: Redirect.
 * File: index.php
 *
 *
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package PNP Tools
 * @subpackage SGS
 *
 *
 */
require_once('../core_gamesite.php');
if(!defined('SGS_INIT')){ exit; }
header('location:'.SGS_BASE_URL.'error.php?'.SGS_QUERY);
exit;
?>