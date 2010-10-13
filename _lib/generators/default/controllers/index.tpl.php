
	// Index
	public function index() {
	    $page       = $this->getParam('page', 1);
        $orderby    = $this->getParam('orderby', 'id');
        $dir        = $this->getParam('dir', 'desc');
        $perpage    = Config::get('perPage');

		$Pager = new Doctrine_Pager(
		    Doctrine::getTable('<?= $model ?>')
		        ->createQuery()
		        ->orderby($orderby.' '.$dir), 
		    $page, $perpage
		);
		$this->View->set('<?= $settings['collection'] ?>', $Pager->execute());
	}
