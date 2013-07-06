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
 * Snippets for TwitX package
 */
$snippets = array();

$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
	'id' => 1,
	'name' => 'TwitX',
	'description' => 'Load and display Twitter feeds and post Tweets using the Twitter 1.1 REST API',
	'snippet' => getSnippetContent($sources['snippets'] . 'twitx.snippet.php'),
		), '', true, true);
$properties = include $sources['properties'] . 'twitx.properties.php';
$snippets[1]->setProperties($properties);
unset($properties);

return $snippets;