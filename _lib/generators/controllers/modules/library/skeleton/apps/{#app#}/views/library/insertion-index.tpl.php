<? $this->set('ID',    	"library-page") ?>
<? $this->set('TITLE', 	"Liste des images") ?>


<div id="content" style="width:800px">
	<div id="main" class="pictures">
		
		<?= $this->partial("flash") ?>
<!--
		<ul class="toolbar">
			<li><a class="sprite left prefix add" href="<?= UrlHelper::path(array('action' => 'add')) ?>">Ajouter une image</a></li>
			<li><a class="sprite left prefix add" href="<?= UrlHelper::path(array('action' => 'bunch')) ?>">Ajouter des images</a></li>
		</ul>
-->
		<? $i=0; ?>
		<form action="<?= UrlHelper::path(array('action' => 'batch')) ?>" method="post">
		<table class="list">
			<colgroup>
				<col style="width:100px">
				<col>
				<col style="width:200px">
				<col style="width:200px">
			</colgroup>
			<thead>
				<tr>
					<th scope="col"><?= UrlHelper::orderBy('name', "Image") ?></th>
					<th scope="col">&nbsp;</th>
					<th scope="col"><?= UrlHelper::orderBy('created_at', "Mise en ligne") ?></th>
					<th scope="col">&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="100">
						<?= $this->partial('pagination', array('Pager', $Pager)); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<? foreach ($Pictures as $Picture): ?>
				<tr class="<?= ++$i % 2 ? 'odd': 'even' ?>">
					<td>
						<a href="<?= UrlHelper::path(array('action' => 'insertionEdit'), $Picture['id']) ?>"><?= ImageHelper::thumbnail($Picture['path'], 55) ?></a>
					</td>
					<td>
						<strong><a href="<?= UrlHelper::path(array('action' => 'show'), $Picture['id']) ?>"><?= $Picture['name'] ?></a></strong><br>
						<?= $Picture['width'] ?> x <?= $Picture['height'] ?> pixels<br>
						<?= ucfirst($Picture['type']) ?><br>
					</td>
					<td><?= DateHelper::format($Picture['created_at'], '{dd} {month} {yy} à {HH}:{MM}') ?></td>
					<td>
						<ul class="actions">
							<li><a class="sprite prefix edit insert" title="Insertion" href="<?= UrlHelper::path(array('action' => 'insertionEdit'), $Picture['id']) ?>">Insérer</a></li>
						</ul>
					</td>
				</tr>
				<? endforeach ?>

				<? if (!count($Pictures)) : ?>
				<tr class="empty <?= ++$i % 2 ? 'odd': 'even' ?>">
					<td colspan="100">Aucune image.</td>
				</tr>
				<? endif ?>
			</tbody>
		</table>
		</form>
	</div><!-- #main -->
</div><!-- #content -->
