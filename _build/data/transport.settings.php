<?php
/**
 * TwitX
 *
 * Copyright 2013 by Thomas Jakobi <thomas.jakobi@partout.info>
 *
 * TwitX is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * TwitX is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * TwitX; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package twitx
 * @subpackage build
 *
 * System settings for the TwitX package.
 */
$settings = array();

// Area authentication
$settings['twitx.twitter_consumer_key'] = $modx->newObject('modSystemSetting');
$settings['twitx.twitter_consumer_key']->fromArray(array(
	'key' => 'twitx.twitter_consumer_key',
	'value' => '',
	'namespace' => 'twitx',
	'area' => 'authentication',
		), '', true, true);
$settings['twitx.twitter_consumer_secret'] = $modx->newObject('modSystemSetting');
$settings['twitx.twitter_consumer_secret']->fromArray(array(
	'key' => 'twitx.twitter_consumer_secret',
	'value' => '',
	'namespace' => 'twitx',
	'area' => 'authentication',
		), '', true, true);
$settings['twitx.twitter_access_token'] = $modx->newObject('modSystemSetting');
$settings['twitx.twitter_access_token']->fromArray(array(
	'key' => 'twitx.twitter_access_token',
	'value' => '',
	'namespace' => 'twitx',
	'area' => 'authentication',
		), '', true, true);
$settings['twitx.twitter_access_token_secret'] = $modx->newObject('modSystemSetting');
$settings['twitx.twitter_access_token_secret']->fromArray(array(
	'key' => 'twitx.twitter_access_token_secret',
	'value' => '',
	'namespace' => 'twitx',
	'area' => 'authentication',
		), '', true, true);

return $settings;
