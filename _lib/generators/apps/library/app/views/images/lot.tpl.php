<?php
	$this->set('TITLE', 		'Titre de la page');
	$this->set('DESCRIPTION',	'Description de la page');
?>
<div id="content" class="row">
	<div id="main">
		<h1>Ajouter des images</h1>
		<p>Choisissez les fichiers à envoyer en cliquant sur <em>parcourir</em>.<br />
		<small>Taille maximum : <?= ini_get('upload_max_filesize') ?></small></p>
		
		<p><input type="file" name="uploadify" id="uploadify" /></p>
	
		<form action="<?= UrlHelper::path(array('action' => 'savelot')) ?>" method="post">
		<div id="uploaded"></div>
		<input id="save" class="button" style="display:none" type="submit" value="Sauver" />
		</form>

		<div id="uploading"></div>
	</div><!-- #main -->
</div><!-- #content -->

<script type="text/javascript">
$(function() {
	$('#uploadify').uploadify({
		'uploader': 	'<?= base() ?>/js/uploadify/uploadify.swf',
		'cancelImg': 	'<?= base() ?>/js/uploadify/cancel.png',
		'script': 		'<?= base() ?>/images/upload',
		'fileDataName':	'uploaded',
		'queueID': 		'uploading',
		'auto': 		true,
		'multi': 		true,
		'buttonText':	'Parcourir...',
	//	'buttonImg':	'<?= base() ?>/js/uploadify/add.png',
	//	'width': 		'155', 
	//	'height':		'155',
	//	'wmode':		'transparent',
	//	'folder': 		'/uploads',
		'onError': function(evt, queueID, fileObj, response) {
			console.log(evt);
			console.log(queueID);
			console.log(fileObj);
			console.log(response);
			alert('Erreur : '+response);	
		},
		'onComplete': function(evt, queueID, fileObj, response) {
			console.log(response);
			$.get('<?= UrlHelper::path(array('action'=>'editlot')) ?>/'+response, function(data) {
				$('#uploaded').append(data);
			});
		},
		'onAllComplete': function() {
			$('#save').show();
		}
	});
	
	$('.delete').live('click', function() {
		if (confirm('Etes-vous sûr ?')) {
			$.post($(this).attr('href'));
			$(this).closest('table').fadeOut('fast', function() {
				$(this).remove();
			});
		}
		return false;
	});
});
</script>