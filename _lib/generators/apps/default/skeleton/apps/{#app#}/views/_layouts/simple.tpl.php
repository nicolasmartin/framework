<!DOCTYPE html>
<html class="no-js <?= BrowserHelper::getClass() ?>">
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>">
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
