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
 * TwitX is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * TwitX; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package twitx
 * @subpackage snippet
 *
 * TwitX Snippet
 */
$twitxCorePath = $modx->getOption('twitx.core_path', NULL, $modx->getOption('core_path') . 'components/twitx/');

// Twitter API keys and secrets
$twitterConsumerKey = $modx->getOption('twitter_consumer_key', $scriptProperties, $modx->getOption('twitx.twitter_consumer_key', NULL, FALSE), TRUE);
$twitterConsumerSecret = $modx->getOption('twitter_consumer_secret', $scriptProperties, $modx->getOption('twitx.twitter_consumer_secret', NULL, FALSE), TRUE);
$twitterAccessToken = $modx->getOption('twitter_access_token', $scriptProperties, $modx->getOption('twitx.twitter_access_token', NULL, FALSE), TRUE);
$twitterAccessTokenSecret = $modx->getOption('twitter_access_token_secret', $scriptProperties, $modx->getOption('twitx.twitter_access_token_secret', NULL, FALSE), TRUE);

// Other options
$mode = $modx->getOption('mode', $scriptProperties, 'timeline');
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, '', TRUE);

$modx->getService('modxchunkie', 'modxChunkie', $twitxCorePath . 'model/modxchunkie/', array('basepath' => str_replace(MODX_BASE_PATH, '', $twitxCorePath)));
$modx->getService('twitx', 'twitx', $twitxCorePath . 'model/twitx/', $scriptProperties);

if (!class_exists('TwitterOAuth')) {
	require $twitxCorePath . 'model/twitteroauth/twitteroauth.php';
}

// output
$output = '';
// If they haven't specified the required Twitter keys, we cannot continue...
if (!$twitterConsumerKey || !$twitterConsumerSecret || !$twitterAccessToken || !$twitterAccessTokenSecret) {
	$modx->log(modX::LOG_LEVEL_ERROR, 'TwitX Error: Could not load TwitX as required values were not passed.');
} else {
	// Test for required function(s)
	if (!function_exists('curl_init')) {
		$modx->log(modX::LOG_LEVEL_WARN, 'TwitX Error: cURL functions do not exist, cannot continue.');
	} else {
		$output = $modx->twitx->run($mode);
		// Output to placeholder
		if ($toPlaceholder != '') {
			$modx->setPlaceholder($toPlaceholder, $output);
			$output = '';
		}
	}
}
return $output;
?>