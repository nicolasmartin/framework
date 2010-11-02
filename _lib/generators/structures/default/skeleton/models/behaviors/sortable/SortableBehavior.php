<?php
class SortableBehavior extends Doctrine_Template {
	protected $_options = array('name'			=>	'position',
								'alias'			=>	null,
								'type'			=>	'integer',
								'length'		=>	8,
								'options'		=>	array(),
								'parents'		=>	array(),
								'indexName'	 	=>	'sortable',
								'newFirst'		=> false,
	);

	public function __construct(array $options = array()) {
		$this->_options = Doctrine_Lib::arrayDeepMerge($this->_options, $options);
	}

	public function setTableDefinition() {
		$name = $this->_options['name'];
		if ($this->_options['alias']) {
			$name .= ' as ' . $this->_options['alias'];
		}
		$this->hasColumn($name, $this->_options['type'], $this->_options['length'], $this->_options['options']);
		
		if (!empty($this->_options['parents']) && !is_array($this->_options['parents']))	{
			throw new Exception("Sortable option 'parents' must be an array");
		}
		$this->addListener(new SortableListener($this->_options));
	}

	protected function getSortableIndexName() { 
		return sprintf('%s_%s_%s', $this->getTable()->getTableName(), $this->_options['name'], $this->_options['indexName']); 
	} 

	public function moveDown() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);
		
		if ($position < $object->getFinalPosition()) {
			$object->moveToPosition($position + 1);
		}
	}

	public function moveUp() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);
		
		if ($position > 1) {
			$object->moveToPosition($position - 1);
		}
	}

	public function getNext()  {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);

        $q = $object->getTable()->createQuery()
            ->addWhere($fieldName." > ?", $position)
            ->orderBy($fieldName." ASC");
		foreach ($this->_options['parents'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
        return $q->fetchOne();
	}
	
	public function getPrevious() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);

        $q = $object->getTable()->createQuery()
            ->addWhere($fieldName." < ?", $position)
            ->orderBy($fieldName." DESC");
		foreach ($this->_options['parents'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
        return $q->fetchOne();
	}

  	public function swapWith(Doctrine_Record $object2) {
		$object1 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];

        foreach ($this->_options['parents'] as $col) {
            if ($object1->$col != $object2->$col) {
                throw new Doctrine_Record_Exception('Cannot swap items from different lists.');
            }
        }

        $conn = $this->getTable()->getConnection();
        $conn->beginTransaction();

        $pos1 = $object1->$fieldName;
        $pos2 = $object2->$fieldName;
        $object1->$fieldName = $pos2;
        $object2->$fieldName = $pos1;
        $object1->save();
        $object2->save();

        $conn->commit();
    }
	
	public function moveToFirst() {
		$object = $this->getInvoker();
		$object->moveToPosition(1);
	}

	public function moveToLast() {
		$object = $this->getInvoker();
		$object->moveToPosition($object->getFinalPosition());
	}
	
	public function moveToPosition($newPosition) {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);
		$connection = $object->getTable()->getConnection();
		
		$connection->beginTransaction();

		$object->set($fieldName, null);
		$object->save();

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
	
		$object->set($fieldName, $newPosition);
		$object->save();
				
		$connection->commit();
	}

	public function getFinalPosition() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$q = $object->getTable()->createQuery()
			->select($fieldName)
			->orderBy($fieldName.' DESC')
			->limit(1);
		foreach($this->_options['parents'] as $field) {
			if(is_object($object[$field])) {
				$q->addWhere($field . ' = ?', $object[$field]['id']);
			} else {
				$q->addWhere($field . ' = ?', $object[$field]);
			}
		}
		$last = $q->fetchOne();
	
		return $last ? $last->get($fieldName) : 0;
	}
		
	public function getSiblings($included = false) {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$q = $object->getTable()->createQuery()
				->orderBy($fieldName.' ASC');
		if ($object->id && $included == false) {
			$q->where('id != ?', $object->id);
		}
		foreach ($this->_options['parents'] as $field) {
			$q->addWhere($field . ' = ?', $object[$field]);
		}
		return $q->execute();
	}

	public function reSortTableProxy() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$q = $object->getTable()->createQuery()
				->orderBy($fieldName.' ASC');
		foreach ($this->_options['parents'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
		foreach ($q->execute() as $position => $Item) {
			$Item->position = $position+1;
			$Item->save();
		}
	}
}