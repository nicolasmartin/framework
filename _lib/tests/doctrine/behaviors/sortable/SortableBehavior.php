<?php
class SortableBehavior extends Doctrine_Template {
	protected $_options = array('name'			=>	'position',
								'alias'			=>	null,
								'type'			=>	'integer',
								'length'		=>	8,
								'unique'		=>	true,
								'options'		=>	array(),
								'fields'		=>	array(),
								'uniqueBy'		=>	array(),
								'uniqueIndex' 	=>	true,
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

		if (!empty($this->_options['uniqueBy']) && !is_array($this->_options['uniqueBy']))	{
			throw new Exception("Sortable option 'uniqueBy' must be an array");
		}
/*		
		if ($this->_options['uniqueIndex'] == true && ! empty($this->_options['uniqueBy'])) {
			$indexFields = array($this->_options['name']);
			$indexFields = array_merge($indexFields, $this->_options['uniqueBy']);

			$this->index($this->getSortableIndexName(), array('fields' => $indexFields, 'type' => 'unique')); 
		} elseif ($this->_options['unique']) {
			$indexFields = array($this->_options['name']);
			$this->index($this->getSortableIndexName(), array('fields' => $indexFields, 'type' => 'unique')); 
		}*/

		$this->addListener(new SortableListener($this->_options));
	}

	protected function getSortableIndexName()	{ 
		return sprintf('%s_%s_%s', $this->getTable()->getTableName(), $this->_options['name'], $this->_options['indexName']); 
	} 

	public function demote() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);
		
		if ($position < $object->getFinalPosition()) {
			$object->moveToPosition($position + 1);
		}
	}

	public function promote() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);
		
		if ($position > 1) {
			$object->moveToPosition($position - 1);
		}
	}

	public function moveToFirst() {
		$object = $this->getInvoker();
		$object->moveToPosition(1);
	}

	public function moveToLast() {
		$object = $this->getInvoker();
		$object->moveToPosition($object->getFinalPosition());
	}

	public function moveToPosition($newPosition)	{
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);
		$connection = $object->getTable()->getConnection();

	    $connection->beginTransaction();

		$object->set($fieldName, null);
		$object->save();

	    if ($position > $newPosition) {
			$q = $object->getTable()->createQuery()
				->update(get_class($object))
				->set($fieldName, $fieldName . ' + 1')
				->where($fieldName.' < ?', $position)
				->andWhere($fieldName.' >= ?', $newPosition)
				->orderBy($fieldName.' DESC');
			foreach ($this->_options['uniqueBy'] as $field) {
				$q->addWhere($field.' = ?', $object[$field]);
			}
			$q->execute();
    	} elseif ($position < $newPosition) {
   			$q = $object->getTable()->createQuery()
				  ->update(get_class($object))
				  ->set($fieldName, $fieldName.' - 1')
				  ->where($fieldName.' > ?', $position)
				  ->andWhere($fieldName.' <= ?', $newPosition)
				  ->orderBy($fieldName.' ASC');
			foreach ($this->_options['uniqueBy'] as $field) {
				$q->addWhere($field.' = ?', $object[$field]);
			}
			$q->execute();
   		}
		
		$object->set($fieldName, $newPosition);
		$object->save();
		
		$connection->commit();
  	}

	public function sortTableProxy($order)	{
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		$position 	= $object->get($fieldName);

		$connection = $object->getTable()->getConnection();

		$connection->beginTransaction();

		foreach ($order as $position => $id) {
			$newObject = Doctrine::getTable(get_class($object))->findOneById($id);

			if ($newObject->get($fieldName) != $position + 1) {
				$newObject->moveToPosition($position + 1);
			}
		}
		$connection->commit();
	}

	public function getFinalPosition() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$q = $object->getTable()->createQuery()
			->select($fieldName)
			->orderBy($fieldName.' DESC');
		
/*		foreach($this->_options['uniqueBy'] as $field) {
			if(is_object($object[$field]))	{
				$q->addWhere($field . ' = ?', $object[$field]['id']);
			} else {
				$q->addWhere($field . ' = ?', $object[$field]);
			}
		}*/
			foreach ($this->_options['uniqueBy'] as $field) {
				$q->addWhere($field.' = ?', $object[$field]);
			}
		$q->limit(1);
		
		$last = $q->fetchOne();
		
		echo "-".$q;
		$finalPosition = $last ? $last->get($fieldName) : 0;
		
		return $finalPosition;
	}
		
	public function getSiblings($included = false) {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$q = $object->getTable()->createQuery()
				->orderBy($fieldName.' ASC');
		if ($object->id && $included == false) {
			$q->where('id != ?', $object->id);
		}
		foreach ($this->_options['uniqueBy'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
		return $q->execute();
	}

	public function reSortTableProxy() {
		$object 	= $this->getInvoker();
		$fieldName 	= $this->_options['name'];
		
		$q = $object->getTable()->createQuery()
				->orderBy($fieldName.' ASC');
		foreach ($this->_options['uniqueBy'] as $field) {
			$q->addWhere($field.' = ?', $object[$field]);
		}
		foreach ($q->execute() as $position => $Item) {
			$Item->position = $position+1;
			$Item->save();
		}
	}
}