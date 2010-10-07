<?php
class SortableListener extends Doctrine_Record_Listener {
	protected $_options = array();
	protected $newPosition = null;
	protected $oldPosition = null;
	
	public function __construct(array $options) {
		$this->_options = $options;
	}
	
	public function preInsert(Doctrine_Event $event){	
		$object 	= $event->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$this->oldPosition = null;
		$this->newPosition = null;
		
		if ($object->$fieldName) {
			$this->newPosition = $object->$fieldName;
		}
		$object->$fieldName = $object->getFinalPosition()+1;
	}

	public function postInsert(Doctrine_Event $event){	
		$object 	= $event->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		if ($this->newPosition) {
			$object->moveToPosition($this->newPosition);
		} else if($this->_options['newFirst']) {
			$object->moveToFirst();
		}
	}

	public function preUpdate(Doctrine_Event $event){	
		$object 	= $event->getInvoker();
		$fieldName 	= $this->_options['name'];
		$modified 	= $object->getModified(true);
		
		$this->oldPosition = null;
		$this->newPosition = null;
		
		if (isset($modified[$fieldName]) && ($modified[$fieldName] != $object[$fieldName])) {
			$this->oldPosition = $modified[$fieldName];
			$this->newPosition = $object[$fieldName];
			$object[$fieldName] = null;
		}
	}
	
	public function postUpdate(Doctrine_Event $event){	
		$object			= $event->getInvoker();
		$fieldName 		= $this->_options['name'];
		$position 		= $this->oldPosition;
		$newPosition 	= $this->newPosition;
		$connection 	= $object->getTable()->getConnection();
			
		if ($newPosition != $position) {
			$connection->beginTransaction();
			
			if ($position > $newPosition) {
				$q = $object->getTable()->createQuery()
					->update()
					->set($fieldName, $fieldName.' + 1')
					->where($fieldName.' < ?', $position)
					->andWhere($fieldName.' >= ?', $newPosition);
				foreach ($this->_options['parents'] as $field) {
					$q->addWhere($field . ' = ?', $object[$field]);
				}
				$q->execute();
			} elseif ($position < $newPosition) {
				$q = $object->getTable()->createQuery()
					->update()
					->set($fieldName, $fieldName.' - 1')
					->where($fieldName.' > ?', $position)
					->andWhere($fieldName.' <= ?', $newPosition);
				foreach($this->_options['parents'] as $field) {
					$q->addWhere($field . ' = ?', $object[$field]);
				}
				$q->execute();
			}

			$this->oldPosition = null;
			$this->newPosition = null;
			
			$object->$fieldName = $newPosition;
			$object->save();
			
			$connection->commit();
		}
	}

	public function postDelete(Doctrine_Event $event) {
		$fieldName 	= $this->_options['name'];
		$object 	= $event->getInvoker();
		$position 	= $object->$fieldName;
		
		$q = $object->getTable()->createQuery()
					->update()
					->set($fieldName, $fieldName.' - ?', '1')
					->where($fieldName.' > ?', $position);
		foreach ($this->_options['parents'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
		$q->execute();
	} 
}