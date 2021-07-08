<?php
$memcache_ok = function_exists("memcache_connect");
if ($memcache_ok) {
    $mc = memcache_connect('localhost', 11211);
    $deploy_status = memcache_get($mc, 'deploy_status');
    echo "<pre>\n";
    var_export($deploy_status);
    echo "\n</pre>";
} else {
	echo 'Can not get deploy status!';
}
