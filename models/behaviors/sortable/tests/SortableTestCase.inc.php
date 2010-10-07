<?php
class Doctrine_SortableTestCase extends Doctrine_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();
		parent::prepareTables();
    }
	
    public function prepareTables()
    {
        $this->tables[] = "SortableItem";
        $this->tables[] = "SortableItemParents";
        parent::prepareTables();
    }

    public function testRecordsAreSorted()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertTrue($item1->position < $item2->position);
    }

    public function testGetPrevious()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertEqual($item1->id, $item2->getPrevious()->id);
    }

    public function testGetNext()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertEqual($item1->getNext()->id, $item2->id);
    }
	
	public function testSwapWith()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();
        $item3 = new SortableItem();
        $item3->save();

        $this->assertTrue($item1->position < $item2->position);
        $this->assertTrue($item2->position < $item3->position);
        $item3->swapWith($item1);
        $this->assertTrue($item3->position < $item2->position);
        $this->assertTrue($item2->position < $item1->position);
	}
	
 	public function testGetLastPosition()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertEqual($item1->getFinalPosition(), $item2->position);
    }
	
 	public function testMoveToFirst()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertTrue($item1->position < $item2->position);
        $item1->moveToFirst();
        $this->assertEqual($item1->position, 1);
    }
	
 	public function testMoveToLast()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertTrue($item1->position < $item2->position);
        $item1->moveToLast();
        $this->assertEqual($item1->position, $item2->position);
    }

 	public function testMoveUp()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertTrue($item1->position < $item2->position);
        $item2->moveUp();
        $this->assertTrue($item1->refresh()->position > $item2->position);
    }
	
 	public function testMoveDown()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();

        $this->assertTrue($item1->position < $item2->position);
        $item1->moveDown();
        $this->assertTrue($item1->position > $item2->refresh()->position);
    }
	
 	public function testMoveToPosition()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();
        $item3 = new SortableItem();
        $item3->save();
        $item4 = new SortableItem();
        $item4->save();
        $item5 = new SortableItem();
        $item5->save();
		
		$new_position = $item1->position;
        $item5->moveToPosition($new_position);
        $this->assertEqual($item5->position, $new_position);
        $this->assertEqual($item1->refresh()->position, $new_position+1);

		$new_position = $item4->refresh()->position;
        $item2->moveToPosition($new_position);
        $this->assertEqual($item2->refresh()->position, $new_position);
        $this->assertEqual($item4->refresh()->position, $new_position-1);
    }
	
    public function testNewFirst()
    {
        $item1 = new SortableItem();
        $item1->save();	
		$item1->moveToFirst();
		
        $item2 = new SortableItem();
        $item2->save();
		$item2->moveToFirst();
		
        $this->assertEqual($item2->refresh()->position, 1);
        $this->assertEqual($item1->refresh()->position, 2);

        $item3 = new SortableItemNewFirst();
        $item3->save();	
		
        $item4 = new SortableItemNewFirst();
        $item4->save();
		
        $this->assertEqual($item4->refresh()->position, 1);
        $this->assertEqual($item3->refresh()->position, 2);
    }
	
    public function testNewPosition()
    {
        $item1 = new SortableItem();
        $item1->save();	

        $item2 = new SortableItem();
        $item2->save();	

        $item3 = new SortableItem();
        $item3->save();	
		
        $item4 = new SortableItem();
		$item4->position = 2;
        $item4->save();	
		
		$item1->refresh();
		$item2->refresh();
		$item3->refresh();
		$item4->refresh();

        $this->assertEqual($item1->position, 1);
        $this->assertEqual($item4->position, 2);
        $this->assertEqual($item2->position, 3);
        $this->assertEqual($item3->position, 4);
    }

    public function testUpdatePosition()
    {
        $item1 = new SortableItem();
        $item1->save();	

        $item2 = new SortableItem();
        $item2->save();	

        $item3 = new SortableItem();
        $item3->save();	
		
        $item4 = new SortableItem();
        $item4->save();	
		
        $this->assertEqual($item1->position, $item1->getFinalPosition()-3);
        $this->assertEqual($item2->position, $item2->getFinalPosition()-2);
        $this->assertEqual($item3->position, $item2->getFinalPosition()-1);
        $this->assertEqual($item4->position, $item2->getFinalPosition());
		
		$new_position = $item1->position;

		$item4->position = $new_position;
		$item4->save();	

        $this->assertEqual($item4->position, $new_position);
        $this->assertEqual($item1->refresh()->position, $new_position+1);
        $this->assertEqual($item2->refresh()->position, $new_position+2);
        $this->assertEqual($item3->refresh()->position, $new_position+3);
    }

    public function testDelete()
    {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();
        $item3 = new SortableItem();
        $item3->save();
        $item4 = new SortableItem();
        $item4->save();
        $item5 = new SortableItem();
        $item5->save();
		
        $this->assertEqual($item3->refresh()->position, $item2->refresh()->position+1);
        $this->assertEqual($item4->refresh()->position, $item3->refresh()->position+1);
        $this->assertEqual($item5->refresh()->position, $item4->refresh()->position+1);
		
		$item4->delete();
		
        $this->assertEqual($item3->refresh()->position, $item2->refresh()->position+1);
        $this->assertEqual($item5->refresh()->position, $item3->refresh()->position+1);
    }
	
	public function testInsertWithParent() {
        $item1 = new SortableItemParents();
		$item1->parent_id = 1;
        $item1->save();
        $item2 = new SortableItemParents();
		$item2->parent_id = 1;
        $item2->save();
        $item3 = new SortableItemParents();
		$item3->parent_id = 2;
        $item3->save();
        $item4 = new SortableItemParents();
		$item4->parent_id = 2;
        $item4->save();

        $this->assertEqual($item1->position, 1);
        $this->assertEqual($item2->position, 2);
        $this->assertEqual($item3->position, 1);
        $this->assertEqual($item4->position, 2);
	}
	
	public function testDeleteWithParent() {
        $item1 = new SortableItemParents();
		$item1->parent_id = 3;
        $item1->save();
        $item2 = new SortableItemParents();
		$item2->parent_id = 3;
        $item2->save();
        $item3 = new SortableItemParents();
		$item3->parent_id = 4;
        $item3->save();
        $item4 = new SortableItemParents();
		$item4->parent_id = 4;
        $item4->save();

        $this->assertEqual($item1->position, 1);
        $this->assertEqual($item2->position, 2);
        $this->assertEqual($item3->position, 1);
        $this->assertEqual($item4->position, 2);
		
		$item1->delete();
		$item3->delete();
		
        $this->assertEqual($item2->refresh()->position, 1);
        $this->assertEqual($item4->refresh()->position, 1);
	}

	public function testSwapWithParent() {
        $item1 = new SortableItemParents();
		$item1->parent_id = 5;
        $item1->save();
        $item2 = new SortableItemParents();
		$item2->parent_id = 6;
        $item2->save();
		
        try {
            $item1->swapWith($item2);
            $this->fail();
        } catch (Doctrine_Record_Exception $e) {
            $this->pass();
        }
	}
	
	public function testReorderArray() {
        $item1 = new SortableItem();
        $item1->save();
        $item2 = new SortableItem();
        $item2->save();
        $item3 = new SortableItem();
        $item3->save();
        $item4 = new SortableItem();
        $item4->save();
        $item5 = new SortableItem();
        $item5->save();
		
		$new_order = array(
			$item4->id,
			$item2->id,
			$item1->id,
			$item5->id,
			$item3->id,
		);
		
		$check_order = array(
			$item4->refresh()->id,
			$item2->refresh()->id,
			$item1->refresh()->id,
			$item5->refresh()->id,
			$item3->refresh()->id,
		);
	}
}

function pr($a) {
	echo "<pre>";
	print_r($a);
	echo "</pre>";	
}

function debug($item1 = null, $item2 = null, $table = "SortableItem") {
	$q = Doctrine::getTable($table)->createQuery()->orderby('position asc');
	if ($item1 && $item2) {
		$q->where('id >= ?', $item1->id);
		$q->andWhere('id <= ?', $item2->id);
	}
	pr ($q->execute()->toArray() );
}

class SortableItem extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('my_item');
    }

    public function setUp()
    {
        parent::setUp();
        $this->actAs('SortableBehavior');
    }
}

class SortableItemNewFirst extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('my_item');
    }

    public function setUp()
    {
        parent::setUp();
        $this->actAs('SortableBehavior', array('newFirst' => true));
    }
}

class SortableItemParents extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('my_item2');
		$this->hasColumn('parent_id', 'integer', 8);
    }

    public function setUp()
    {
        parent::setUp();
        $this->actAs('SortableBehavior', array('parents' => array('parent_id')));
    }
}




