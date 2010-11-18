[?php
	$this->set('ID', 			"{#controller#}-page");
	$this->set('TITLE', 		"{#Controller#}");
	$this->set('DESCRIPTION',	"{#Controller#} page");
?]

<div id="content" class="row">
	<div id="main" class="col3-4 first">
		<h1>{#Controller#}</h1>

		[?= $this->partial('flash') ?]
	</div><!-- #main -->

	<div id="sidebar" class="col1-4 last">
		
	</div><!-- #sidebar -->
</div><!-- #content -->
