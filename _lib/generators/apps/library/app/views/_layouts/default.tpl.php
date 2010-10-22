<!DOCTYPE html>
<html class="no-js <?= BrowserHelper::getClass() ?>">
<head>
    <meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <link type="text/css" rel="stylesheet" href="<?= base() ?>/css/styles.combined.css" media="screen, print">
    <link type="text/css" rel="stylesheet" href="<?= base() ?>/js/uploadify/uploadify.css" media="screen">
    <script src="<?= base() ?>/js/scripts.combined.js"></script>
	<script src="<?= base() ?>/js/uploadify/swfobject.js"></script>
	<script src="<?= base() ?>/js/uploadify/jquery.uploadify.js"></script>
</head>

<body<?= $this->slot('ID', '', ' id="%s"') ?>>
<div id="container">
<?= $this->partial('flash') ?>
<?= $this->slot('CONTENT') ?>
</div><!-- #container -->
</body>
</html>
