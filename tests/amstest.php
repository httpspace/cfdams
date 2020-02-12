<?php

require '../vendor/autoload.php';

use Deror\Cfdams;


$api = new Cfdams();
//取得部門資料
$res = $api->getDepartment();
echo "<pre>";
var_dump($res);
echo "</pre>";


echo "<pre>";
var_dump($api->getError());
echo "</pre>";
