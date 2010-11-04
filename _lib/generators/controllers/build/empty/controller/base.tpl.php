[?php
// Controller {#Controller#}
// Généré le <?= date('d M Y à H:i:s') ?> 
class {#Controller#}Controller extends Controller { 
<? if ($protection) : ?>

	// Protection
	public function preExecute() {
		$this->addComponent('protection');
		parent::preExecute();
	}
<? endif ?>
<?= $class ?>  
}