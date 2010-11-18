
	<table class="summary">
		<colgroup>
			<col style="width:100px">
			<col>
		</colgroup>
		<tbody>
			<tr>
				<th scope="row"><?= ImageHelper::thumbnail($Picture['path'], 60) ?></th>
				<td>
					<p><input size="40" type="text" id="name" name="name[<?= $Picture['id'] ?>]" value="<?= addslashes($Picture['name']) ?>"></p>
					<p><a class="sprite prefix delete" href="<?= UrlHelper::path(array('action' => 'delete'), $Picture['id']) ?>">Supprimer cette image</a></p>
				</td>
			</tr>
		</tbody>
	</table>
