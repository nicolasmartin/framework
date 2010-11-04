<?php
class LibraryTable extends DefaultTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object LibraryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Library');
    }
	
	public function getAll($limit = 10) {
		$q = $this->createQuery('i')
			->select()
			->orderby('i.id desc')
			->limit($limit);
		return $q->execute();
	}
}