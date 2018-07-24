<?php /* Smarty version Smarty-3.1.7, created on 2018-05-10 11:26:54
         compiled from "E:\xampp5.6\htdocs\crm\includes\runtime/../../layouts/vlayout\modules\Facebook\Dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:234695af42c7e921775-71141291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53c7b4efeec4a0675cf391b7454adafa34dfa1e2' => 
    array (
      0 => 'E:\\xampp5.6\\htdocs\\crm\\includes\\runtime/../../layouts/vlayout\\modules\\Facebook\\Dashboard.tpl',
      1 => 1521029215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '234695af42c7e921775-71141291',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LOGOUT_URL' => 0,
    'RATINGS_DATA' => 0,
    'data' => 0,
    'key' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5af42c7ebe011',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5af42c7ebe011')) {function content_5af42c7ebe011($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\xampp5.6\\htdocs\\crm\\libraries\\Smarty\\libs\\plugins\\modifier.date_format.php';
?>
<br>
<div class="container">
    <div class="pull-right">
        <a href="<?php echo $_smarty_tpl->tpl_vars['LOGOUT_URL']->value;?>
" class="btn"><i class="icon-wrench"></i> Revoke Access</a>
    </div>
    <br>
    <br>
    <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RATINGS_DATA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
$_smarty_tpl->tpl_vars['data']->_loop = true;
?>
    <hr>
    <div style="text-align:center;margin: 10px;">
        <h2><?php echo $_smarty_tpl->tpl_vars['data']->value['page_name'];?>
</h2>
        <p><?php echo $_smarty_tpl->tpl_vars['data']->value['category'];?>
</p>
    </div>
    <div class="row">
        <div class="span12">
            <?php if (count($_smarty_tpl->tpl_vars['data']->value['reviews'])>0){?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Reviewer Name</th>
                    <th>Date/Time</th>
                    <th>Rating</th>
                    <th>Review Text</th>
                </tr>
                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['reviews']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                <tr>
                    <td><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['reviewer']['name'];?>
</td>
                    <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value['created_time'],'%D %H:%M:%S');?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['rating'];?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['item']->value['review_text'];?>
</td>
                </tr>
                <?php } ?>
            </table>
            <?php }else{ ?>
            <p style="text-align:center; font-weight: bold;">No reviews found for above page.</p>
            <?php }?>
        </div>
    </div>
    <hr>
    <?php } ?>
</div><?php }} ?>