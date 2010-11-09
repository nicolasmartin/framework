<?php
abstract class Base{#Model#} extends DefaultRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('{#Model#}');
        $this->hasColumn('name', 'string', 100, array(
             'notblank' => true,
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('email', 'string', 50, array(
             'email' => true,
             'notblank' => true,
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('body', 'clob', null, array(
             'notblank' => true,
             'type' => 'clob',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
    }
}