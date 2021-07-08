<?php
$memcache_ok = function_exists("memcache_connect");
header("Content-Type: application/json");
if (!$memcache_ok) {
    echo fetchFacebookFeed();
}


$mc = memcache_connect('localhost', 11211);
$cached_feed = memcache_get($mc, 'fb_feed');

if ($cached_feed) {
    echo $cached_feed;
} else {
    $feed = fetchFacebookFeed();
    memcache_set($mc, 'fb_feed', $feed, 0, 60*60);
    echo $feed;
}

//////////////////////////////////////////////////////////////////////////////////////////

function fetchFacebookFeed(){
    // set request header
    // Facebook feed.php is not working if it thinks you are not a good browser
    $opts = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>
            "Host: www.facebook.com\r\n".
            "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:25.0) Gecko/20100101 Firefox/25.0\r\n".
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n".
            "Accept-Language: zh-tw,zh;q=0.8,en-us;q=0.5,en;q=0.3\r\n"
      )
    );
    $ctx = stream_context_create($opts);

    // fetch the feed
    $a = file_get_contents('http://www.facebook.com/feeds/page.php?format=json&id=219967208129003', false, $ctx);
    return $a;
}