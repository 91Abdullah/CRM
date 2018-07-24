<?php

include_once('vtlib/vtiger/Utils.php');
include_once('vtlib/vtiger/Module.php');

global $adb;
$adb->setDebug(true);

$Vtiger_Utils_Log = true;

// $module = Vtiger_Module::getInstance('Facebook');

// $module->addLink('LISTVIEWSETTING', 'Settings', 'index.php?module=Tweet&parent=Settings&view=Index');

// $block = Vtiger_Block::getInstance('LBL_TWEET_BLOCK', $module);

// $filter1 = Vtiger_Filter::getInstance('All', $module);
// $filter1->isdefault = true;
// // Add fields to the filter created
// $filter1->addField($urlField, 1)->addField($idField, 2);

// $module->delete();

// $idf = Vtiger_Field::getInstance('id', $module);
// $urlf= Vtiger_Field::getInstance('url', $module);
// $contentf = Vtiger_Field::getInstance('content', $module);

// $idf->delete();
// $urlf->delete();
// $contentf->delete();

// print_r($module);
// print_r($block);

$module = new Vtiger_Module();
$module->name = 'Facebook';
$module->parent = 'Marketing';
$module->save();

$module->initTables();

// $block = new Vtiger_Block();
// $block->label = 'LBL_TWEET_BLOCK';
// $module->addBlock($block);

// $blockcf = new Vtiger_Block();
// $blockcf->label = 'LBL_CUSTOM_INFORMATION';
// $module->addBlock($blockcf);

// $field1  = new Vtiger_Field();
// $field1->name = 'tweetname';
// $field1->label= 'Tweet Name';
// $field1->uitype= 2;
// $field1->column = $field1->name;
// $field1->columntype = 'VARCHAR(255)';
// $field1->typeofdata = 'V~M';
// $block->addField($field1);

// $module->setEntityIdentifier($field1);

// $contentfield = new Vtiger_Field();
// $contentfield->name = 'tweetcontent';
// $contentfield->label = 'Tweet Content';
// $contentfield->uitype = 19;
// $contentfield->column = $contentfield->name;
// $contentfield->columntype = 'VARCHAR(255)';
// $contentfield->typeofdata = 'V~M';
// $block->addField($contentfield);

// $urlField = new Vtiger_Field();
// $urlField->name = 'tweeturl';
// $urlField->label = 'Tweet URL';
// $urlField->uitype= 17;
// $urlField->column = $urlField->name;
// $urlField->columntype = 'VARCHAR(255)';
// $urlField->typeofdata = 'V~O';
// $block->addField($urlField);

// /** Common fields that should be in every module, linked to vtiger CRM core table */
// $field2 = new Vtiger_Field();
// $field2->name = 'assigned_user_id';
// $field2->label = 'Assigned To';
// $field2->table = 'vtiger_crmentity';
// $field2->column = 'smownerid';
// $field2->uitype = 53;
// $field2->typeofdata = 'V~M';
// $block->addField($field2);

// $field3 = new Vtiger_Field();
// $field3->name = 'createdtime';
// $field3->label= 'Created Time';
// $field3->table = 'vtiger_crmentity';
// $field3->column = 'createdtime';
// $field3->uitype = 70;
// $field3->typeofdata = 'T~O';
// $field3->displaytype= 2;
// $block->addField($field3);

// $field4 = new Vtiger_Field();
// $field4->name = 'modifiedtime';
// $field4->label= 'Modified Time';
// $field4->table = 'vtiger_crmentity';
// $field4->column = 'modifiedtime';
// $field4->uitype = 70;
// $field4->typeofdata = 'T~O';
// $field4->displaytype= 2;
// $block->addField($field4);

// // Create default custom filter (mandatory)
// $filter1 = new Vtiger_Filter();
// $filter1->name = 'All';
// $filter1->isdefault = true;
// $module->addFilter($filter1);
// // Add fields to the filter created
// $filter1->addField($field1)->addField($contentfield, 1)->addField($urlField, 2);

// // Set sharing access of this module
// $module->setDefaultSharing();

// // Enable and Disable available tools
// $module->enableTools(Array('Import', 'Export'));

// // // Initialize Webservice support
// $module->initWebservice();