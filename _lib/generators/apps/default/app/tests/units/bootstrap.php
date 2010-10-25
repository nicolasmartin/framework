<?php
    define('ROOT',      realpath(dirname(__FILE__).'/../../../../'));
    define('LIB', 		ROOT.'/_lib');
    define('MODELS',	ROOT.'/models');	

    require_once LIB.'/core/_includes.php';
    require_once LIB.'/vendors/doctrine/Doctrine.php';
    require_once LIB.'/vendors/simpletest/autorun.php';
    require_once LIB.'/vendors/simpletest/web_tester.php';
    SimpleTest::prefer(new TextReporter());

    // Environnement
    define('ENV', 'test');

    // Bootstrap
    $Bootstrap = Bootstrap::getInstance();
    $Bootstrap->setEnv(ENV);

    $Bootstrap->loadConfigs(ROOT.'/configs/');
    $Bootstrap->loadConfigs('../../configs/');

    $Bootstrap->addModelPath(ROOT.'/models/bases/');
    $Bootstrap->addModelPath(ROOT.'/models/');
    $Bootstrap->setDoctrine();

    // Drop et recréé la base de tests avec les fixtures
    try {
        $Conn = Doctrine_Manager::connection();
        $Conn->dropDatabase();
        $Conn->createDatabase();
        Doctrine::createTablesFromModels(MODELS);
        Doctrine::LoadData(MODELS.'fixtures/test/');
    } catch(Exception $e) {}
    
    // define('ROOT',           realpath(dirname(__FILE__).'/../../')."/");
    // define('CONTROLLERS',    ROOT.'controllers/default/');
    // define('VIEWS',      ROOT.'views/default/');
    // define('MODELS',         ROOT.'models/');
    // 
    // require_once(ROOT.'_lib/vendors/simpletest/autorun.php');
    // require_once ROOT.'_lib/core/_includes.php';
    // require_once ROOT.'_lib/vendors/doctrine/Doctrine.php';
    // 
    // // Environnement
    // define('ENV', 'test');
    // 
    // // Bootstrap
    // $Bootstrap = Bootstrap::getInstance();
    // $Bootstrap->setDefaultPath('default/index'); 
    // $Bootstrap->setEnv(ENV);
    // 
    // $Bootstrap->addAutoloadPath(ROOT.'controllers/default/');
    // $Bootstrap->addAutoloadPath(ROOT.'controllers/default/_components/');
    // $Bootstrap->addAutoloadPath(ROOT.'views/default/_helpers/');
    // 
    // $Bootstrap->loadConfigs(ROOT.'configs/default/');
    // 
    // $Bootstrap->addModelPath(ROOT.'models/bases/');
    // $Bootstrap->addModelPath(ROOT.'models/');
    // $Bootstrap->setDoctrine();
    // 
    // // Drop et recréé la base de tests avec les fixtures
    // $Conn = Doctrine_Manager::connection();
    // $Conn->dropDatabase();
    // $Conn->createDatabase();
    // Doctrine::createTablesFromModels(MODELS);
    // Doctrine::LoadData(MODELS.'fixtures/test/');