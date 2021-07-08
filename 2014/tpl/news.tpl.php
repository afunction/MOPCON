<?php foreach($this->articles as $article):?>
	<?php
        date_default_timezone_set('Asia/Taipei');
		$timestamp = strtotime($article['created_time']);
		$time['y'] = date('Y', $timestamp);
		$time['m'] = date('m', $timestamp);
		$time['d'] = date('d', $timestamp);
	?>
	<section class="anti-☢">
		<time>
			<em><?=(int) $time['y'] ?></em><br><?=(int) $time['m'] ?>/<?=(int) $time['d'] ?>
			<svg class="news-svg" width="72" height="72">
	          <line class="news-svg-top" x1="0" y1="0" x2="216" y2="0"/>
	          <line class="news-svg-left" x1="0" y1="72" x2="0" y2="-144"/>
	          <line class="news-svg-bottom" x1="72" y1="72" x2="-144" y2="72"/>
	          <line class="news-svg-right" x1="72" y1="0" x2="72" y2="216"/>
	     	</svg>
		</time>
		<div class="news-content">
			<?php if(isset($article['name'])): ?>
			<h2><?= $article['name'] ?></h2>
			<?php endif;?>
			<div class="news-label">
				<?php if(isset($article['picture'])): ?><img align="left" style="margin: 0 1em 1em 0" src="<?=htmlspecialchars($article['picture'])?>"></img><?php endif;?>
				<p><?= nl2br($article['message']) ?>
                <div style="clear:both;">&nbsp;</div>
				<p><?php if(isset($article['link'])): ?><a href="<?=htmlspecialchars($article['link'])?>">連結</a><?php endif;?>
			</div>
		</div>
	</section>

<?php endforeach;?>
