<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 07:15:49
         compiled from "balance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117397477154d6b1392a9124-79084652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cece9d8a421bafbed62e7308969ce6c653607442' => 
    array (
      0 => 'balance.tpl',
      1 => 1423368971,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423379396,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117397477154d6b1392a9124-79084652',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d6b139318197_28111158',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d6b139318197_28111158')) {function content_54d6b139318197_28111158($_smarty_tpl) {?><head>
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
 src="balance.js" type="text/javascript"><?php echo '</script'; ?>
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
            <li><a href = initiate_activity.php>Start An Activity</a></li>
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

    
        
	<h3>How Much Will You Pledge?</h3><br>
<div class="boxed">
<h4> Please enter the amount you wish to pledge: </h4>
       <br>
           <ol>
                <li>
       <div class="form-group">
                        <label for="payment_amount" class="col-sm-2 control-label" id = "form">Pledge Dollar Amount:</label>
                        
       <input id="amount" type="number" step="0.01"  min = 0>
       </div>
                 <br>
                </li>
		<br>


 		<li>
       <div class="form-group">
			<label for="payment_info" class="col-sm-2 control-label">Payment Information:</label>
			<input id="payment_info"></input> 
       </div>
		</li>
		<br>

        </ol>
</div>
<br>
<br>
<div class="wrapper">
  <button type="button" class="btn btn-success btn-lg" id="submit"> Start Your Activity!</button>
</div>
<br>
<br>
<br>
<br>
<br>

</body>
<?php }} ?>
