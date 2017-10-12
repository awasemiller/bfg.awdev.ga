<?php
/**
 * SGS: Redirect
 * File: index.php
 *
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package PNP Tools
 * @subpackage SGS
 *
 * redirect to site front page.
 */
	require_once('../../../core_gamesite.php');
	if(!defined('SGS_INIT')){ exit; }
	header('Location: '.SGS_BASE_URL.'index.php');
	exit;
?>