<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="<?= $this->slot('CONTENT_TYPE', 'text/html') ?>; charset=<?= $this->slot('CHARSET', 'UTF-8') ?>" />
    <title><?= $this->slot('TITLE') ?></title>
    <link rel="stylesheet" type="text/css" href="/doctrine/css/styles.combined.css" />
    <script type="text/javascript" src="/doctrine/js/scripts.combined.js"/></script>
</head>
<body>
<div id="container">
<?= $this->slot('CONTENT') ?>
</div>
</body>
</html>