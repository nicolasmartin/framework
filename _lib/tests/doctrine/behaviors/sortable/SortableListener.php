<?php
class SortableListener extends Doctrine_Record_Listener {
	protected $_options = array();
	protected $reelPosition = null;
	
	public function __construct(array $options) {
		$this->_options = $options;
	}
	
	public function preInsert(Doctrine_Event $event){	
		$object 	= $event->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		if ($object->$fieldName) {
			$this->reelPosition = $object->$fieldName;
		} else if($this->_options['newFirst']) {
			$this->reelPosition = 1;
		}

		$object->$fieldName = $object->getFinalPosition()+1;
	}
	
	public function postInsert(Doctrine_Event $event) {
		$object = $event->getInvoker();
				
		if ($this->reelPosition) {
			$object->moveToPosition($this->reelPosition);
		}
		$this->reelPosition = null;
	}
	
	public function postDelete(Doctrine_Event $event) {
		$fieldName 	= $this->_options['name'];
		$object 	= $event->getInvoker();
		$position 	= $object->$fieldName;
		
		$q = $object->getTable()->createQuery()
					->update(get_class($object))
					->set($fieldName, $fieldName.' - ?', '1')
					->where($fieldName.' > ?', $position)
					->orderBy($fieldName);
		foreach ($this->_options['uniqueBy'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
		$q->execute();
	}  
}