<?php

include_once('vtlib/vtiger/Utils.php');
include_once('vtlib/vtiger/Module.php');

global $adb;
$adb->setDebug(true);

//Creating Module

// $module = new Vtiger_Module();
// $module->name = 'Social';
// $module->parent = 'Marketing';
// $module->save();
// $module->initTables();

$module = Vtiger_Module::getInstance('Social');
// $module->parent = 'Marketing';
// $module->save();

var_dump($module);

//Creating block
