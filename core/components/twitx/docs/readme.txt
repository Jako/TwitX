TwitX
================================================================================

Load and display Twitter feeds and post Tweets using the Twitter 1.1 REST API

Features:
--------------------------------------------------------------------------------
This snippet loads Twitter feeds using the Twitter 1.1 REST API.

You will need to create a Twitter App and get the keys, secrets and token on
https://dev.twitter.com/apps/new

Installation:
--------------------------------------------------------------------------------
MODX Package Management

Usage
--------------------------------------------------------------------------------
Create a Twitter App on https://dev.twitter.com/apps/new and note the Consumer
Key and the Consumer Secret. On that page you have to create an Access Token
and note the Access Token and the Access Token Secret. These values have to be
used later in the snippet call (or in the system settings for global use).

Basic snippet call:

[!TwitX?
    &twitterConsumerKey=`aaaa`
    &twitterConsumerSecret=`bbbb`
    &twitterAccessToken=`cccc`
    &twitterAccessTokenSecret=`dddd`
    &screenName=`xxxx`
!]

The snippet could use the following properties:

Property | Description | Default
-------- | ----------- | -------
twitterConsumerKey | **Required:** The Twitter Consumer Key | -
twitterConsumerSecret | **Required:** The Twitter Consumer Secret | -
twitterAccessToken | **Required:** The Twitter Access Token | -
twitterAccessTokenSecret | **Required:** The Twitter Access Token Secret | -
limit | Limit the number of statuses to display | 5
tweetTpl | Template chunk for one twitter status | tweetTpl.html in folder templates
tweetedTpl | Template chunk displayed after successfull tweet | tweetedTpl.html in folder templates
mode | The snippet mode (could be timeline, search, list and tweet)	| timeline
timeline | The displayed timeline in timeline mode* | user_timeline
search | The search string in search mode | -
list | The list name in list mode | -
tweet | Text to tweet in tweet mode | -
decodeEntities | Decode the entities of a tweet | 1
decodeUrls | Decode shortened t.co urls | 1;
cache | Seconds the twitter feed is cached (0 = disable cache) | 7200
screenName | Screen name for tweets, timelines and lists | -
targetBlank | All a tags have target="_blank" | 1
relNofollow | All a tags have rel="nofollow" | 1
includeRts | Include retweets | 1
outputSeparator | Separator between two tweets | newline
toPlaceholder | A placeholder name the snippet output is assigned to. Surpesses normal snippet output | -

* Possible timelines: favorites, mentions_timeline, user_timeline, home_timeline, retweets_of_me

The Twitter Key/Token and Secrets could be globally set in system settings.

Placeholder
--------------------------------------------------------------------------------
Look in the Twitter 1.1 REST API for possible placeholder in the TwitX template.

Each mode uses a different resource:

Mode | Resource
-----|---------
timeline | See different timelines and favorites/list
search | See search/tweets
list  | lists/statuses

Each member of the response object could be referenced by its name. Members of
a member could be referenced by name of the parent member and the name of the
member divided by .

Example response object:

[
  {
    "created_at": "Wed Aug 29 17:12:58 +0000 2012",
    "entities": {
      "urls": [
        {
          "expanded_url": "https://dev.twitter.com/blog/twitter-certified-products"
        }
      ]
    }
  }
]

Possible placeholder showing a value are: [[+created_at]]
[[+entities.urls.expanded_url]]

These placeholder could be modified by output modifiers.

Notes:
--------------------------------------------------------------------------------
1. Uses modxChunkie Class
2. Uses TwitterOAuth Class: https://github.com/abraham/twitteroauth
3. TwitX is based loose on TwitterX: http://modx.com/extras/package/twitterx
