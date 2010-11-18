<? $this->set('ID', "library-page"); ?>		 
<? if ($Picture['id']) {
	$this->set('TITLE', "Edition d'une image");
} else {
	$this->set('TITLE', "Ajout d'une image");
} ?>
		 
<div id="content">
	<div id="main" class="pictures">
		<? if ($Picture['id']) : ?>
		<h1>Edition d'une image</h1>
		<? else: ?>
		<h1>Ajout d'une image</h1>
		<? endif ?>

		<?= $this->partial("flash") ?>

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="<?= UrlHelper::path(array('action' => 'index')) ?>">Retour aux images</a></li>
		</ul>

		<div class="form">
		
		<? if (!$Picture['id']) : ?>
		<form method="post" action="<?= UrlHelper::path(array('action' => 'add')) ?>">
		<? else: ?>
		<form method="post" action="<?= UrlHelper::path(array('action' => 'edit'), $Picture['id']) ?>">
			<input type="hidden" name="id" value="<?= $Picture['id'] ?>">
		<? endif; $i = 0 ?>

			<table class="summary">
				<colgroup>
					<col style="width:20%">
					<col>
				</colgroup>
				<tbody>
					<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
						<th scope="row">Image</th>
						<td><?= ImageHelper::image($Picture['path'], 200) ?></td>
					</tr>
					<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
						<th scope="row">Nom</th>
						<td>
							<input size="40" type="text" id="name" name="name" value="<?= addslashes($Picture['name']) ?>">
							<?= FormHelper::displayErrors('name', $Picture) ?>
						</td>
					</tr>
					<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
						<th scope="row">Chemin</th>
						<td><a href="<?= UrlHelper::url($Picture['path']) ?>"><?= UrlHelper::url($Picture['path']) ?></a></td>
					</tr>
					<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
						<th scope="row">Dimensions</th>
						<td><?= $Picture['width'] ?>x<?= $Picture['height'] ?> pixels</td>
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
