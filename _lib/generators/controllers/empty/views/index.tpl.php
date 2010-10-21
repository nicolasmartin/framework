[?php
	$this->set('TITLE', 		'<?= ucfirst($settings['plural']) ?>');
	$this->set('DESCRIPTION',	'Les <?= ucfirst($settings['plural']) ?>');
?]

<div id="content" class="row <?= strtolower($settings['collection']) ?>">
	<div id="main" class="col3-4 first">
		<h1><?= ucfirst($settings['plural']) ?></h1>
		
	</div><!-- #main -->

	<div id="sidebar" class="col1-4 last">
		
	</div><!-- #sidebar -->
</div><!-- #content -->
