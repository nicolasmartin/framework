<? if (isset($ProtectionComponent)) : ?>
	<div id="logged">
		<span class="sprite prefix user"><?= $ProtectionComponent['username'] ?></span> &#8212; <a class="logout" href="<?= urlComponent::path('/users/logout') ?>">Se déconnecter</a>
	</div>
<? endif ?>
       