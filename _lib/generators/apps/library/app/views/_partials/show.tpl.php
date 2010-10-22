<div class="picture row <?= $row % 2 ? 'even' : 'odd' ?>">
	<div class="col1-6 first">
		<?= ImageHelper::thumbnail($Picture['path'], 100, 100) ?>
	</div>
	<div class="col5-6 last">
		<ul>
			<li><b>Nom de l'image : </b> <?= $Picture['name'] ?></li>
			<li><b>Dimensions : </b> <?= $Picture['width'] ?>x<?= $Picture['height'] ?> pixels</li>
			<li><b>Type de fichier : </b> <?= $Picture['type'] ?></li>
			<li><b>Date de mise en ligne : </b> <?= DateHelper::format($Picture['created_at']) ?></li>
		</ul>
		
		<ul class="actions">
			<li><a class="sprite left prefix edit" href="#">Editer</a></li>
			<li><a class="sprite left prefix delete" href="<?= UrlHelper::path(array('action' => 'delete', 'params' => array(1))) ?>">Supprimer</a></li>
		</ul>	
	</div>
</div>