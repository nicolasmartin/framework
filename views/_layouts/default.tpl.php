<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
	<meta http-equiv="Content-Type" content="<?= $this->slot('CONTENT_TYPE', 'text/html') ?>; charset=<?= $this->slot('CHARSET', 'UTF-8') ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>" />
    <title><?= $this->slot('TITLE') ?></title>
    <link rel="alternate" type="application/rss+xml" href="/rss" title="Flux Rss"> 
    <link rel="stylesheet" type="text/css" href="/css/styles.combined.css" media="screen, print" />
<?= $this->slot('STYLES') ?>
    <script type="text/javascript" src="/js/scripts.combined.js"></script>
<?= $this->slot('SCRIPTS') ?>
</head>
<body<?= $this->slot('ID', '', ' id="%s"') ?> <?= BrowserHelper::getClass(true) ?>>

<div id="container">
<?= $this->partial('header') ?>
<?= $this->partial('nav') ?>
<?= $this->partial('flash') ?>
<?= $this->slot('CONTENT') ?>
<?= $this->partial('footer') ?>
</div><!-- /container -->

<script type="text/javascript">
$(function() {
	/* cufon */
	Cufon.replace('h1')('h2')('h3')('h4')('h5')('h6')('.chapo')('dt')('th');
});
</script>
</body>
</html>