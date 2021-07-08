<div class="speaker-wrap md-text">
<?php foreach($this->speakers as $id => $speaker):?>

<a id="<?=htmlspecialchars($id)?>"> </a>
<section class="speaker-container">
<div class="speaker-img"><img src="images/speakers/<?=urlencode($speaker['pic'])?>" alt=""></div>
<h2 class="speaker-name"><?=htmlspecialchars($speaker['name'])?></h2>
<h4 class="title"><?=htmlspecialchars($speaker['company'])?>&nbsp;<?=htmlspecialchars($speaker['title'])?></h4>
<div class="description">
<p><?=htmlspecialchars($speaker['bio'])?>
</div>
</section>


<?php endforeach;?>
</div>
