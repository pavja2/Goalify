<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 16:50:09
         compiled from "my_profile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131625464654d618bfd28f71-31799009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46364f3c1dee92ee14a8bd5d5053aa797cd611ab' => 
    array (
      0 => 'my_profile.tpl',
      1 => 1423326932,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423327808,
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
    <?php echo '<script'; ?>
 src="//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
    <link href="base.css" rel="stylesheet" type="text/css"/>
    <?php echo '<script'; ?>
 src="jquery.cookie.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"><?php echo '</script'; ?>
>   
    
    <link href="my_profile.css" rel="stylesheet" type="text/css"/>
    <?php echo '<script'; ?>
 src="my_profile.js"><?php echo '</script'; ?>
>

</head>
<body>
    
    <h3>Name</h3>
    <div id="goal_button"><b>Goal Button</b></div>
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
                    <tr>

                        <td><?php echo $_smarty_tpl->tpl_vars['goal']->value->getId();?>
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
