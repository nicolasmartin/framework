<div id="navbar" class="row">
	<ul class="menu horizontal sf-menu">
		<li<?= UrlHelper::getCurrentClass(array('controller' => 'default')) ?>><a href="<?= UrlHelper::path(array('controller' => 'default')) ?>">Accueil</a>
			<ul>
				<li><a href="<?= UrlHelper::path(array('controller' => 'default')) ?>">Retour</a></li>
			</ul>
		</li>
	</ul>
</div><!-- #navbar -->