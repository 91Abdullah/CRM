<?php /* Smarty version Smarty-3.1.7, created on 2018-03-08 05:58:46
         compiled from "D:\xampp5.6\htdocs\crm\includes\runtime/../../layouts/vlayout\modules\Social\Dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159025a9f80b92a4e72-36857720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0cf3d829e674c38b5b57f4dd34d1a47ddec7269' => 
    array (
      0 => 'D:\\xampp5.6\\htdocs\\crm\\includes\\runtime/../../layouts/vlayout\\modules\\Social\\Dashboard.tpl',
      1 => 1520488721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159025a9f80b92a4e72-36857720',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5a9f80b9544d1',
  'variables' => 
  array (
    'TWEETS' => 0,
    'tweet' => 0,
    'TOTAL_TWEETS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5a9f80b9544d1')) {function content_5a9f80b9544d1($_smarty_tpl) {?>
<div class="contentsDiv marginLeftZero"><div class="listViewPageDiv" id="listViewContent"><div class="listViewTopMenuDiv"><div class="listViewActionsDiv row-fluid"><div class="span4 btn-toolbar"><span class="customFilterMainSpan btn-group"><select id="customFilter" style="width:200px;"><optgroup label="My Search Streams"><option value="AL">Alabama</option></optgroup><hr><option value="AR">Posts</option><option value="AF">Favorites</option><hr><option value=""><i class="icon-plus"></i> Add New Stream</option></select></span></div><div class="span8 btn-toolbar"><div class="listViewActions pull-right"><span class="btn-group"><button class="btn addButton"><i class="icon-pencil"></i> Compose</button></span><span class="btn-group"><a href="index.php?module=Social&view=RevokeAccess" class="btn addButton"><i class="icon-wrench"></i> Revoke Access</a></span></div></div></div></div><div class="listViewContentDiv"><table class="table table-striped"><thead><tr><th style="text-align: center" class="text-center" colspan="3">Actions</th><th>Media</th><th>Published On</th><th>Message</th><th>Retweets</th><th>Favorites</th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['tweet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tweet']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TWEETS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tweet']->key => $_smarty_tpl->tpl_vars['tweet']->value){
$_smarty_tpl->tpl_vars['tweet']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['tweet']->key;
?><tr><td><a class="tweet-reply" data-id="<?php echo $_smarty_tpl->tpl_vars['tweet']->value['id'];?>
" href=""><i class="icon-share"></i></a></td><td><a class="tweet-favorite" data-id="<?php echo $_smarty_tpl->tpl_vars['tweet']->value['id'];?>
" href=""><i class="icon-heart"></i></a></td><td><a href=""><i class="icon-cog"></i></a></td><td><img src="<?php echo vimage_path('twitter.png');?>
" alt=""></td><td><?php echo $_smarty_tpl->tpl_vars['tweet']->value['created_at'];?>
</td><td><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['tweet']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['tweet']->value['text'];?>
</a></td><td><?php echo $_smarty_tpl->tpl_vars['tweet']->value['retweeted'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['tweet']->value['favorited'];?>
</td></tr><?php } ?></tbody></table><div style="text-align:center;"><form method="post" action="index.php?module=Social&view=Index"><input type="hidden" name="module" value="Social"><input type="hidden" name="view" value="Index"><input type="hidden" name="initialTweets" value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_TWEETS']->value;?>
"><input type="hidden" name="moreTweets" value="true"><button id="loadMoreTweets" type="submit" class="btn">More</button></form></div></div></div></div><?php }} ?>