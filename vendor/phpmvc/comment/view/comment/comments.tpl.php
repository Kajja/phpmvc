<hr>

<h2>Comments</h2>

<?php if (is_array($comments)) : ?>
<div class='comments'>
<?php foreach ($comments as $id => $comment) : ?>
<h4>Kommentar #<?=$id?></h4>
<p>
	<?php $comment['name']?>
</p>
<?php endforeach; ?>
</div>
<?php endif; ?>