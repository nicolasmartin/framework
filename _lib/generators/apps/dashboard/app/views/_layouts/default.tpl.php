<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
	<title><?= $this->slot('TITLE') ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base() ?>/css/styles.css">
	<script src="<?= base() ?>/js/scripts.combined.js"/></script>
</head>
<body>
<div id="container">
<?= $this->slot('CONTENT') ?>
</div>
</body>
</html>