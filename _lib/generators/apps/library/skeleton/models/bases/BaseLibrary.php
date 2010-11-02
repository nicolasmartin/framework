<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Library', 'default');

/**
 * BaseLibrary
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $path
 * @property int $width
 * @property int $height
 * @property string $type
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLibrary extends DefaultRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('library');
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '50',
             ));
        $this->hasColumn('path', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('width', 'int', 4, array(
             'type' => 'int',
             'length' => '4',
             ));
        $this->hasColumn('height', 'int', 4, array(
             'type' => 'int',
             'length' => '4',
             ));
        $this->hasColumn('type', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_timestampable();
        $this->actAs($timestampable0);
    }
}