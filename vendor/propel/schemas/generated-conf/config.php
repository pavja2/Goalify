<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('hophacks', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=hophacks',
  'user' => 'root',
  'password' => 'hoyahaxa',
));
$manager->setName('hophacks');
$serviceContainer->setConnectionManager('hophacks', $manager);
$serviceContainer->setDefaultDatasource('hophacks');
