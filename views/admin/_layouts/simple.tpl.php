<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.combined.css">
<?= $this->slot('STYLES') ?>
    <script src="/admin/js/scripts.combined.js"></script>
<?= $this->slot('SCRIPTS') ?>
</head>

<body<?= $this->slot('ID', '', ' id="%s"') ?> <?= BrowserHelper::getClass(true) ?>>
<?= $this->slot('CONTENT') ?>
</body>
</html>