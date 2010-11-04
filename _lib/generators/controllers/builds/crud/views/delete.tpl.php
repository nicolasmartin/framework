[? $this->set('ID',    "{#controller#}-page") ?]
[? $this->set('TITLE', "Suppression d'{#a#}") ?]

<div id="content">
	<div id="main" class="{#collection#}">
		<h1>Suppression d'{#a#}</h1>

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

		<div class="form">
		<form method="post" action="[?= UrlComponent::path(array('action' => 'delete'), ${#Model#}['id']) ?]">
			<input type="hidden" name="id" value="[?= ${#Model#}['id'] ?]">
			
			<div>
				<input class="button" type="submit" value="Supprimer"> 
				ou
				<a class="cancel" href="[?= UrlComponent::path(array('action' => 'index')) ?]">Annuler</a> 
			</div>

		</form>
		</div><!-- .form -->
		
  </div><!-- #main -->
</div><!-- #content -->
