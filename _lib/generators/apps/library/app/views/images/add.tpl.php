<? 	$this->set('ID', 'picturePage'); ?>		 
<? 	$this->set('TITLE', 'Ajout d\'une  image'); ?>	
	 
<div id="content">
	<div id="main" class="pictures">
		<h1>Ajout d'une  image</h1>

		<?= $this->partial("flash") ?>

		<ul class="toolbar">
			<li><a class="sprite prefix back" href="<?= UrlHelper::path(array('action' => 'index')) ?>">Retour aux images</a></li>
		</ul>

		<? $i = 0 ?>
		<div class="form">
			<form method="post" action="<?= UrlHelper::path() ?>" enctype="multipart/form-data">
			<table class="summary">
				<colgroup>
					<col width="20%" />
					<col />
				</colgroup>
				<tbody>
					<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
						<th scope="row">Image</th>
						<td><input type="file" name="uploaded" id="uploaded" /></td>
					</tr>
					<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
						<th scope="row">Nom</th>
						<td>
							<input size="40" type="text" id="name" name="name" value="<?= addslashes($Picture['name']) ?>" <?= FormHelper::getErrorClass('name', $Picture); ?>/>
							<?= FormHelper::displayErrors('name', $Picture) ?>
						</td>
					</tr>

				</tbody>
			</table>

			<div>
				<input class="button" type="submit" value="Enregistrer"> 
				ou
				<a class="cancel" href="<?= UrlHelper::path(array('action' => 'index')) ?>">Annuler</a> 
			</div>
		</form>
		</div><!-- .form -->
  	</div><!-- #main -->
</div><!-- #content -->
