<?php

$release_branch= ('dev.mopcon.org' === $_SERVER['HTTP_HOST']) ? 'develop' : 'deploy'; // 這個變數應該寫死，不可以從外部參數帶進來，否則會有安全問題！！
$release_ref = "refs/heads/{$release_branch}";

$doc_root = __DIR__ . '/../';
//////////////////////////////////////////////////////////////////////////////////

// 處理送來的資料，如果無法正常解析就不處理
$payload = json_decode($_POST['payload'], true);
if (!is_array($payload)) {
    echo "Webhook 資料解讀失敗，不 deploy\n";
    exit;
}


// 只處理 release branch 的 push
if ($release_ref != $payload['ref']) {
    echo "ref={$payload['ref']}，不 deploy\n";
    exit;
}

// pull 最新的 code 下來
echo "deploy....";
exec("git reset --hard");
exec("git pull origin {$release_branch} -f");
echo "OK\n";

// 如果有 composer.lock，跑 composer install
$composer_lock_path = "{$doc_root}composer.json";
if (is_file($composer_lock_path)) {
    echo "composer install....\n";
    exec(
        "COMPOSER_HOME=\"{$doc_root}\" composer install -on -d {$doc_root} 2>&1",
        $out
    );
    foreach ($out as $line) {
        echo "  {$line}\n";
    }
    echo "done\n";
} else {
    echo "'{$composer_lock_path}' does not exist, do not composer update";
}

// Build api folder
exec("cd {$doc_root}api && composer install --no-dev");

exec("cd {$doc_root} && /usr/local/nvm/versions/node/v8.11.0/bin/npm install");

// Build 2019 web site
//exec("cd {$doc_root}2019-dev && /usr/local/nvm/versions/node/v8.11.0/bin/yarn install");
//exec("cd {$doc_root}2019-dev && /usr/local/nvm/versions/node/v8.11.0/bin/yarn run generate");

// 如果有 memcache，把最新的 deploy 狀況寫入 memcache
$memcache_ok = function_exists("memcache_connect");
if ($memcache_ok) {
    $current_commit_id = $payload['after'];
    $date = date('Y-m-d H:i:s');
    $deploy_status = [
        'commit_id'    => $current_commit_id,
        'deploy_time'  => $date
    ];

    $mc = memcache_connect('localhost', 11211);

    memcache_set($mc, 'deploy_status', $deploy_status);
}

