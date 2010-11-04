[? $this->set('ID',    "{#controller#}-page") ?]
[? $this->set('TITLE', "Résumé d'{#a#}") ?]

<div id="content">
	<div id="main" class="{#collector#}">
		<h1>Résumé d'{#a#}</h1>

		[?= $this->partial('flash') ?]

		<ul class="toolbar">
			<li><a class="sprite prefix home" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Retour aux {#plural#}</a></li>
		</ul>

		[? $i=0; ?]
<? $fields = Doctrine::getTable($model)->getColumns(); ?>
		<table class="summary">
			<colgroup>
				<col style="width:20%">
				<col>
			</colgroup>
			<tbody>
<? foreach($fields as $field => $options) : ?>
<? if (!in_array($field, $exclude)) : ?>
				<tr class="[?= ++$i % 2 ? 'odd': 'even' ?]">
					<th scope="row"><?= cfirst(ThisGeneratorHelper::field($field, $mapping)) ?></th>
					<td>[?= ${#Model#}['<?= $field ?>'] ?]</td>
				</tr>
<? endif ?>
<? endforeach ?>
			</tbody>
		</table>

		<ul class="actions">
			<li><a class="sprite left prefix edit" title="Editer" href="[?= UrlComponent::path(array('action' => 'edit'), ${#Model#}['id']) ?]">Editer</a></li>
			<li><a class="sprite left prefix delete" title="Supprimer" href="[?= UrlComponent::path(array('action' => 'delete'), ${#Model#}['id']) ?]">Supprimer</a></li>
		</ul>
		
	</div><!-- #main -->
</div><!-- #content -->
