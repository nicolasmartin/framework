<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
	<meta http-equiv="Content-Type" content="<?= $this->slot('CONTENT_TYPE', 'text/html') ?>; charset=<?= $this->slot('CHARSET', 'UTF-8') ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $this->slot('TITLE') ?></title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
    <link rel="stylesheet" type="text/css" href="/admin/css/styles.combined.css" />
<?= $this->slot('STYLES') ?>
    <script type="text/javascript" src="/admin/js/scripts.combined.js"></script>
<?= $this->slot('SCRIPTS') ?>
</head>

<body<?= $this->slot('ID', '', ' id="%s"') ?> <?= BrowserHelper::getClass(true) ?>>
<?= $this->slot('CONTENT') ?>
</body>
</html>