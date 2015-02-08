<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 22:08:56
         compiled from "log_in.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71071618454d6869d2464e7-83354920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0285bc9e3a306008edb0431b84c33182e30813d' => 
    array (
      0 => 'log_in.tpl',
      1 => 1423346081,
      2 => 'file',
    ),
    '5f2f4c455737b34bcd6869bf60f1477a1e942fc7' => 
    array (
      0 => 'before_login.tpl',
      1 => 1423346934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71071618454d6869d2464e7-83354920',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d6869d2a6b65_95689328',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d6869d2a6b65_95689328')) {function content_54d6869d2a6b65_95689328($_smarty_tpl) {?><head>
	<link rel = "stylesheet" type = "text/css" href = "before_login.css">
	<h1><img src="Goalify.png" alt="Bet on yourself!"></h1>
	<h2>Bet on yourself!</h2>
	<ul id = "navigation">
		<li><a class="btn btn-default" href = log_in.php>Log In</a></li>
		<li><a href = index.php>Sign Up</a></li>
	</ul>
</head>
<body>

		<h3>Log In</h3>
                <button id=login-button">Log In With Dropbox!</button>

</body>
<?php }} ?>
