<?php
include __DIR__.'/../src/Parsedown.php';
?>
<div class="group-wrap">
    <aside class="group-aside">
        <div class="group-list">
<?php foreach($this->communities as $id => $community):?>
                <a href="#">
                    <svg class="hexagonal" x="0px" y="0px" width="120.93px" height="104px" viewBox="0 0 120.93 104" >
                        <polygon  points="30.232,104 0,52 30.232,0 90.697,0 120.93,52 90.697,104 "/>
                    </svg>

                    <span><?=htmlspecialchars($community['sname'])?></span>
                </a>
<?php endforeach;?>

<?php
$community = $this->communities[$this->active];
$parsedown = new Parsedown();
?>
        </div>
    </aside>
<?php foreach($this->communities as $id => $community):?>
    <div class="group-content-wrap">
        <div class="group-content" >
        <div class="group-img" ><img src="<?=htmlspecialchars($community['img'])?>"></div>
        <div class="group-name"><?=htmlspecialchars($community['name'])?></div>
        <div class="group-links">
<?php foreach($community['links'] as $link):?>
            <a href="<?= htmlspecialchars($link['url']) ?>"><i class="<?= htmlspecialchars($link['icon']) ?>"></i></a>
<?php endforeach;?>
        </div>
        <div class="group-banner">

        </div>
        <div class="group-article md-text">
        <?=$parsedown->text($community['desc_md']); ?>
        </div>
        </div>
    </div>
<?php endforeach;?>
</div>
