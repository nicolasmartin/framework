<?php
	class ScriptsController extends Controller {
		
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
			FlashComponent::set('info', 'Dump Data terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
				
		public function loadData() {
			Doctrine::LoadData(MODELS.'fixtures/');		
			FlashComponent::set('info', 'Load Data terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
		
		public function generateModels() {
			Doctrine_Core::generateModelsFromYaml(MODELS.'schema/schema.yml', MODELS);	
				
			FlashComponent::set('info', 'Generate Models terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
		
		public function generateSchema() {
			Doctrine_Core::generateYamlFromModels(MODELS.'schema/schema.yml', MODELS);
			
			FlashComponent::set('info', 'Generate Schema terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
		
		public function generateTables() {
			try {
			Doctrine_Manager::connection()->export->dropTable('users');
			} catch(Exception $e) {
			}
			
			Doctrine_Core::createTablesFromModels(MODELS);
			
			FlashComponent::set('info', 'Generate Table terminé.');
			$this->redirect('/doctrine/scripts/index');
		}
	}
