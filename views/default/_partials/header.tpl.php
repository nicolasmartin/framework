<? $tag = (UrlHelper::isHomepage() ? 'h1' : 'div') ?>
    <div id="header" class="row">
        <<?= $tag ?> id="logo"><a href="<?= UrlHelper::path('/') ?>"><?= Config::get('project.name') ?></a></<?= $tag ?>>
        <small>Tag line</small>
    </div><!-- #header -->

