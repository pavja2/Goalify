<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 03:01:51
         compiled from "goals.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57848661954d6d19f2309d4-36786628%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd292cff64e923cdc181ba77ac4c9ea52b79ac0d6' => 
    array (
      0 => 'goals.tpl',
      1 => 1423344711,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423360103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57848661954d6d19f2309d4-36786628',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d6d19f2f86d9_92209393',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d6d19f2f86d9_92209393')) {function content_54d6d19f2f86d9_92209393($_smarty_tpl) {?><head>
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
    <link href='//fonts.googleapis.com/css?family=Dosis:300' rel='stylesheet' type='text/css'>
    <nav class="navbar navbar-inverse navbar-static-top bs-docs-nav" role="banner">
      <div class="container">
        <div class="navbar=header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
        </div>
        <div class="padding"></div>
        <ul id = "navigation">
            <li><a href = index.php>My Profile</a></li>
            <li><a href = initiate_activity.php>Start An Activity</a></li>
            <li><a href = partnerships.php>Partnerships</a></li>
            <li><a href = log_out.php>Log Out</a></li>
        </ul>
        <div class="padding"></div>
    </nav>
    </div>
    
    <h1><img src="Goalify.png" src="Bet on yourself!"></h1>
    <h2>Bet on yourself!</h2>
    <br>


    
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

</body>
<?php }} ?>
