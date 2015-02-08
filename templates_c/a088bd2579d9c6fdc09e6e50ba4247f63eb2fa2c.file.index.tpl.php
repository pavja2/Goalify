<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 06:05:50
         compiled from "index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166951300654d57dcee51101-10735408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a088bd2579d9c6fdc09e6e50ba4247f63eb2fa2c' => 
    array (
      0 => 'index.tpl',
      1 => 1423375280,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423375313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166951300654d57dcee51101-10735408',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d57dceeb04a8_98870093',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d57dceeb04a8_98870093')) {function content_54d57dceeb04a8_98870093($_smarty_tpl) {?><head>
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
 src="//cdnjs.cloudflare.com/ajax/libs/dropbox.js/0.10.2/dropbox.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="jquery.cookie.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src='index.js'> <?php echo '</script'; ?>
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
    
    <button id="signup-button">Sign Up With Dropbox!</button>

</body>
<?php }} ?>
