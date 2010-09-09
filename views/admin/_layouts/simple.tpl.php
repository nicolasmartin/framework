<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.combined.css">
<?= $this->slot('STYLES') ?>
    <script src="/admin/js/scripts.combined.js"></script>
<?= $this->slot('SCRIPTS') ?>
</head>

<body<?= $this->slot('ID', '', ' id="%s"') ?> <?= BrowserHelper::getClass(true) ?>>
<?= $this->slot('CONTENT') ?>
</body>
</html>