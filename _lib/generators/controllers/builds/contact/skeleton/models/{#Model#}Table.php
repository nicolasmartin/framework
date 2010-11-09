<?php
class {#Model#}Table extends DefaultTable
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('{#Model#}');
    }
}