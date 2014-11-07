<div class='page'>
	<h2>Användare</h2>
	<ul>
	<?php foreach ($userValues as $key => $value) : ?>
		<li><pre><?=$key . ': ' . $value; ?></pre></li>
	<?php endforeach; ?>
	</ul>
</div>