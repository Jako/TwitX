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
 * @subpackage classfile
 *
 * TwitX Classfile
 */
class TwitX {

	/**
	 * The corepath of TwitX.
	 * @var string $twitxCorePath
	 * @access private
	 */
	private $twitxCorePath;

	/**
	 * The Twitter Consumer Key.
	 * @var string $twitterConsumerKey
	 * @access private
	 */
	private $twitterConsumerKey;

	/**
	 * The Twitter Consumer Secret.
	 * @var string $twitterConsumerSecret
	 * @access private
	 */
	private $twitterConsumerSecret;

	/**
	 * The Twitter Access Token.
	 * @var string $twitterAccessToken
	 * @access private
	 */
	private $twitterAccessToken;

	/**
	 * The Twitter Access Token Secret.
	 * @var string $twitterAccessTokenSecret
	 * @access private
	 */
	private $twitterAccessTokenSecret;

	/**
	 * Limit the number of statuses to display.
	 * @var string $limit
	 * @access private
	 */
	private $limit;

	/**
	 * Template for one twitter status.
	 * @var string $tweetTpl
	 * @access private
	 */
	private $tweetTpl;

	/**
	 * Template displayed after successfull tweet.
	 * @var string $tweetedTpl
	 * @access private
	 */
	private $tweetedTpl;

	/**
	 * The displayed timeline in timeline mode.
	 * @var string $timeline
	 * @access private
	 */
	private $timeline;

	/**
	 * The search string in search mode.
	 * @var string $search
	 * @access private
	 */
	private $search;

	/**
	 * The list name in list mode.
	 * @var string $list
	 * @access private
	 */
	private $list;

	/**
	 * Text to tweet in tweet mode.
	 * @var string $tweet
	 * @access private
	 */
	private $tweet;

	/**
	 * Decode the entities of a tweet.
	 * @var boolean $decodeUrls
	 * @access private
	 */
	private $decodeEntities;

	/**
	 * Decode shortened t.co urls.
	 * @var boolean $decodeUrls
	 * @access private
	 */
	private $decodeUrls;

	/**
	 * Seconds the twitter feed is cached.
	 * @var integer $cache
	 * @access private
	 */
	private $cache;

	/**
	 * Screen name for tweets, timelines and lists.
	 * @var string $screenName
	 * @access private
	 */
	private $screenName;

	/**
	 * The target blank string.
	 * @var string $targetBlank
	 * @access private
	 */
	private $targetBlank;

	/**
	 * The rel nofollow string.
	 * @var boolean $relNofollow
	 * @access private
	 */
	private $relNofollow;

	/**
	 * Include retweets.
	 * @var boolean $includeRetweets
	 * @access private
	 */
	private $includeRetweets;

	/**
	 * Output separator beween two tweets.
	 * @var string $outputSeparator
	 * @access private
	 */
	private $outputSeparator;

	/**
	 * TwitX constructor
	 *
	 * @param modX $modx A reference to the modX instance
	 * @param array $config An array of configuration properties
	 */
	public function __construct(modX &$modx, array $config = array()) {
		$this->modx = & $modx;
		$this->twitxCorePath = $modx->getOption('twitx.core_path', null, $modx->getOption('core_path') . 'components/twitx/');
		$this->twitterConsumerKey = $modx->getOption('twitterConsumerKey', $config, $modx->getOption('twitx.twitter_consumer_key', NULL, FALSE, TRUE), TRUE);
		$this->twitterConsumerSecret = $modx->getOption('twitterConsumerSecret', $config, $modx->getOption('twitx.twitter_consumer_secret', NULL, FALSE, TRUE), TRUE);
		$this->twitterAccessToken = $modx->getOption('twitterAccessToken', $config, $modx->getOption('twitx.twitter_access_token', NULL, FALSE, TRUE), TRUE);
		$this->twitterAccessTokenSecret = $modx->getOption('twitterAccessTokenSecret', $config, $modx->getOption('twitx.twitter_access_token_secret', NULL, FALSE, TRUE), TRUE);
		$this->limit = intval($modx->getOption('limit', $config, 5));
		$this->tweetTpl = $modx->getOption('tweetTpl', $config, '@FILE templates/tweetTpl.html');
		$this->tweetedTpl = $modx->getOption('tweetedTpl', $config, '@FILE templates/tweetedTpl.html');
		$this->timeline = $modx->getOption('timeline', $config, 'user_timeline');
		$this->search = $modx->getOption('search', $config, '');
		$this->list = $modx->getOption('list', $config, '');
		$this->tweet = $modx->getOption('tweet', $config, '');
		$this->decodeEntities = (boolean) $modx->getOption('decodeEntities', $config, TRUE);
		$this->decodeUrls = (boolean) $modx->getOption('decodeUrls', $config, TRUE);
		$this->cache = intval($modx->getOption('cache', $config, 7200));
		$this->screenName = $modx->getOption('screen_name', $config, 'FALSE');
		$this->targetBlank = ($modx->getOption('targetBlank', $config, TRUE)) ? ' target="_blank"' : '';
		$this->relNofollow = ($modx->getOption('relNofollow', $config, TRUE)) ? ' rel="nofollow"' : '';
		$this->includeRetweets = (boolean) $modx->getOption('includeRts', $config, TRUE);
		$this->outputSeparator = $modx->getOption('outputSeparator', $config, "\n", TRUE);

		$this->cacheElementKey = 'TwitX_' . md5($modx->toJSON($config));
		$this->cacheOptions = array(
			xPDO::OPT_CACHE_KEY => 'scripts',
			xPDO::OPT_CACHE_HANDLER => $this->modx->getOption(xPDO::OPT_CACHE_HANDLER, null, 'xPDOFileCache'),
			xPDO::OPT_CACHE_EXPIRES => $this->cache
		);
	}

	/**
	 * Run the differen working modes.
	 *
	 * @access public
	 * @param string $mode The working mode.
	 * @return string The output
	 */
	public function run($mode) {
		switch ($mode) {
			case 'tweet':
				$output = $this->tweet();
				break;
			case 'search':
				$output = $this->getSearch();
				break;
			case 'list':
				$output = $this->getList();
				break;
			case 'timeline':
			default:
				$output = $this->getTimeline();
				break;
		}
		return $output;
	}

	/**
	 * Replace the different parts in tweet text.
	 *
	 * @access public
	 * @param array $tweet A tweet.
	 * @return array A tweet
	 */
	public function twitxFormat($tweet) {
		//replace hashtags,
		if (count($tweet['entities']['hashtags'])) {
			foreach ($tweet['entities']['hashtags'] as $entity) {
				$tweet['text'] = str_replace('#' . $entity['text'], '<a href="https://twitter.com/search?q=%23' . $entity['text'] . '&src=hash"' . $this->targetBlank . $this->relNofollow . '>#' . $entity['text'] . '</a>', $tweet['text']);
			}
		}
		// urls,
		if (count($tweet['entities']['urls'])) {
			foreach ($tweet['entities']['urls'] as $entity) {
				$url = ($this->decodeUrls) ? $entity['expanded_url'] : $entity['url'];
				$tweet['text'] = str_replace($entity['url'], '<a href="' . $url . '"' . $this->targetBlank . $this->relNofollow . '>' . $entity['display_url'] . '</a>', $tweet['text']);
			}
		}
		// user mentions
		if (count($tweet['entities']['user_mentions'])) {
			foreach ($tweet['entities']['user_mentions'] as $entity) {
				$tweet['text'] = str_replace('@' . $entity['screen_name'], '<a href="https://twitter.com/' . $entity['screen_name'] . '"' . $this->targetBlank . $this->relNofollow . '>@' . $entity['screen_name'] . '</a>', $tweet['text']);
			}
		}
		// and media entities
		if (count($tweet['entities']['media'])) {
			foreach ($tweet['entities']['media'] as $entity) {
				$url = ($this->decodeUrls) ? $entity['expanded_url'] : $entity['url'];
				$tweet['text'] = str_replace($entity['url'], '<a href="' . $url . '"' . $this->targetBlank . $this->relNofollow . '>' . $entity['display_url'] . '</a>', $tweet['text']);
			}
		}
		return $tweet;
	}

	/**
	 * Calls TwitterOAuth for tweeting (needs write access) and display the result.
	 *
	 * @access private
	 * @return string The output
	 */
	private function tweet() {
		$output = '';
		if ($this->screenName == '') {
			$this->modx->log(modX::LOG_LEVEL_ERROR, 'TwitX Error: No Twitter screen name set for tweeting.');
		} else {
			// Create new twitteroauth with JSON format
			$twitteroauth = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret, $this->twitterAccessToken, $this->twitterAccessTokenSecret);
			$twitteroauth->format = 'json';
			$twitteroauth->decode_json = FALSE;

			// Set twitter options
			$options = array(
				'screen_name' => $this->screenName,
				'text' => urlencode(substr($this->modx->stripTags($this->tweet), 0, 140))
			);

			// Send tweet by Twitter API
			$json = $twitteroauth->post('direct_messages/new.json', $options);

			// Decode the results
			$json = json_decode($json, TRUE);

			if (isset($json['error'])) {
				// If there any errors from Twitter ...
				$this->modx->log(modX::LOG_LEVEL_ERROR, 'TwitX Error: Could not send the Tweet. Twitter responded with the error "' . $json->error . '".');
			} else {
				// Output the results
				$this->modx->modxchunkie->setTemplate($this->modx->modxchunkie->getTemplate($this->tweetedTpl));
				$this->modx->modxchunkie->createVars($json);
				$output = $this->modx->modxchunkie->render();
			}
		}
		return $output;
	}

	/**
	 * Calls TwitterOAuth for twitter timeline and display the result.
	 *
	 * @access private
	 * @return string The output
	 */
	private function getTimeline() {
		// Try loading the data from cache first
		$json = $this->modx->cacheManager->get($this->cacheElementKey, $this->cacheOptions);
		if (!$json) {
			// Create new twitteroauth with JSON format
			$twitteroauth = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret, $this->twitterAccessToken, $this->twitterAccessTokenSecret);
			$twitteroauth->format = 'json';
			$twitteroauth->decode_json = FALSE;

			// Request statuses with optinal parameters
			$options = array(
				'count' => $this->limit,
				'include_rts' => $this->includeRetweets
			);
			// If we have a screen_name, pass this to Twitter API
			if ($this->screenName != '') {
				$options['screen_name'] = $this->screenName;
			}
			// If we want to decode the urls, pass include_entities to Twitter API
			if ($this->decodeEntities) {
				$options['include_entities'] = true;
			}
			// If we are viewing favourites or regular statuses
			if ($this->timeline != 'favorites') {
				$timeline = 'statuses/' . $this->timeline;
			} else {
				$timeline = 'favorites/list';
			}
			// Call Twitter API
			$json = $twitteroauth->get($timeline, $options);
		}

		// Decode the results
		$statuses = json_decode($json, TRUE);

		if (isset($statuses['error'])) {
			// If there any errors from Twitter ...
			$this->modx->log(modX::LOG_LEVEL_WARN, 'TwitX Error: Could not load timeline. Twitter responded with the error "' . $json->error . '".');
		} else {
			// Else save the result of the Twitter API call
			$this->modx->cacheManager->set($this->cacheElementKey, $json, $this->cache, $this->cacheOptions);

			// For each result, output it
			$tweets = array();
			$iteration = 1;
			foreach ($statuses as $status) {
				$status['twitx.iteration'] = $iteration;
				$class = ($iteration == 1) ? 'first ' : '';
				$class .= ($iteration % 2) ? 'even ' : 'odd';
				$class .= ($iteration == count($statuses)) ? 'last ' : '';
				$status['twitx.class'] = trim($class);
				if ($this->decodeEntities) {
					// work retweeted text
					if (isset($status['retweeted_status'])) {
						$status['retweeted_status'] = $this->twitxFormat($status['retweeted_status']);
					} else {
						$status['retweeted_status'] = '-';
					}
					// work text
					$status = $this->twitxFormat($status);
				}
				$this->modx->modxchunkie->setTemplate($this->modx->modxchunkie->getTemplate($this->tweetTpl));
				$this->modx->modxchunkie->createVars($status);
				$tweets[] = $this->modx->modxchunkie->render();
				$iteration++;
			}
			$output = implode($this->outputSeparator, $tweets);
		}
		return $output;
	}

	/**
	 * Calls TwitterOAuth for twitter search and display the result.
	 *
	 * @access private
	 * @return string The output
	 */
	private function getSearch() {
		// Try loading the data from cache first
		$json = $this->modx->cacheManager->get($this->cacheElementKey, $this->cacheOptions);
		if (!$json) {
			// Create new twitteroauth with JSON format
			$twitteroauth = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret, $this->twitterAccessToken, $this->twitterAccessTokenSecret);
			$twitteroauth->format = 'json';
			$twitteroauth->decode_json = FALSE;

			// Request statuses with optinal parameters
			$options = array(
				'q' => $this->search,
				'count' => $this->limit
			);

			// If we want to decode the urls, pass include_entities to Twitter API
			if ($this->decodeEntities) {
				$options['include_entities'] = true;
			}
			// Call Twitter API
			$json = $twitteroauth->get('search/tweets', $options);
		}

		// Decode the results
		$statuses = json_decode($json, TRUE);

		if (isset($statuses['error'])) {
			// If there any errors from Twitter ...
			$this->modx->log(modX::LOG_LEVEL_WARN, 'TwitX Error: Could not load timeline. Twitter responded with the error "' . $json->error . '".');
		} else {
			// Else save the result of the Twitter API call
			$this->modx->cacheManager->set($this->cacheElementKey, $json, $this->cache, $this->cacheOptions);

			// For each result, output it
			$tweets = array();
			$iteration = 1;
			foreach ($statuses as $status) {
				$status['twitx.iteration'] = $iteration;
				$class = ($iteration == 1) ? 'first ' : '';
				$class .= ($iteration % 2) ? 'even ' : 'odd';
				$class .= ($iteration == count($statuses)) ? 'last ' : '';
				$status['twitx.class'] = trim($class);
				if ($this->decodeEntities) {
					// work retweeted text
					if (isset($status['retweeted_status'])) {
						$status['retweeted_status'] = $this->twitxFormat($status['retweeted_status']);
					} else {
						$status['retweeted_status'] = '-';
					}
					// work text
					$status = $this->twitxFormat($status);
				}
				$this->modx->modxchunkie->setTemplate($this->modx->modxchunkie->getTemplate($this->tweetTpl));
				$this->modx->modxchunkie->createVars($status);
				$tweets[] = $this->modx->modxchunkie->render();
				$iteration++;
			}
			$output = implode($this->outputSeparator, $tweets);
		}
		return $output;
	}

	/**
	 * Calls TwitterOAuth for twitter search and display the result.
	 *
	 * @access private
	 * @return string The output
	 */
	private function getList() {
		// Try loading the data from cache first
		$json = $this->modx->cacheManager->get($this->cacheElementKey, $this->cacheOptions);
		if (!$json) {
			// Create new twitteroauth with JSON format
			$twitteroauth = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret, $this->twitterAccessToken, $this->twitterAccessTokenSecret);
			$twitteroauth->format = 'json';
			$twitteroauth->decode_json = FALSE;

			// Request statuses with optinal parameters
			$options = array(
				'slug' => $this->list,
				'owner_screen_name' => $this->screenName,
				'count' => $this->limit,
				'include_rts' => $this->includeRetweets
			);

			// If we want to decode the urls, pass include_entities to Twitter API
			if ($this->decodeEntities) {
				$options['include_entities'] = true;
			}
			// Call Twitter API
			$json = $twitteroauth->get('lists/statuses', $options);
		}

		// Decode the results
		$statuses = json_decode($json, TRUE);

		if (isset($statuses['error'])) {
			// If there any errors from Twitter ...
			$this->modx->log(modX::LOG_LEVEL_WARN, 'TwitX Error: Could not load timeline. Twitter responded with the error "' . $json->error . '".');
		} else {
			// Else save the result of the Twitter API call
			$this->modx->cacheManager->set($this->cacheElementKey, $json, $this->cache, $this->cacheOptions);

			// For each result, output it
			$tweets = array();
			$iteration = 1;
			foreach ($statuses as $status) {
				$status['twitx.iteration'] = $iteration;
				$class = ($iteration == 1) ? 'first ' : '';
				$class .= ($iteration % 2) ? 'even ' : 'odd';
				$class .= ($iteration == count($statuses)) ? 'last ' : '';
				$status['twitx.class'] = trim($class);
				if ($this->decodeEntities) {
					// work retweeted text
					if (isset($status['retweeted_status'])) {
						$status['retweeted_status'] = $this->twitxFormat($status['retweeted_status']);
					} else {
						$status['retweeted_status'] = '-';
					}
					// work text
					$status = $this->twitxFormat($status);
				}
				$this->modx->modxchunkie->setTemplate($this->modx->modxchunkie->getTemplate($this->tweetTpl));
				$this->modx->modxchunkie->createVars($status);
				$tweets[] = $this->modx->modxchunkie->render();
				$iteration++;
			}
			$output = implode($this->outputSeparator, $tweets);
		}
		return $output;
	}

}

?>
