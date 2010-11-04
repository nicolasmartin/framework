[?php
	$this->set('ID', 			"{#controller#}-page") ?>");
	$this->set('TITLE', 		"<?= cfirst("{#plural#}") ?>");
	$this->set('DESCRIPTION',	"Les {#plural#}");
?]

<div id="content" class="row {#collection#}">
	<div id="main" class="col3-4 first">
		<h1><?= ucfirst("{#plural#}") ?></h1>

		[?= $this->partial('flash') ?]
	</div><!-- #main -->

	<div id="sidebar" class="col1-4 last">
		
	</div><!-- #sidebar -->
</div><!-- #content -->
