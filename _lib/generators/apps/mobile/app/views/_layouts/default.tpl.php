<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>">
	<meta name="keywords" content="<?= $this->slot('KEYWORDS') ?>">
    <link rel="stylesheet" href="<?= base() ?>/css/styles.combined.css">
    <link rel="stylesheet" href="<?= base() ?>/js/jqtouch/jqtouch.min.css">
    <link rel="stylesheet" href="<?= base() ?>/js/jqtouch/themes/jqt/theme.min.css">
    <script src="<?= base() ?>/js/scripts.combined.js"></script>
    <script>
	var jQT = new $.jQTouch({
		addGlossToIcon: true,
		statusBar: 'black',
		preloadImages: [
			'<?= base() ?>/js/jqtouch/themes/jqt/img/back_button.png',
			'<?= base() ?>/js/jqtouch/themes/jqt/img/back_button.png',
			'<?= base() ?>/js/jqtouch/themes/jqt/img/back_button_clicked.png',
			'<?= base() ?>/js/jqtouch/themes/jqt/img/button_clicked.png',
			'<?= base() ?>/js/jqtouch/themes/jqt/img/grayButton.png',
			'<?= base() ?>/js/jqtouch/themes/jqt/img/whiteButton.png',
			'<?= base() ?>/js/jqtouch/themes/jqt/img/loading.gif'
		]
	});
	</script>
</head>
<body>
<?= $this->slot('CONTENT') ?>
</body>
</html>