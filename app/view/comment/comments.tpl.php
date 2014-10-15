<hr>
<?php if (is_array($comments)) : ?>
<div class='comments'>
	<h4>Kommentarer (<?=count($comments)?> st)</h4>
<?php foreach ($comments as $id => $comment) : ?>
	<div class='comment'>
		<img id='profile' src='http://www.gravatar.com/avatar/<?= md5(strtolower(trim($comment['mail']))) . '.jpg?s=80'?>' alt='Profilbild'/>
		<div>
			<header><a href='<?=$this->url->create("comment/edit/{$id}")?>'>Id <?=$id?>:</a>
				<span id='name'><?=$comment['name']?></span>
				<time><?=date('H:i', $comment['timestamp'])?></time>
				[webb: <a href='<?=$comment['web']?>'><?=$comment['web']?></a>, epost: <a href='mailto:<?=$comment['mail']?>'><?=$comment['mail']?></a>]
			</header>
			<main>
				<p><?=$comment['content']?></p>
			</main>
			<footer>
				<a class='button' href='<?=$this->url->create("comment/remove/{$id}")?>'>Radera kommentar</a>
			</footer>
		</div>
	</div>
<?php endforeach; ?>
</div>
<?php endif; ?>