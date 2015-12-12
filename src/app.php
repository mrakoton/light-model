<?php
use Mrakoton\Orm\Base\Query;
use Mrakoton\Orm\Model\User;
use Mrakoton\Orm\Hydrator\Hydrator;

// Autoloader registration
$loader  = require __DIR__ . '/../vendor/autoload.php';
$loader->add('Mrakoton', __DIR__);

// Native Query
$q = new Query('SELECT * FROM user');
$res = $q->execute();

// Get all user
$users = User::findAll();

//$users[0]->setUsername("MaxPecas");
//$users[0]->save();
var_dump($users[0]->getUsername());

// Create user
$nu = new User();
$nu->setFirstname('Jack');
$nu->setLastname('Nicholson');
$nu->save();

// Delete users
foreach($users as $u) {
    if($u->getId() > 2) {
      $u->delete();
    }
}

var_dump($nu);
