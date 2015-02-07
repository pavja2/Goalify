<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 14:32:00
         compiled from "my_profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131625464654d618bfd28f71-31799009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46364f3c1dee92ee14a8bd5d5053aa797cd611ab' => 
    array (
      0 => 'my_profile.tpl',
      1 => 1423318157,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423317177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131625464654d618bfd28f71-31799009',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d618bfd29d15_67568431',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d618bfd29d15_67568431')) {function content_54d618bfd29d15_67568431($_smarty_tpl) {?><head>
    <?php echo '<script'; ?>
 src="//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="jquery.cookie.js" type="text/javascript"><?php echo '</script'; ?>
>
   
<?php echo '<script'; ?>
 src="//cdnjs.cloudflare.com/ajax/libs/dropbox.js/0.10.2/dropbox.min.js"><?php echo '</script'; ?>
>

</head>
<body>
    
    
<?php echo $_smarty_tpl->tpl_vars['username']->value;?>

<?php echo $_smarty_tpl->tpl_vars['firstName']->value;?>

<?php echo $_smarty_tpl->tpl_vars['lastName']->value;?>


</body>
<?php }} ?>
