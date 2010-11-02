<!DOCTYPE html>
<html class="no-js <?= BrowserHelper::getClass() ?>">
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>">
    <link rel="icon" href="<?= base() ?>/img/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="<?= base() ?>/img/favicon-apple.png" type="image/png">
    <link rel="alternate" href="<?= base() ?>/rss" title="Flux Rss" type="application/rss+xml">
    <link rel="stylesheet" href="<?= base() ?>/css/styles.css" media="screen, print">
<?= $this->slot('STYLES') ?>
    <script src="<?= base() ?>/js/scripts.js"></script>
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
