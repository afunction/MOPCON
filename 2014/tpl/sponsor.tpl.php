<?php
$levels = [
    // ['css name', '變數名稱', '畫面顯示名稱']
    ['sponsor-platinum', 'ironman', 'Tony Stark'],
    ['sponsor-platinum', 'hacker', 'Hacker'],
    ['sponsor-gold', 'geek', 'Geek'],
    ['sponsor-silver', 'developer', 'Developer'],
    ['sponsor-bronze', 'coder', 'Coder'],
    ['sponsor-gold', 'other', '其他'],
    ['sponsor-bronze', 'special', '特別贊助'],
    ['sponsor-media', 'media', '媒體夥伴'],
];
?>
<div class="sponsor-label">
  <p>強力徵求贊助廠商，請快與我們（ sponsor [at] mopcon.org ）聯繫</p>
  <h3>感謝以下各贊助單位</h3>
</div>

<?php foreach($levels as $level):
if (!isset($this->$level[1])) {
    continue;
}
$sponsors = $this->$level[1];
if (count($sponsors) < 0) {
    continue;
}


?>
<div class="<?= $level[0]?> bg-rotate section">
<h2><?=$level[2]?></h2>
<?php foreach($sponsors as $sponsor):
  // 設定為不顯示的 sponsor 就先不要顯示
  if (isset($sponsor['hidden']) && $sponsor['hidden']) {
      continue;
  }
?>
        <section id="<?=htmlspecialchars($sponsor['id'])?>">
          <header class="sponsor-header">
            <div class="sponsor-img">
              <a href="<?=htmlspecialchars($sponsor['url'])?>" target="_blank">
                <img src="/2014/images/sponsor/<?= htmlspecialchars($sponsor['img']) ?>" alt="<?=htmlspecialchars($sponsor['name'])?>">
              </a>
            </div>
            <!-- <h3 class="sponsor-title"><?=htmlspecialchars($sponsor['name'])?></h3> -->
          </header>
          <div class="article">
              <?=htmlspecialchars($sponsor['desc'])?>
          </div>
        </section>
<?php endforeach;?>

</div>
<?php endforeach;?>

<section>
<h3>主辦單位</h3>
<div class="article">
<p>經濟部加工出口區管理處
</div>
</section>

<section>
<h3>執行單位</h3>
<div class="article">
<ul>
<li>中華民國高雄軟體園區產學策進會</li>
<li>KaLUG</li>
<li>KSDG</li>
<li>Cocaheads Kaohsiung</li>
<li>MOSUT</li>
<li>KIMU</li>
<li>高雄前端社群</li>
<li>AKDG</li>
<li>Mobile Girls</li>
</ul>
</div>
</section>
