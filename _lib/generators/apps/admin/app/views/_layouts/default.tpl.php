<!DOCTYPE html>
<html class="no-js <?= BrowserHelper::getClass(false) ?>">
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title>Administration : <?= $this->slot('TITLE') ?></title>
    <link rel="stylesheet" type="text/css" href="<?= base() ?>/css/styles.css" media="screen, print">
    <link rel="stylesheet" type="text/css" href="<?= base() ?>/js/superfish/superfish.css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?= base() ?>/js/yui-editor/skins/default/skin.css" media="screen">
    <?= $this->slot('STYLES') ?>
    <script src="<?= base() ?>/js/scripts.combined.js"></script>
    <script src="<?= base() ?>/js/superfish/superfish.js"></script>
    <?= $this->slot('SCRIPTS') ?>
</head>

<body<?= $this->slot('ID', '', ' id="%s"') ?>>
<div id="container">
<?= $this->partial('header') ?>
<?= $this->partial('nav') ?>
<?= $this->partial('flash') ?>
<?= $this->slot('CONTENT') ?>
<?= $this->partial('footer') ?>
</div><!-- #container -->
</body>

</html>
<script>
	$('#navbar .menu').superfish({
		speed: 			'fast',
		dropShadows:	false,
		disableHI:  	false     	
	});
	$('.editor').yuiEditor();
</script>
</body>
</html>