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
 * Properties for the TwitX snippet.
 */
$properties = array(
	array(
		'name' => 'twitterConsumerKey',
		'desc' => 'prop_twitx.twitterConsumerKey',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'twitterConsumerSecret',
		'desc' => 'prop_twitx.twitterConsumerSecret',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'twitterAccessToken',
		'desc' => 'prop_twitx.twitterAccessToken',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'twitterAccessTokenSecret',
		'desc' => 'prop_twitx.twitterAccessTokenSecret',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'limit',
		'desc' => 'prop_twitx.limit',
		'type' => 'textfield',
		'options' => '',
		'value' => '5',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'tweetTpl',
		'desc' => 'prop_twitx.tweetTpl',
		'type' => 'textfield',
		'options' => '',
		'value' => '@FILE templates/tweetTpl.html',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'tweetedTpl',
		'desc' => 'prop_twitx.tweetedTpl',
		'type' => 'textfield',
		'options' => '',
		'value' => '@FILE templates/tweetedTpl.html',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'timeline',
		'desc' => 'prop_twitx.timeline',
		'type' => 'textfield',
		'options' => '',
		'value' => 'user_timeline',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'search',
		'desc' => 'prop_twitx.search',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'list',
		'desc' => 'prop_twitx.list',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'tweet',
		'desc' => 'prop_twitx.tweet',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'decodeEntities',
		'desc' => 'prop_twitx.decodeEntities',
		'type' => 'combo-boolean',
		'options' => '',
		'value' => TRUE,
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'decodeUrls',
		'desc' => 'prop_twitx.decodeUrls',
		'type' => 'combo-boolean',
		'options' => '',
		'value' => TRUE,
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'cache',
		'desc' => 'prop_twitx.cache',
		'type' => 'textfield',
		'options' => '',
		'value' => '7200',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'screenName',
		'desc' => 'prop_twitx.screenName',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'targetBlank',
		'desc' => 'prop_twitx.targetBlank',
		'type' => 'combo-boolean',
		'options' => '',
		'value' => TRUE,
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'relNofollow',
		'desc' => 'prop_twitx.relNofollow',
		'type' => 'combo-boolean',
		'options' => '',
		'value' => TRUE,
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'includeRts',
		'desc' => 'prop_twitx.includeRts',
		'type' => 'combo-boolean',
		'options' => '',
		'value' => TRUE,
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'outputSeparator',
		'desc' => 'prop_twitx.outputSeparator',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	),
	array(
		'name' => 'toPlaceholder',
		'desc' => 'prop_twitx.toPlaceholder',
		'type' => 'textfield',
		'options' => '',
		'value' => '',
		'lexicon' => 'twitx:properties',
	)
);

return $properties;