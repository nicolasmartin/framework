<table class="summary">
	<colgroup>
		<col width="60" />
		<col />
	</colgroup>
	<tbody>
		<tr>
			<th scope="row"><?= ImageHelper::thumbnail($Picture['path'], 60) ?></th>
			<td>
				<input size="40" type="text" id="name" name="name[<?= $Picture['id'] ?>]" value="<?= addslashes($Picture['name']) ?>" />
				<br />
				<a class="sprite prefix delete" href="<?= UrlHelper::path(array('action' => 'deleteLot'), $Picture['id']) ?>">Supprimer cette image</a>
			</td>
		</tr>
	</tbody>
</table>
