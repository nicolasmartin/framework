	<table class="summary">
		<colgroup>
			<col width="20%" />
			<col />
		</colgroup>
		<tbody>
			<tr>
				<th scope="row"><?= ImageHelper::image($Picture['path'], 80) ?></th>
				<td>
					<input type="hidden" name="id" value="<?= $Picture['id'] ?>"/>
					<input size="40" type="text" id="name" name="name" value="<?= addslashes($Picture['name']) ?>"/>
					<?= FormHelper::displayErrors('name', $Picture) ?>
				</td>
			</tr>
		</tbody>
	</table>

