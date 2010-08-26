<!DOCTYPE html>
<html>
<head>
	<meta charset="<?= $this->slot('CHARSET', 'UTF-8') ?>">
    <title><?= $this->slot('TITLE') ?></title>
    <meta name="description" content="<?= $this->slot('DESCRIPTION') ?>">
	<meta name="keywords" content="<?= $this->slot('KEYWORDS') ?>">
    <link rel="stylesheet" href="/mobile/css/styles.combined.css">
    <link rel="stylesheet" href="/mobile/js/jqtouch/jqtouch.min.css">
    <link rel="stylesheet" href="/mobile/js/jqtouch/themes/jqt/theme.min.css">
    <script type="text/javascript" src="/mobile/js/scripts.combined.js"></script>
    <script type="text/javascript">
	var jQT = new $.jQTouch({
		addGlossToIcon: true,
		statusBar: 'black',
		preloadImages: [
			'/mobile/js/jqtouch/themes/jqt/img/back_button.png',
			'/mobile/js/jqtouch/themes/jqt/img/back_button.png',
			'/mobile/js/jqtouch/themes/jqt/img/back_button_clicked.png',
			'/mobile/js/jqtouch/themes/jqt/img/button_clicked.png',
			'/mobile/js/jqtouch/themes/jqt/img/grayButton.png',
			'/mobile/js/jqtouch/themes/jqt/img/whiteButton.png',
			'/mobile/js/jqtouch/themes/jqt/img/loading.gif'
		]
	});
	</script>
</head>
<body<?= $this->slot('ID', '', ' id="%s"') ?>>
<?= $this->slot('CONTENT') ?>
</body>
</html>