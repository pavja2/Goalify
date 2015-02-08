<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 13:36:57
         compiled from "goal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167454322154d649c25bc486-02348190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a11721a7ba61a578bd451fb5593003b741b812e8' => 
    array (
      0 => 'goal.tpl',
      1 => 1423402614,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423393389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167454322154d649c25bc486-02348190',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d649c262c310_04870413',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d649c262c310_04870413')) {function content_54d649c262c310_04870413($_smarty_tpl) {?><head>
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
    
<link href="goal.css" rel="stylesheet" type="text/css"/>
<?php echo '<script'; ?>
 src="goal.js"><?php echo '</script'; ?>
>

</head>
<body>
<link href='http://fonts.googleapis.com/css?family=Dosis:300' rel='stylesheet' type='text/css'>
    <link rel = "stylesheet" type = "text/css" href = "base.css">

<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
            <li> <a href = index.php>My Profile</a></li>
            <li><a href = create_activity.php>Start An Activity</a></li>
            <li><a href = partnerships.php>Partnerships</a></li>
            <li><a href = log_out.php>Log Out</a></li>  
	        </ul>
    </nav>
  </div>
</header>

<br>
<br>
    <h1><img src="Goalify.png" src="Bet on yourself!"></h1>
    <h2>Bet on yourself!</h2>
<br>
<br>

    
            <h3 id="goalheader"><?php echo $_smarty_tpl->tpl_vars['goal']->value->getName();?>
</h3>
<div id="goal_container">
	<div id="goal_info_div">
	<div id="sub_info">
            <h4>Start Date:</h4>
            <h4><?php echo $_smarty_tpl->tpl_vars['goal']->value->getBeginDate()->format('Y-m-d');?>
</h4>
            <br>
            <h4>Campaign Status: </h4>
            <h4><?php echo $_smarty_tpl->tpl_vars['goal']->value->getCampaignStatus()->getStatus();?>
</h4>
            <br>
            <h4>Balance: </h4>
            <h4>$<?php echo $_smarty_tpl->tpl_vars['balance']->value->getAmount();?>
</h4>
		</div>
        </div>
	<div id="checkpoint_info_div" class="boxed">
		<h1>Due Date: <?php echo $_smarty_tpl->tpl_vars['goal']->value->getEndDate()->format('Y-m-d');?>
</h1>
	</div>

<br>
<br>
<br>
<button type="button" class="btn btn-success btn-large">Mark Complete</button>
</div>

</body>
<?php }} ?>
