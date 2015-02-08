<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 06:14:20
         compiled from "signup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:189747239654d5c81d9cc171-14985376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a0a5df949d4ed593cad32855f91331bbbada34e' => 
    array (
      0 => 'signup.tpl',
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
  'nocache_hash' => '189747239654d5c81d9cc171-14985376',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d5c81dc6d9f2_56099209',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d5c81dc6d9f2_56099209')) {function content_54d5c81dc6d9f2_56099209($_smarty_tpl) {?><head>
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
 src="purl.js" type="text/javascript"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="signup.js" type="text/javascript"><?php echo '</script'; ?>
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
    
    <label for="first_name">First Name:</label>
    <input id="first_name"></input>
    <br>
    <label for="last_name">Last Name:</label>
    <input id="last_name"></input>
    <br>
    <label for="user_name">User Name:</label>
    <input id="user_name"></input>
    <br>
    <label for="email">Email:</label>
    <input id="email"></input>
    <br>
    <label for="email_confirm">Confirm Email</label>
    <input id="email_confirm"></input>
    <br>
    <button id="register-button">Complete Registration</button>

</body>
<?php }} ?>
