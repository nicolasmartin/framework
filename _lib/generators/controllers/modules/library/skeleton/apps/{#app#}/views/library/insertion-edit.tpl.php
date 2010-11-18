<? $this->set('ID',    	"library-page") ?>
<? $this->set('TITLE', 	"Liste des images") ?>

<div id="content" style="width:800px">
	<div id="main">
		<? $i = 0 ?>
		
			<form action="#">
				<fieldset>
				<legend>Informations sur l'image</legend>
				<?= FormHelper::hidden('path', $Picture); ?> 
				
				<div class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<label for="name">Titre de l'image</label>
					<?= FormHelper::text('name', $Picture, array('size' => 100)); ?> 
				</div>
	
				<div class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<label for="width">Taille</label>
					<?= FormHelper::select('percents', array(
						'100' => '100%', 
						'90'  => ' 90%',
						'80'  => ' 80%',
						'70'  => ' 70%',
						'60'  => ' 60%',
						'50'  => ' 50%',
						'40'  => ' 40%',
						'30'  => ' 30%',
						'20'  => ' 20%',
						'10'  => ' 10%'), 100); ?>
					ou <?= FormHelper::text('width', '', array('size' => 4)); ?> x <?= FormHelper::text('height', '', array('size' => 4)); ?> px
				</div>
	
				<div class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<label for="alignment">Alignement</label>
					<?= FormHelper::radios('alignment', array('' => 'Aucun', 'right' => 'Droite', 'center' => 'Centrer', 'left' => 'Gauche'), ''); ?> 
				</div>
	
				<div class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<label for="link">Lien</label>
					<?= FormHelper::text('href', '', array('size' => '100')); ?><br />
					<?= FormHelper::checkbox('target', '_blank', '_blank'); ?> Ouvrir dans une nouvelle fenêtre
				</div>
				</fieldset>	
				
				<div>
					<input class="button" type="submit" value="Insérer dans l'éditeur"> 
					ou
					<a class="cancel" href="<?= UrlComponent::path(array('action' => 'insertionIndex')) ?>">Annuler</a> 
				</div>
			</form>
		
  	</div><!-- #main -->
</div><!-- #content -->

<script src="/admin/js/tinymce/tiny_mce_popup.js"></script>
<script>
//	try {
	$(function() {
		$('form').submit(function() {
			var name		= $('#name').val(),
				path		= $('#path').val(),
				alignment 	= $('#alignment').val(),
				href 		= $('#href').val(),
				target 		= $('#target').val(),
				width 		= $('#width').val(),
				height 		= $('#height').val(),
				percents 	= $('#percents').val();
			
			var html = '<img src="'+path+'"';
			if (name) {
				html += ' title="'+name+'"';
			}
			if (alignment) {
				html += ' class="'+alignment+'"';
			}
			if (percents != '100') {
				html += ' width="'+percents+'%"';
			} else {
				if (width) {
					html += ' width="'+width+'"';
				}
				if (height) {
					html += ' height="'+height+'"';
				}
			}
			html += '<?= Helper::xhtml() ?>>';
			if (href) {
				if (target) {
					html = '<a target="_blank" href="'+href+'">'+html+'</a>';
				} else {
					html = '<a href="'+href+'">'+html+'</a>';
				}
			}

			parent.tinyMCE.execCommand('mceReplaceContent', false, html);
			tinyMCEPopup.close();
			return false;
		});
	});
//	} catch(e) {
//	}
</script>
