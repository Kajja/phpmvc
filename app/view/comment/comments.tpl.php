<hr>
<?php if (is_array($comments)) : ?>
<div class='comments'>
	<h2>Kommentarer</h2>
<?php foreach ($comments as $id => $comment) : ?>
	<div class='comment' style='margin-bottom: 1em;'>
		<header style='background-color: lightgrey;'>Id <a href='#'><?=$id?></a>
			<?php echo date('H:i', $comment['timestamp']) . ' ' . $comment['name'] . ' (webb:' . $comment['web'] . ', epost:' . $comment['mail'] . ')'; ?>
		</header>
		<main>
			<p>
			<?php echo $comment['content']; ?>
			</p>
		</main>
		<footer style='border-bottom: solid 1px grey;'>
		<a href='<?=$this->url->create("comment/remove/{$id}")?>'>Radera kommentar</a>
		</footer>
	</div>
<?php endforeach; ?>
</div>
<?php endif; ?>