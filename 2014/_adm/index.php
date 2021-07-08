<?php
include __DIR__ . '/../src/sessions.php';

$msgs = [];
if ('refetch_session' === $_POST['act']) {
    sessions(['force_fetch'=>true]);
    $msgs[] = "已重新抓取議程表";
}
?>
<meta charset="utf-8">
<h1>MOPCON 的奇妙後門</h1>
<hr>
<?php foreach($msgs as $msg):?>
<p><?=htmlspecialchars($msg)?>
<?php endforeach?>
<hr>
<form method='post'>
<button name='act' value='refetch_session'>重新抓取議程表 Google Docs 資料</button>（文件在<a href="https://docs.google.com/spreadsheets/d/1st6HxcLFFGmbfwrDyLnccMfjuKHOkSoV_arPHOHM5LM/edit#gid=1775054733" target="_blank">這裡</a>）<br>
