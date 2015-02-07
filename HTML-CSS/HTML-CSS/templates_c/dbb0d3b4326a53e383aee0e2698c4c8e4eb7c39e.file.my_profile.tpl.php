<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 15:31:08
         compiled from "my_profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173425225454d62fbc1f3cd4-33408181%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbb0d3b4326a53e383aee0e2698c4c8e4eb7c39e' => 
    array (
      0 => 'my_profile.tpl',
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
  'nocache_hash' => '173425225454d62fbc1f3cd4-33408181',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d62fbc288082_17854010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d62fbc288082_17854010')) {function content_54d62fbc288082_17854010($_smarty_tpl) {?><head>
    

</head>
<body>
    
	<h3><?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
</h3> 
	<h4><a href = goals.html>Goals</a></h4>
	<ul>
		<li><h5>In Progress</h5></li>
		<ol>
			<li>Goal 1</li>
			<li>Goal 2</li>
			<li>Goal 3</li>
		</ol>
		<li><h5>[number completed]</h5></li>
	</ul>

</body><?php }} ?>
