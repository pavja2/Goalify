<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 15:36:43
         compiled from "log_in.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88917092154d62c39d40880-29842782%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c4428f177007eee58e584fdff448a6d611a3ada' => 
    array (
      0 => 'log_in.tpl',
      1 => 1423320488,
      2 => 'file',
    ),
    'd923797660d99c8714e9761e8b7a11a74dee1fc8' => 
    array (
      0 => 'before_login.tpl',
      1 => 1423323400,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88917092154d62c39d40880-29842782',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d62c39da9c36_67005841',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d62c39da9c36_67005841')) {function content_54d62c39da9c36_67005841($_smarty_tpl) {?><head>
	<link rel = "stylesheet" type = "text/css" href = "before_login.css">
	<h1>Goalie
	<h2>Bet on yourself!</h2>
	<ul id = "navigation">
		<li><a href = log_in.html>Log In</a></li>
		<li><a href = sign_up.html>Sign In</a></li>
	</ul>
</head>
<body>

	<form>
		<h3>Log In</h3>
		<h4 id = "form">Email Address:</h4>
		<input type="text" name="email_address" placeholder="Email Address">
		<h4 id = "form">Password:</h4>
		<input type="text" name="password" placeholder="Password">
		<br>
		<br>
		<input type="submit" value="Submit">
	</form>

</body>
<?php }} ?>
