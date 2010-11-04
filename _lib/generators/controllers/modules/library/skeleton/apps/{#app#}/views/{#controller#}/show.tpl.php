<? $this->set('ID',    'picturePage') ?>
<? $this->set('TITLE', 'Résumé d\'une  image') ?>

<div id="content">
	<div id="main" class="pictures">
		<h1>Résumé d'une image</h1>

		<?= $this->partial("flash") ?>

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="<?= UrlHelper::path(array('action' => 'index')) ?>">Retour aux images</a></li>
		</ul>

		<? $i=0; ?>
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
					<td><?= $Picture['name'] ?></td>
				</tr>
				<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<th scope="row">Chemin</th>
					<td><a href="<?= UrlHelper::url($Picture['path']) ?>"><?= UrlHelper::url($Picture['path']) ?></a></td>
				</tr>
				<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<th scope="row">Dimensions</th>
					<td><?= $Picture['width'] ?>x<?= $Picture['height'] ?> pixels</td>
				</tr>
				<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<th scope="row">Type</th>
					<td><?= $Picture['type'] ?></td>
				</tr>
				<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<th scope="row">Mise en ligne</th>
					<td><?= DateHelper::format($Picture['created_at']) ?></td>
				</tr>
			</tbody>
		</table>

		<ul class="actions">
			<li><a class="sprite left prefix edit" title="Editer" href="<?= UrlHelper::path(array('action' => 'edit'), $Picture['id']) ?>">Editer</a></li>
			<li><a class="sprite left prefix delete" title="Supprimer" href="<?= UrlHelper::path(array('action' => 'delete'), $Picture['id']) ?>">Supprimer</a></li>
		</ul>
		
	</div><!-- #main -->
</div><!-- #content -->
