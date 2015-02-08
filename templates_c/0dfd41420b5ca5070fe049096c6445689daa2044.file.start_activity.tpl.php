<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 07:03:23
         compiled from "start_activity.tpl" */ ?>
<?php /*%%SmartyHeaderCode:36405789854d68623ba5f45-12162354%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0dfd41420b5ca5070fe049096c6445689daa2044' => 
    array (
      0 => 'start_activity.tpl',
      1 => 1423379000,
      2 => 'file',
    ),
    '8ac60285b5e343b8ef0167e47650db89cab8601a' => 
    array (
      0 => 'base.tpl',
      1 => 1423377083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '36405789854d68623ba5f45-12162354',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d68623c07956_08127716',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d68623c07956_08127716')) {function content_54d68623c07956_08127716($_smarty_tpl) {?><head>
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
 src="start_activity.js" type="text/javascript"><?php echo '</script'; ?>
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
    <h1><img src="Goalify.png" src="Bet on yourself!"></h1>
    <h2>Bet on yourself!</h2>
<br>
<br>

    
	<h3>Start An Activity!</h3>
<br>
<br>
<div style="text-align: center;">
    <h4 id = "opening"> Congratulations! You're at the first step of doing something great!</h4>
    <h4 id = "opening"> Please fill out this form with a goal that you would like to achieve. </h4>
</div>
	<ol>
<br>
<br>
		<li>
<div class="boxed">
			<h4 id = "form">Activity Description:</h4>
			<p>Goals must be SMART: specific, measurable, attainable, relevant, and timely.</p>
			<input type="text" name="description" size= "80" placeholder="e.g., Do 11 pushups for 7 days">
<br>
</div>
		</li>
<br>
<br>
		<li>
<div class="boxed">
			<h4 id="enddate">Pick Date To Accomplish Activity By:</h4>
			<input type="date"  name="enddate">
		</li>
</div>
<br>
<br>
		<li>
			<h4 id = "form">Charity:</h4>
			<input type="radio" name="charities" value="unicef">UNICEF
            <br>
		</li>
	</ol>
  <button id="submit"> Submit</button>

</body>
<?php }} ?>
