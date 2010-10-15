[?php
// Controller <?= $controller ?> 
// Généré le <?= date('d M Y à H:i:s') ?> 
class <?= $controller ?>Controller extends Controller { 
<? if ($protection) : ?>

	// Protection
	public function preExecute() {
		$this->addComponent('protection');
		parent::preExecute();
	}
<? endif ?>
<?= $class ?>  
}