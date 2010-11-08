<?php
class ImagesController extends Controller { 
	// Ajout par lot
	public function lot() {
	}

	// Upload
	public function upload() {
		$this->View->setAutoRender(false);
		echo $this->doUpload();
	}

	public function editlot($id = null) {
		$Picture = Doctrine::getTable('Library')->find($id);
		$this->View->set('Picture', $Picture);
	}
	
	public function savelot() {
		foreach($this->Request()->post('name') as $id => $name) {
			$Picture = Doctrine::getTable('Library')->find($id);
			$Picture['name'] = $name;
			$Picture->save();
		}
		$this->redirect(array('action' => 'index'));
	}
	// Delete
	public function deleteLot($id = null) {	
		$Picture = Doctrine::getTable('Library')->find($id);
		$Picture->delete();
		die('ok');
	}
	
	private function doUpload() {
		if (!empty($_FILES)) {
			$file 		= $_FILES['uploaded'];
			$file_name	= clean_filename($file['name']);
					
			$path 		= '/uploads/'.date('Y').'/'.date('m');
			$full_path 	= $path.'/'.duplicate_filename(ROOT.'/www/'.$path, $file_name);
			
			$to_path	= ROOT.'/www/'.$full_path;

			@mkdir(dirname($to_path), 0755, true);
			move_uploaded_file($file['tmp_name'], $to_path);

			if (isset($_POST['name']) && $_POST['name']) {
				$name = $_POST['name'];
			} else {
				$name = InflectionComponent::humanize(preg_replace('~\.(.*?)$~', '', $file['name']));	
			}

			$info = getimagesize($to_path);
			$File = new Library();
			$File['name'] 	= $name;
			$File['path'] 	= $full_path;
			$File['width'] 	= $info[0];
			$File['height'] = $info[1];
			$File['type']   = $info['mime'];
			$File->save();
			
			return $File['id'];
		}
	}

	// Add
	public function add() {						
		if ($this->Request()->post()) {
			$Picture = new Library();
			$Picture->fromArray($this->Request()->post());	
			if ($Picture->isValid()) {
				$this->doUpload();
				$Picture->refresh();
				FlashComponent::set('success', "Image créée.");
				$this->redirect(array('action' => 'index'));
			} else {
				$errors = $Picture->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|{#}} erreur{s}.'));
			}
		} else {
			$Picture = new Library();
		}
		$this->View->set('Picture', $Picture);
	}

	// Batch action
	public function batch() {
		$id 	= $this->Request()->post('id');
		$action = $this->Request()->post('action');

		if (!$action) {
			FlashComponent::set('error', "Une action doit être choisie.");
			$this->redirect(array('action' => 'index'));
		}

		if (!count($id)) {
			FlashComponent::set('error', "Un ou plusieurs Images doivent être cochées.");
			$this->redirect(array('action' => 'index'));
		}

		switch ($action) {
			case "delete":
                $Items = Doctrine::getTable('Library')
                            ->createQuery()
                            ->whereIn('id', $id)
                            ->execute();
				foreach ($Items as $Item) {
					$Item->delete();
				}
				FlashComponent::set('success', pluralize(count($id), "{Image|Images} effacée{s}"));
			break;
		}
		$this->redirect(array('action' => 'index'));
	}

	// Delete
	public function delete($id = null) {	
		if ($this->Request()->post('id')) {
			$Picture = Doctrine::getTable('Library')->find($this->Request()->post('id'));
			if (!$Picture) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			} else {
				$Picture->delete();
				FlashComponent::set('success', "Image supprimée.");
			}
			if ($this->Request()->isAjax()) {
				die('1');
			} else {
				$this->redirect(array('action' => 'index'));	
			}
		} else {
			$Picture = Doctrine::getTable('Library')->find($id);
			if (!$Picture) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->View->set('Picture', $Picture);
	}

	// Edit
	public function edit($id = null) {	
		if ($this->Request()->post('id')) {
			$Picture = Doctrine::getTable('Library')->find($this->Request()->post('id'));
			if (!$Picture) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
			$Picture->fromArray($this->Request()->post());
			if ($Picture->isValid()) {
				$Picture->save();
				FlashComponent::set('success', "Image éditée.");
				$this->redirect(array('action' => 'index'));
			} else {
				$errors = $Picture->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|{#}} erreur{s}.'));
			}
		} else {
			$Picture = Doctrine::getTable('Library')->find($id);
			if (!$Picture) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->View->set('Picture', $Picture);
	}

	// Index
	public function index() {
	    $page       = $this->getParam('page', 1);
        $orderby    = $this->getParam('orderby', 'id');
        $dir        = $this->getParam('dir', 'desc');
        $perpage	= Config::get('pagination.perpage');

		$Pager = new Doctrine_Pager(
		    Doctrine::getTable('Library')
		        ->createQuery()
		        ->orderby($orderby.' '.$dir), 
		    $page, $perpage
		);
		$this->View->set('Pictures', $Pager->execute());
		$this->View->set('Pager', $Pager);
	}
	
	// Show
	public function show($id = null) {
		$Picture = Doctrine::getTable('Library')->find($id);
		if (!$Picture) {
			FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			$this->redirect(array('action' => 'index'));
		}
		$this->View->set('Picture', $Picture);
	}
  
}