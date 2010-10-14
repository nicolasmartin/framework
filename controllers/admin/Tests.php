<?php
// Controller Tests 
// Généré le 14 Oct 2010 à 23:35:22 
class TestsController extends Controller { 

	// Add
	public function add() {						
		if ($this->post) {
			$Test = new Test();
			$Test->fromArray($this->post);	
			if ($Test->isValid()) {
				$Test->save();
				FlashComponent::set('success', "élément créé.");
				$this->redirect('/admin/tests/');
			} else {
				$errors = $Test->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$Test = new Test();
		}
		$this->View->setPath('tests/edit');
		$this->View->set('Test', $Test);
	}

	// Batch action
	public function batch() {
		$id 	= $this->post['id'];
		$action = $this->post['action'];

		if (!$action) {
			FlashComponent::set('error', "Une action doit être choisie.");
			$this->redirect('/admin/tests/');
		}

		if (!count($id)) {
			FlashComponent::set('error', "Un ou plusieurs éléments doivent être cochés.");
			$this->redirect('/admin/tests/');
		}

		switch ($action) {
			case "delete":
                $Items = Doctrine::getTable('Test')
                            ->createQuery()
                            ->whereIn('id', $id)
                            ->execute();
				foreach ($Items as $Item) {
					$Item->delete();
				}
				FlashComponent::set('success', pluralize(count($id), "{élément|éléments} effacé{s}"));
			break;
		}
		$this->redirect('/admin/tests/');
	}

	// Delete
	public function delete($id = null) {	
		if (isset($this->post['id'])) {
			$Test = Doctrine::getTable('Test')->find($this->post['id']);
			if (!$Test) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			} else {
				$Test->delete();
				FlashComponent::set('success', "élément supprimé.");
			}
			$this->redirect('/admin/tests/');	
		} else {
			$Test = Doctrine::getTable('Test')->find($id);
			if (!$Test) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('/admin/tests/edit/'.$Test['id']);
			}
		}
		$this->View->set('Test', $Test);
	}

	// Edit
	public function edit($id = null) {	
		if (isset($this->post['id'])) {
			$Test = Doctrine::getTable('Test')->find($this->post['id']);
			if (!$Test) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('/admin/tests/edit/'.$Test['id']);
			}
			$Test->fromArray($this->post);
			if ($Test->isValid()) {
				$Test->save();
				FlashComponent::set('success', "élément édité.");
				$this->redirect('/admin/tests/');
			} else {
				$errors = $Test->getErrorStack();
				FlashComponent::set('error', "Le formulaire contient ".pluralize(count($errors), '{une|#} erreur{s}.'));
			}
		} else {
			$Test = Doctrine::getTable('Test')->find($id);
			if (!$Test) {
				FlashComponent::set('error', "Cet enregistrement n'existe pas.");
				$this->redirect('/admin/tests/edit/'.$Test['id']);
			}
		}
		$this->View->set('Test', $Test);
	}

	// Index
	public function index() {
	    $page       = $this->getParam('page', 1);
        $orderby    = $this->getParam('orderby', 'id');
        $dir        = $this->getParam('dir', 'desc');
        $perpage	= Config::get('pagination.perpage');

		$Pager = new Doctrine_Pager(
		    Doctrine::getTable('Test')
		        ->createQuery()
		        ->orderby($orderby.' '.$dir), 
		    $page, $perpage
		);
		$this->View->set('Tests', $Pager->execute());
		$this->View->set('Pager', $Pager);
	}
	
	// Show
	public function show($id = null) {
		$Test = Doctrine::getTable('Test')->find($id);
		if (!$Test) {
			FlashComponent::set('error', "Cet enregistrement n'existe pas.");
			$this->redirect('/admin/tests');
		}
		$this->View->set('Test', $Test);
	}
  
}