<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>">
    <link rel="icon" type="image/png" href="/default/img/favicon.png">
    <link rel="apple-touch-icon" href="/default/img/favicon-apple.png">
    <link rel="alternate" type="application/rss+xml" href="/rss" title="Flux Rss"> 
    <link rel="stylesheet" type="text/css" href="/default/css/styles.combined.css" media="screen, print">
<?= $this->slot('STYLES') ?>
    <script src="/default/js/scripts.combined.js"></script>
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

<script>
$(function() {
    /* cufon */
    Cufon.replace('h1')('h2')('h3')('h4')('h5')('h6')('.chapo')('dt')('th');
});
</script>
</body>
</html>