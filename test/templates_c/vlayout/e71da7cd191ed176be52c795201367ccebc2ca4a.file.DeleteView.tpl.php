<?php /* Smarty version Smarty-3.1.7, created on 2018-05-30 09:33:00
         compiled from "E:\xampp5.6\htdocs\crm\includes\runtime/../../layouts/vlayout\modules\Settings\Picklist\DeleteView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168165b0e6fcc2f7ce7-76027794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e71da7cd191ed176be52c795201367ccebc2ca4a' => 
    array (
      0 => 'E:\\xampp5.6\\htdocs\\crm\\includes\\runtime/../../layouts/vlayout\\modules\\Settings\\Picklist\\DeleteView.tpl',
      1 => 1468488064,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168165b0e6fcc2f7ce7-76027794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'SOURCE_MODULE' => 0,
    'FIELD_MODEL' => 0,
    'SELECTED_PICKLISTFIELD_EDITABLE_VALUES' => 0,
    'PICKLIST_VALUE' => 0,
    'FIELD_VALUES' => 0,
    'PICKLIST_VALUE_KEY' => 0,
    'SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES' => 0,
    'NON_EDITABLE_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5b0e6fcc570e9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b0e6fcc570e9')) {function content_5b0e6fcc570e9($_smarty_tpl) {?>
<div class='modelContainer'><div class="modal-header"><button data-dismiss="modal" class="close" title="<?php echo vtranslate('LBL_CLOSE');?>
">x</button><h3><?php echo vtranslate('LBL_DELETE_PICKLIST_ITEMS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><form id="deleteItemForm" class="form-horizontal" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="mode" value="remove" /><input type="hidden" name="picklistName" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" /><div class="modal-body tabbable"><div class="control-group"><div class="control-label"><?php echo vtranslate('LBL_ITEMS_TO_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls"><select class="select2" multiple="" id="deleteValue" name="delete_value[]" style="min-width: 200px"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option <?php if (in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['FIELD_VALUES']->value)){?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php } ?></select><input id="pickListValuesCount" type="hidden" value="<?php echo count($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value);?>
" /></div><br><div class="control-label"><?php echo vtranslate('LBL_REPLACE_IT_WITH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls"><select id="replaceValue" name="replace_value" class="chzn-select" data-validation-engine="validate[required]"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if (!(in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['FIELD_VALUES']->value))){?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php }?><?php } ?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if (!(in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['FIELD_VALUES']->value))){?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php }?><?php } ?></select></div><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value){?><br><div class="control-label"><?php echo vtranslate('LBL_NON_EDITABLE_PICKLIST_VALUES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls nonEditableValuesDiv"><ul class="nonEditablePicklistValues" style="list-style-type: none;"><?php  $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->key => $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value){
$_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->key;
?><li><?php echo vtranslate($_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</li><?php } ?></ul></div><?php }?></div></div><div class="modal-footer"><div class=" pull-right cancelLinkContainer"><a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><button class="btn btn-danger" type="submit" name="saveButton"><strong><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></form></div><?php }} ?>