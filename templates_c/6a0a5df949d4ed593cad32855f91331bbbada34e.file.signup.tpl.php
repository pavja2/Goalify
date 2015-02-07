<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 13:54:42
         compiled from "signup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189747239654d5c81d9cc171-14985376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a0a5df949d4ed593cad32855f91331bbbada34e' => 
    array (
      0 => 'signup.tpl',
      1 => 1423316771,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423317177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '189747239654d5c81d9cc171-14985376',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d5c81dc6d9f2_56099209',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d5c81dc6d9f2_56099209')) {function content_54d5c81dc6d9f2_56099209($_smarty_tpl) {?><head>
    <?php echo '<script'; ?>
 src="//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="jquery.cookie.js" type="text/javascript"><?php echo '</script'; ?>
>
   
    <?php echo '<script'; ?>
 src="purl.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="signup.js" type="text/javascript"><?php echo '</script'; ?>
>

</head>
<body>
    
    <label for="first_name">First Name:</label>
    <input id="first_name"></input>
    <br>
    <label for="last_name">Last Name:</label>
    <input id="last_name"></input>
    <br>
    <label for="user_name">User Name:</label>
    <input id="user_name"></input>
    <br>
    <label for="email">Email:</label>
    <input id="email"></input>
    <br>
    <label for="email_confirm">Confirm Email</label>
    <input id="email_confirm"></input>
    <br>
    <button id="register-button">Complete Registration</button>

</body>
<?php }} ?>
