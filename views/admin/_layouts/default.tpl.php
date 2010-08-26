<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="<?= $this->slot('CONTENT_TYPE', 'text/html') ?>; charset=<?= $this->slot('CHARSET', 'UTF-8') ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <title>Administration : <?= $this->slot('TITLE') ?></title>
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.combined.css" media="screen, print" />
    <link rel="stylesheet" type="text/css" href="/admin/themes/simple/css/styles.combined.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/admin/js/superfish/superfish.css" media="screen" />
<?= $this->slot('SCRIPTS') ?>
    <script type="text/javascript" src="/admin/js/scripts.combined.js"></script>
    <script type="text/javascript" src="/admin/js/superfish/superfish.js"></script>
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

<script type="text/javascript" >
	$('#navbar .menu').superfish({
		speed: 			'fast',
		dropShadows:	false,
		disableHI:  	false     	
	});
</script>
</body>
</html>