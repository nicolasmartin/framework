<!DOCTYPE html>
<html class="no-js <?= BrowserHelper::getClass(false) ?>">
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title>Administration : <?= $this->slot('TITLE') ?></title>
    <link rel="stylesheet" href="<?= base() ?>/css/styles.css" media="screen, print">
<?= $this->slot('STYLES') ?>
    <script src="<?= base() ?>/js/scripts.js"></script>
 <?= $this->slot('SCRIPTS') ?>
</head>

<body<?= $this->slot('ID', '', ' id="%s"') ?>>
<div id="container">
<?= $this->partial('flash') ?>
<?= $this->slot('CONTENT') ?>
</div><!-- #container -->
</body>
</html>