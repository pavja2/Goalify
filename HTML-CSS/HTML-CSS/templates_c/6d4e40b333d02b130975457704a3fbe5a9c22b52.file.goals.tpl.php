<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 15:13:36
         compiled from "goals.tpl" */ ?>
<?php /*%%SmartyHeaderCode:109016278754d62acaa53e38-34096392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d4e40b333d02b130975457704a3fbe5a9c22b52' => 
    array (
      0 => 'goals.tpl',
      1 => 1423320488,
      2 => 'file',
    ),
    'a0247d982b7bd73021f7c95bb58ae04406e88c15' => 
    array (
      0 => 'base.tpl',
      1 => 1423321893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '109016278754d62acaa53e38-34096392',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d62acac36f28_48712054',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d62acac36f28_48712054')) {function content_54d62acac36f28_48712054($_smarty_tpl) {?><head>
    

</head>
<body>
    
	<h3>Goals</h3> 
	<h4>In Progress</h4>
	<ol>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['GOAL1']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['GOAL2']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['CONTINUED']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
	</ol>
	<h4>Completed</h4>
	<ol>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['GOAL1']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['GOAL2']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['CONTINUED']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
	</ol>
	<h4>Expired</h4>
	<ol>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['GOAL1']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['GOAL1']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
		<li>
			<h5><?php echo $_smarty_tpl->tpl_vars['CONTINUED']->value;?>
</h5>
			<p><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</p>
		</li>
	</ol>

</body><?php }} ?>
