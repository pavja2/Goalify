<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-07 15:33:23
         compiled from "start_activity.tpl" */ ?>
<?php /*%%SmartyHeaderCode:70845598054d62d6c686c06-79760738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4bb38411785ced6beb4e71b497c52d9376afaf62' => 
    array (
      0 => 'start_activity.tpl',
      1 => 1423320488,
      2 => 'file',
    ),
    'a0247d982b7bd73021f7c95bb58ae04406e88c15' => 
    array (
      0 => 'base.tpl',
      1 => 1423323196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '70845598054d62d6c686c06-79760738',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d62d6c6ff584_44466139',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d62d6c6ff584_44466139')) {function content_54d62d6c6ff584_44466139($_smarty_tpl) {?><head>
	<link rel = "stylesheet" type = "text/css" href = "base.css">
	<h1>Goalie
	<h2>Bet on yourself!</h2>
	<ul id = "navigation">
		<li><a href = my_profile.html>My Profile</a></li>
		<li><a href = start_activity.html>Start An Activity</a></li>
		<li><a href = partnerships.html>Partnerships</a></li>
		<li><a href = log_out.html>Log Out</a></li>
	</ul>
</head>
<body>
    
	<h3>Start An Activity!</h3>
    <p id = "opening"> Congratulations! You're at the first step of doing something great!</p>
    <p id = "opening"> Please fill out this form with a goal that you would like to achieve. </p>
	<ol>
		<li>
			<h4 id = "form">Activity Type:</h4>
			<input type= "radio" name="activity_id" value="fitness">Fitness
			<br>
			<input type="radio" name="activity_id" value="diet">Diet
			<br>
			<input type="radio" name="activity_id" value="education">Education
			<br>
			<input type="radio" name="activity_id" value="other">Other
			<br>
		</li>
		<li>
			<h4 id = "form">Activity Description:</h4>
			<p>Goals must be SMART: specific, measurable, attainable, relevant, and timely.</p>
			<input type="text" name="description" placeholder="e.g., Do 10 pushups for 7 days">
			</li>
		<li>
			<h4 id = "form">Charity:</h4>
			<input type="radio" name="charities" value="unicef">UNICEF
            <br>
		</li>
      </form>
	</ol>
  <input type="submit" value="Submit">
</body>

</body>
<?php }} ?>
