<?php
	class DefaultController extends Controller {
		
		public function preExecute() {
			$this->addComponent('protection', 
				array('basic' => array(
					'username' => Config::get('su.username'), 
					'password' => Config::get('su.password')
				))
			);
			parent::preExecute();
		}
		
		public function index() {
		}

		public function dumpData() {
			Doctrine::dumpData(MODELS.'fixtures/', 1);
			$this->dumpFiles('Picture');
			$this->dumpFiles('File');
			FlashComponent::set('info', 'Dump Data terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
				
		public function loadData() {
			Doctrine::LoadData(MODELS.'fixtures/');	
			$this->loadFiles('Picture');
			$this->loadFiles('File');
			FlashComponent::set('info', 'Load Data terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
		
		public function generateModels() {
			Doctrine_Core::generateModelsFromYaml(MODELS.'schema/schema.yml', MODELS, array( 
				'generateTableClasses' => true 
			));
			FlashComponent::set('info', 'Generate Models terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
		
		public function generateSchema() {
			Doctrine_Core::generateYamlFromModels(MODELS.'schema/schema.yml', MODELS);
			FlashComponent::set('info', 'Generate Schema terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
		
		public function generateTables() {
			$this->removeTables();
			Doctrine_Core::createTablesFromModels(MODELS);
			
			FlashComponent::set('info', 'Generate Table terminé.');
			$this->redirect('/doctrine/scripts/index');
		}

		// PRIVATES -------------------------------

		private function removeTables() {
			$integrity_violation = 0;
			$models = Doctrine::getLoadedModels();
			foreach($models as $model) {
				try {
					$Model = new $model();
					$table = $Model->getTable()->tableName;
					Doctrine_Manager::connection()->export->dropTable($table);
				} catch(Exception $e) {
					if ($e->getCode() == 23000) { // 23000: Integrity constraint violation
						$integrity_violation = 	1;
					}
				}
			}
			if ($integrity_violation == 1) {
				$integrity_violation = 0;
				$this->removeTables();
			}
		}
		
		private function loadFiles($model, $options = array()) {
			$default = array(
				'pathField'			=> 'path',
				'findMethod' 		=> 'findAll',
				'uploadMethod' 	=> 'upload',
				'fixturePath'		=> MODELS.'fixtures/files/',
				'uploadPath'		=> ROOT.'www/'.Config::get('uploads.path'),
			);
			$options = array_merge($default, $options);
			try {
				$Models = Doctrine::getTable($model)->{$options['findMethod']}();
				foreach($Models as $Model) {
					$mock = array(
						'name'			=> $Model->{$options['pathField']},
						'tmp_name' 	=> $options['fixturePath'].$Model->{$options['pathField']},
					);
					$Model->{$options['uploadMethod']}($mock, true);
				}
			} catch(Exception $e) {}
		}

		private function dumpFiles($model, $options = array()) {
			$default = array(
				'folder' 				=> 'uploads',
				'pathField'			=> 'path',
				'findMethod' 		=> 'findAll',
				'fixturePath'		=> MODELS.'fixtures/files/',
				'uploadPath'		=> ROOT.'www/'.Config::get('uploads.path'),
			);
			$options = array_merge($default, $options);
			try {
				$Models = Doctrine::getTable($model)->{$options['findMethod']}();
				foreach($Models as $Model) {
					$from = $options['uploadPath'].$Model->{$options['pathField']};
					$to		= $options['fixturePath'].$Model->{$options['pathField']};
					if (file_exists($from)) {
						copy($from, $to); 
					}
				}
			} catch(Exception $e) {}
		}
	}
