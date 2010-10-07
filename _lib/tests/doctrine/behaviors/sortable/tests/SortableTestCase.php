<?php
class Doctrine_SortableTestCase extends Doctrine_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function prepareTables()
    {
        $this->tables[] = "SortableItem";
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
}

class SortableItem extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('my_item');
        $this->hasColumn('name', 'string', 50);
    }

    public function setUp()
    {
        parent::setUp();
        $this->actAs('SortableBehavior');
    }
}

