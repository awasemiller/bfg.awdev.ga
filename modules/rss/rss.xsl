<?xml version="1.0" encoding="utf-8"?>
<!--
 * SGS Module: RSS
 * File: rss.xsl
 *
 * Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @file rss.xsl
 * @author William Moffett <william.moffett@bigfishgames.com>
 * @version 1.0
 * @package PNP Tools
 * @subpackage SGS
 *
 * @copyright Copyright (c) 2007 - 2011 Big Fish Games, Inc.
 * @license http://creativecommons.org/licenses/GPL/2.0/ Creative Commons GNU GPL
-->
<!DOCTYPE xsl:stylesheet  [
	<!ENTITY nbsp   "&#160;">
	<!ENTITY copy   "&#169;">
	<!ENTITY reg    "&#174;">
	<!ENTITY trade  "&#8482;">
	<!ENTITY mdash  "&#8212;">
	<!ENTITY ldquo  "&#8220;">
	<!ENTITY rdquo  "&#8221;">
	<!ENTITY pound  "&#163;">
	<!ENTITY yen    "&#165;">
	<!ENTITY euro   "&#8364;">
]>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<!-- encoding="UTF-8" currently breaks IE6-->
<xsl:output method="html" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<!-- lanfile -->
<xsl:variable name="lanfile" select="document(concat('language/',rss/channel/language,'.xsl'))"/>
<!-- title -->
<xsl:variable name="title" select="rss/channel/title"/>
<!--  description -->
<xsl:variable name="description" select="rss/channel/description"/>
<!-- content -->
<xsl:variable name="content" select="rss/channel/language"/>
<!-- copyright -->
<xsl:variable name="copyright" select="rss/channel/copyright"/>
<!-- pubDate -->
<xsl:variable name="pubDate" select="rss/channel/pubDate"/>
<!--  Privacy URL -->
<xsl:variable name="privacyurl" select="$lanfile/strings/str[@name='PrivacyURL']"/>
<!-- Terms URL -->
<xsl:variable name="termsurl" select="$lanfile/strings/str[@name='TermsURL']"/>
<!--  Development URL -->
<xsl:variable name="developmenturl" select="$lanfile/strings/str[@name='DevelopmentURL']"/>
<xsl:template match="/">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><xsl:value-of select="rss/channel/title"/></title>
	<meta http-equiv="content-language" content="{$content}"/>
	<meta name="description" content="{$description}" />
	<meta name="copyright" content="{$copyright}" />
	<link href="../../templates/wanda/style.css" rel="stylesheet" type="text/css" />
<style>
	#wmessage{
		width:540px;
		margin:0px 0px 15px 10px;
		padding:10px 5px 10px 10px;
		border:1px solid #a2bdcf;
		border-top:3px solid #a2bdcf;
		background-color:#d4e3f0;
		overflow:hidden;
	}
	#header h2{
		padding:70px 20px 0px 20px;
		width:700px;
		font-size:12px;
		line-height:14px;
		text-align:left;
	}
</style>
</head>
<body>
<div id="page">
	<div id="header">
		<h1> <xsl:value-of select="$title"/></h1>
		<h2><xsl:value-of select="$description" disable-output-escaping="yes"/></h2>
		<div id="utility">
			<p><xsl:value-of select="$pubDate"/></p></div>
			<div id="navigation">
			<ul>
				<li>
					<a href="javascript:history.back()"><xsl:value-of select="$lanfile/strings/str[@name='Back']"/></a>
				</li>
			</ul>
		</div>
	</div>
	<div id="content">
		<div id="main">
			<div id="wmessage">
				<p>
					<xsl:value-of select="$lanfile/strings/str[@name='wmessage']"/>
				</p>
				<h4> <a href=""><img src="../../images/icons/feed-icon-14x14.png" width="14" height="14" /> <span> </span><xsl:value-of select="$lanfile/strings/str[@name='Subscribe to this feed']"/></a></h4>
	        	<p><xsl:value-of select="$lanfile/strings/str[@name='You can subscribe']"/>
				</p>
	              <ul>
	                <li><xsl:value-of select="$lanfile/strings/str[@name='subscribe1']"/></li>
	                <li><xsl:value-of select="$lanfile/strings/str[@name='subscribe2']"/></li>
	                <li><xsl:value-of select="$lanfile/strings/str[@name='subscribe3']"/></li>
	              </ul>
			</div>
			<xsl:for-each select="rss/channel/item">
			<div class="alt_bottom">
				<h3 class="alt_top">
					<xsl:apply-templates select="title"/>
				</h3>
				<div class="alt_text">
					<p class="rss-info">
						<span class="rss-category">
							<xsl:value-of select="category"/>
						</span>
						<span class="rss-pubdate">
							<xsl:value-of select="pubDate"/>
						</span>
					</p>
					<div class="rss-description">
						<p name="decodeable">
							<xsl:value-of select="description" disable-output-escaping="yes"/>
						</p>
						<p><a href="{link}"><xsl:value-of select="$lanfile/strings/str[@name='More']"/></a></p>
				  	</div>
			  	</div>
			</div>
			</xsl:for-each>
			<br />
		</div>
		<div id="sidebar">
			  <div id="subscriptions" class="alt_bottom">
			  	<h4 class="alt_top">
			  		<xsl:value-of select="$lanfile/strings/str[@name='One-click subscriptions']"/>
			  	</h4>
			  	<div class="alt_text">
	              	<p>
	              		<xsl:value-of select="$lanfile/strings/str[@name='subscriptionsInfo']"/>
	              	</p>
				  	<ul>
				  		<li>
	              			<a href="#" onClick="window.location='http://add.my.yahoo.com/rss?url=' + window.location;return false;"><img src="../../images/icons/yahoo.gif" width="16" height="16" /> Add to  My yahoo</a>
						</li>
	              		<li>
							<a href="#" onClick="window.location='http://www.bloglines.com/sub/'+ window.location;return false;"><img src="../../images/icons/bloglines.gif" width="16" height="16" /> Add to Bloglines</a>
						</li>
						<li>
	              			<a href="#" onClick="window.location='http://fusion.google.com/add?feedurl=' + window.location;return false;"><img src="../../images/icons/google.gif" width="16" height="16" /> Add to Google</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<br class="clearfix" />
	</div>
	<div id="footer">
		<div id="fcontent">
		<p><xsl:value-of select="rss/channel/copyright"/></p>
		</div>
		<div id ="copyright">

        <br /> <br />
		</div>
	</div>
</div>
</body>
</html>
</xsl:template>
</xsl:stylesheet>