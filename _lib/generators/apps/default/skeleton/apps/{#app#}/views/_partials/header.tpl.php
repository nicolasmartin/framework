<div id="header" class="row">
<? if (UrlHelper::isHomepage()) : ?>
	<h1 id="logo"><a href="<?= UrlHelper::path('/') ?>"><?= Config::get('project.name') ?></a></h1>
<? else: ?>
	<div id="logo"><a href="<?= UrlHelper::path('/') ?>"><?= Config::get('project.name') ?></a></div>
<? endif ?>       
</div><!-- #header -->

