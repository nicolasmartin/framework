<!DOCTYPE html>
<html class="no-js <?= BrowserHelper::getClass() ?>">
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>">
	<meta name="keywords" content="<?= $this->slot('KEYWORDS') ?>">
    <link type="text/css" rel="stylesheet" href="<?= base() ?>/css/styles.combined.css" media="screen, print">
    <link type="image/png" rel="icon" href="<?= base() ?>/img/favicon.png">
    <link type="image/png" rel="apple-touch-icon" href="<?= base() ?>/img/favicon-apple.png">
    <link type="application/rss+xml" rel="alternate" href="<?= base() ?>/rss" title="Flux Rss">
    <script src="<?= base() ?>/js/scripts.combined.js"></script>
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
