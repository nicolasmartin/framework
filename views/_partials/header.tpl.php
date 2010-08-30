<? $tag = (UrlHelper::isHomepage() ? 'h1' : 'div') ?>
    <div id="header" class="row">
        <<?= $tag ?> id="logo"><a href="<?= UrlHelper::path('/') ?>">Nom du site</a></<?= $tag ?>>
        <small>Tag line</small>
    </div><!-- /header -->

