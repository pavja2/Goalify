<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 06:23:00
         compiled from "my_profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131625464654d618bfd28f71-31799009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46364f3c1dee92ee14a8bd5d5053aa797cd611ab' => 
    array (
      0 => 'my_profile.tpl',
      1 => 1423375286,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423376578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131625464654d618bfd28f71-31799009',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d618bfd29d15_67568431',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d618bfd29d15_67568431')) {function content_54d618bfd29d15_67568431($_smarty_tpl) {?><head>
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
    
    <link href="my_profile.css" rel="stylesheet" type="text/css"/>
    <?php echo '<script'; ?>
 src="my_profile.js"><?php echo '</script'; ?>
>

</head>
<body>
    <link rel = "stylesheet" type = "text/css" href = "base.css">
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav" id="navigation">
            <li> <a href = index.php>My Profile</a></li>
            <li><a href = initiate_activity.php>Start An Activity</a></li>
            <li><a href = partnerships.php>Partnerships</a></li>
            <li><a href = log_out.php>Log Out</a></li>
        </ul>

    </nav>

<br>
    <h1><img src="Goalify.png" src="Bet on yourself!"></h1>
    <h2>Bet on yourself!</h2>
<br>
<br>

    
    <h3>Name</h3>
    <div id="goal_div">
        <table id="goal_table" class="dataTable display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Goal Name</th>
                    <th>Start Date</th>
                    <th>End Date</th> 
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['goal'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['goal']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goalList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['goal']->key => $_smarty_tpl->tpl_vars['goal']->value) {
$_smarty_tpl->tpl_vars['goal']->_loop = true;
?>
                    <tr onclick = "window.document.location = 'goal.php?goalId=<?php echo $_smarty_tpl->tpl_vars['goal']->value->getId();?>
'">
                        <td><?php echo $_smarty_tpl->tpl_vars['goal']->value->getName();?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['goal']->value->getBeginDate()->format('Y-m-d');?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['goal']->value->getEndDate()->format('Y-m-d');?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['goal']->value->getCampaignStatus()->getStatus();?>
</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
<?php }} ?>
