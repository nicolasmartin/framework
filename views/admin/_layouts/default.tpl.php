<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title>Administration : <?= $this->slot('TITLE') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.combined.css" media="screen, print">
    <link rel="stylesheet" type="text/css" href="/admin/themes/simple/css/styles.combined.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/admin/js/superfish/superfish.css" media="screen">
<?= $this->slot('SCRIPTS') ?>
    <script src="/admin/js/scripts.combined.js"></script>
    <script src="/admin/js/superfish/superfish.js"></script>
<?= $this->slot('STYLES') ?>
</head>
<body<?= $this->slot('ID', '', ' id="%s"') ?> <?= BrowserHelper::getClass(true) ?>>

<div id="container">
<?= $this->partial('header') ?>
<?= $this->partial('nav') ?>
<?= $this->partial('flash') ?>
<?= $this->slot('CONTENT') ?>
<?= $this->partial('footer') ?>
</div><!-- /container -->

<script>
	$('#navbar .menu').superfish({
		speed: 			'fast',
		dropShadows:	false,
		disableHI:  	false     	
	});
</script>
</body>
</html>