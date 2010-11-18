<? $this->set('ID',    	"library-page") ?>
<? $this->set('TITLE', 	"Ajouter un lot d'images") ?>

<? $this->addStyle( base().'/js/uploadify/uploadify.css') ?>
<? $this->addScript(base().'/js/uploadify/swfobject.js') ?>
<? $this->addScript(base().'/js/uploadify/jquery.uploadify.js') ?>

<div id="content">
	<div id="main">
		<h1>Ajouter des images par lot</h1>

		<?= $this->partial("flash") ?>

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="<?= UrlHelper::path(array('action' => 'index')) ?>">Retour aux images</a></li>
		</ul>
		
		<p>Choisissez les fichiers à envoyer en cliquant sur <em>parcourir</em>.</p>
		<p><small>Taille maximum : <strong><?= ini_get('upload_max_filesize') ?></strong></small></p>
		<p><input type="file" name="uploadify" id="uploadify"></p>
	
		<form action="<?= UrlHelper::path(array('action' => 'save')) ?>" method="post">
			<div id="uploaded"></div>
			<input id="save" class="button" style="display:none" type="submit" value="Sauver">
		</form>

		<div id="uploading"></div>
	</div><!-- #main -->
</div><!-- #content -->

<script>
$(function() {
	$('#uploadify').uploadify({
		'uploader': 		'<?= base() ?>/js/uploadify/uploadify.swf',
		'cancelImg': 		'<?= base() ?>/js/uploadify/cancel.png',
		'script': 			'<?= base() ?>/library/upload',
		'fileDataName':		'uploaded',
		'queueID': 			'uploading',
		'buttonText':		'Parcourir...',
		'auto': 			true,
		'multi': 			true,
		'onError': function(evt, queueID, fileObj, response) {
			alert('Erreur : '+response);	
		},
		'onComplete': function(evt, queueID, fileObj, response) {
			$.get('<?= UrlHelper::path(array('action'=>'name')) ?>/'+response, function(data) {
				$('#uploaded').append(data);
			});
		},
		'onAllComplete': function() {
			$('#save').show();
		}
	});
	
	$('.delete').live('click', function() {
		if (confirm("<?= __("Etes-vous sûr ?") ?>")) {
			$.get($(this).attr('href'));
			$(this).closest('table').fadeOut('fast', function() {
				$(this).remove();
				if ($('#uploaded table').length == 0) {
					$('#save').hide();
				}
			});
		}
		return false;
	});
});
</script>