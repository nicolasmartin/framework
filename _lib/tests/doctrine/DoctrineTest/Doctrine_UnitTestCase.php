<?php
class Doctrine_UnitTestCase extends UnitTestCase 
{
    protected $manager;
    protected $connection;
    protected $objTable;
    protected $new;
    protected $old;
    protected $dbh;
    protected $listener;

    protected $valueHolder;
    protected $tables = array();
    protected $unitOfWork;
    protected $driverName = false;
    protected $generic = false;
    protected $conn;
    protected $adapter;
    protected $export;
    protected $expr;
    protected $dataDict;
    protected $transaction;
    protected $_name;
    protected $init = false;

    public function getName()
    {
        return $this->_name;
    }

    public function init() 
    {
        $this->_name = get_class($this);

        $this->manager   = Doctrine_Manager::getInstance();
        $this->manager->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_ALL);

        $class = get_class($this);
        $e     = explode('_', $class);

        if ( ! $this->driverName) {
            $this->driverName = 'main';
    
            switch($e[1]) {
                case 'Export':
                case 'Import':
                case 'Transaction':
                case 'DataDict':
                case 'Sequence':
                    $this->driverName = 'Sqlite';
                break;
            }
            
            $module = $e[1];
    
            if (count($e) > 3) {
                $driver = $e[2];
                switch($e[2]) {
                    case 'Mysql':
                    case 'Mssql':
                    case 'Oracle':
                    case 'Pgsql':
                    case 'Sqlite':
                        $this->driverName = $e[2];
                    break;
                }
            }
        }

        try {
            $this->conn = $this->connection = $this->manager->getConnection($this->driverName);
            $this->manager->setCurrentConnection($this->driverName);

            $this->connection->evictTables();
            $this->dbh      = $this->adapter = $this->connection->getDbh();
            $this->listener = $this->manager->getAttribute(Doctrine_Core::ATTR_LISTENER);

            $this->manager->setAttribute(Doctrine_Core::ATTR_LISTENER, $this->listener);

        } catch(Doctrine_Manager_Exception $e) {
            if ($this->driverName == 'main') {
                $this->dbh = new PDO('sqlite::memory:');
                $this->dbh->sqliteCreateFunction('trim', 'trim', 1);
            } else {
                $this->dbh = $this->adapter = new Doctrine_Adapter_Mock($this->driverName);
            }

            $this->conn = $this->connection = $this->manager->openConnection($this->dbh, $this->driverName);

            if ($this->driverName !== 'main') {
                $exc  = 'Doctrine_Connection_' . ucwords($this->driverName) . '_Exception';

                $this->exc = new $exc();

            } else {
            }

            $this->listener = new Doctrine_EventListener();
            $this->manager->setAttribute(Doctrine_Core::ATTR_LISTENER, $this->listener);
        }
        if ($this->driverName !== 'main') {

            if (isset($module)) {
                switch($module) {
                    case 'Export':
                    case 'Import':
                    case 'Transaction':
                    case 'Sequence':
                    case 'Expression':
                        $lower = strtolower($module);
    
                        $this->$lower = $this->connection->$lower;
                    break;
                    case 'DataDict':
                        $this->dataDict = $this->connection->dataDict;
                    break;
                }
            }
        }
        $this->unitOfWork = $this->connection->unitOfWork;
        $this->connection->setListener(new Doctrine_EventListener());
        $this->query = new Doctrine_Query($this->connection);

        if ($this->driverName === 'main') {
            $this->prepareTables();
            $this->prepareData();
            foreach ($this->tables as $name) {
            	$this->connection->getTable(ucwords($name))->clear();
            }
        }
    }
	
    public function prepareTables() {
        foreach($this->tables as $name) {
            $name = ucwords($name);
            $table = $this->connection->getTable($name);
            $query = 'DROP TABLE ' . $table->getTableName();
            try {
                $this->conn->exec($query);
            } catch(Doctrine_Connection_Exception $e) {

            }
        }
        $this->conn->export->exportClasses($this->tables);
    }
	
    public function prepareData() 
    {
    }
	
    public function getConnection() 
    {
        return $this->connection;
    }
	
    public function assertDeclarationType($type, $type2) 
    {
        $dec = $this->getDeclaration($type);
        
        if ( ! is_array($type2)) {
            $type2 = array($type2);
        }

        $this->assertEqual($dec['type'], $type2);
    }
	
    public function getDeclaration($type) 
    {
        return $this->dataDict->getPortableDeclaration(array('type' => $type, 'name' => 'colname', 'length' => 1, 'fixed' => true));
    }
	
    public function setUp()
    {
        if ( ! $this->init) {
            $this->init();
        }
        if (isset($this->objTable)) {
            $this->objTable->clear();
        }

        $this->init = true;
    }
    
    public function tearDown() {
    }
}
