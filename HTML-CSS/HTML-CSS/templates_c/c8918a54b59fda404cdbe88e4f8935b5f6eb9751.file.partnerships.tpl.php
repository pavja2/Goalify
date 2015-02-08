<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 15:34:11
         compiled from "partnerships.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26849446754d62f97bd81d8-78570369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8918a54b59fda404cdbe88e4f8935b5f6eb9751' => 
    array (
      0 => 'partnerships.tpl',
      1 => 1423320488,
      2 => 'file',
    ),
    'a0247d982b7bd73021f7c95bb58ae04406e88c15' => 
    array (
      0 => 'base.tpl',
      1 => 1423323196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26849446754d62f97bd81d8-78570369',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d62f97c83404_66557037',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d62f97c83404_66557037')) {function content_54d62f97c83404_66557037($_smarty_tpl) {?><head>
	<link rel = "stylesheet" type = "text/css" href = "base.css">
	<h1>Goalie
	<h2>Bet on yourself!</h2>
	<ul id = "navigation">
		<li><a href = my_profile.html>My Profile</a></li>
		<li><a href = start_activity.html>Start An Activity</a></li>
		<li><a href = partnerships.html>Partnerships</a></li>
		<li><a href = log_out.html>Log Out</a></li>
	</ul>
</head>
<body>
    
	<h3>Partnerships</h3> 
	<ul>
		<li><h5>Accountable To</h5></li>
		<ol>
			<li>
				<h5><a href = partner1_profile.html><?php echo $_smarty_tpl->tpl_vars['PARTNER1']->value;?>
</a></h5>
				<p><?php echo $_smarty_tpl->tpl_vars['GOAL1']->value;?>
</p>
			</li>
			<li>
				<h5><a href = partner2_profile.html><?php echo $_smarty_tpl->tpl_vars['PARTNER2']->value;?>
</a></h5>
				<p><?php echo $_smarty_tpl->tpl_vars['GOAL2']->value;?>
</p>
			</li>
			<li>
				<h5><?php echo $_smarty_tpl->tpl_vars['CONTINUED']->value;?>
</h5>
				<p><?php echo $_smarty_tpl->tpl_vars['GOAL']->value;?>
</p>
			</li>
		</ol>
		<li><h5>Accountable For</h5></li>
		<ol>
			<li>
				<h5><a href = partner1_profile.html><?php echo $_smarty_tpl->tpl_vars['PARTNER1']->value;?>
</a></h5>
				<p><a href = approve_goals.html>[$GOAL1]</a></p>
			</li>
			<li>
				<h5><a href = partner2_profile.html><?php echo $_smarty_tpl->tpl_vars['PARTNER2']->value;?>
</a></h5>
				<p><a href = approve_goals.html>[$GOAL2]</a></p>
			</li>
			<li>
				<h5>[continued]</h5>
				<p><a href = approve_goals.html><?php echo $_smarty_tpl->tpl_vars['GOAL']->value;?>
</a></p>
			</li>
		</ol>
	</ul>

</body>
<?php }} ?>
