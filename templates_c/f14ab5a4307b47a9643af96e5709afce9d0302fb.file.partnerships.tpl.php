<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 22:03:31
         compiled from "partnerships.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30646984254d6672cc27394-13112890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f14ab5a4307b47a9643af96e5709afce9d0302fb' => 
    array (
      0 => 'partnerships.tpl',
      1 => 1423345384,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423346032,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30646984254d6672cc27394-13112890',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d6672ccb8f69_81236837',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d6672ccb8f69_81236837')) {function content_54d6672ccb8f69_81236837($_smarty_tpl) {?><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
    <link href="base.css" rel="stylesheet" type="text/css"/>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="jquery.cookie.js" type="text/javascript"><?php echo '</script'; ?>
>
    

</head>
<body>
    <link rel = "stylesheet" type = "text/css" href = "base.css">
    <h1><img src="Goalify.png" src="Bet on yourself!"></h1>
    <h2>Bet on yourself!</h2>
    <nav class="navbar navbar-default navbar-static-top">
        <ul id = "navigation">
            <li> <a href = my_profile.php>My Profile</a></li>
            <li><a href = initiate_activity.php>Start An Activity</a></li>
            <li><a href = partnerships.php>Partnerships</a></li>
            <li><a href = log_out.php>Log Out</a></li>
        </ul>
    </nav>
    
	<h3>Partnerships</h3> 
	<table id="partner_table" class="dataTable display" cellspacing = "0" width = "100%">
		<thread>
			<tr>
				<th>Partner Name</th>
				<th>Partner Goal</th>
				<th>Partner Start Date</th>
				<th>Parther End Date</th<?php echo '?>'; ?>

				<th>Partner Status</th>
			</tr>
		</thread>
		<tbody>
			<?php  $_smarty_tpl->tpl_vars['partnership'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['partnership']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['partnerList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['partnership']->key => $_smarty_tpl->tpl_vars['partnership']->value) {
$_smarty_tpl->tpl_vars['partnership']->_loop = true;
?>
			<tr onclick = "window.document.location = 'goal.php?goalId=<?php echo $_smarty_tpl->tpl_vars['goal']->value->getId();?>
'">
				<td><?php echo $_smarty_tpl->tpl_vars['partnership']->value->getUserId();?>
</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
<?php }} ?>
