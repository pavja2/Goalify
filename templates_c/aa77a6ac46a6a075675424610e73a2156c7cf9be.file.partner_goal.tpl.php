<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 05:45:10
         compiled from "partner_goal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53432920454d6e151c2b509-00366448%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa77a6ac46a6a075675424610e73a2156c7cf9be' => 
    array (
      0 => 'partner_goal.tpl',
      1 => 1423372439,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423374003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53432920454d6e151c2b509-00366448',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d6e151cd0ea4_86970714',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d6e151cd0ea4_86970714')) {function content_54d6e151cd0ea4_86970714($_smarty_tpl) {?><head>
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
    <?php echo '<script'; ?>
 src="https://www.dropbox.com/static/api/dropbox-datastores-1.2-latest.js" type="text/javascript"><?php echo '</script'; ?>
>
    
	<?php echo '<script'; ?>
 src="partner_goal.js"><?php echo '</script'; ?>
>

</head>
<body>
    <link rel = "stylesheet" type = "text/css" href = "base.css">
    <h1><img src="Goalify.png" src="Bet on yourself!"></h1>
    <h2>Bet on yourself!</h2>
    <nav class="navbar navbar-default navbar-static-top">
        <ul id = "navigation">
            <li> <a href = index.php>My Profile</a></li>
            <li><a href = initiate_activity.php>Start An Activity</a></li>
            <li><a href = partnerships.php>Partnerships</a></li>
            <li><a href = log_out.php>Log Out</a></li>
        </ul>
    </nav>
    
        <div id="goal_info_div">
            <h3><?php echo $_smarty_tpl->tpl_vars['goal']->value->getName();?>
</h3>
            <h4>Start Date: </h4>
            <h4><?php echo $_smarty_tpl->tpl_vars['goal']->value->getBeginDate()->format('Y-m-d');?>
</h4>
            <br>
            <h4>End Date: </h4>
            <h4><?php echo $_smarty_tpl->tpl_vars['goal']->value->getEndDate()->format('Y-m-d');?>
</h4>
            <br>
            <h4>Campaign Status: </h4>
            <h4><?php echo $_smarty_tpl->tpl_vars['goal']->value->getCampaignStatus()->getStatus();?>
</h4>
            <br>
            <h4>Balance: </h4>
            <h4>PLACEHOLDERZ</h4>
        </div>
        <div id="progress_bar_div">
            PLACEHOLDER FOR PROGRESS BAR
        </div>
        <div id="checkpoints_div">
		<table id="checkpoints_table" class="dataTable display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Due Date</th>
					<th>Completion Status</th>
				</tr>
			</thead>
			<tbody>
                		<?php  $_smarty_tpl->tpl_vars['checkpoint'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['checkpoint']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['checkpoints']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['checkpoint']->key => $_smarty_tpl->tpl_vars['checkpoint']->value) {
$_smarty_tpl->tpl_vars['checkpoint']->_loop = true;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['checkpoint']->value->getDate()->format('Y-m-d');?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['checkpoint']->value->getCompleted();?>
</td>
               			<?php } ?>
			</tbody>
		</table>
        </div>

</body>
<?php }} ?>
