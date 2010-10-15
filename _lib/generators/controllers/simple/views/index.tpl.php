[? $this->set('ID',    '<?= strtolower($settings['model']) ?>Page') ?]
[? $this->set('TITLE', '<?= $settings['plural'] ?>') ?]
<div id="content">
	<div id="main" class="<?= strtolower($settings['collection']) ?>">
		<h1><?= $settings['plural'] ?></h1>

	</div><!-- #main -->
</div><!-- #content -->

