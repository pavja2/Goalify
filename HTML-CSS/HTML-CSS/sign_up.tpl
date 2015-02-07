{extends file = "before_login.tpl"}
{block name = "header"}
{/block}
{block name = "body"}
	<form>
		<h3>Sign Up</h3>
		<p id = "opening"> Congratulations! You're at the first step of doing something great!</p>
		<p id = "opening"> Sign up for free today and begin accomplishing your goals!</p>
		<h4 id = "form">First Name:</h4>
		<input type="text" name="first_name" placeholder="First name">
		<h4 id = "form">Last Name:</h4>
		<input type="text" name="last_name" placeholder="Last Name">
		<h4 id = "form">Username:</h4>
		<input type="text" name="username" placeholder="Username">
		<h4 id = "form">Email Address:</h4>
		<input type="text" name="email_address" placeholder="Email Address">
		<h4 id = "form">Password:</h4>
		<input type="text" name="password" placeholder="Password">
		<h4 id = "form">Reenter Password:</h4>
		<input type="text" name="reenter_password" placeholder="Reenter Password">
		<br>
		<br>
		<input type="submit" value="Submit">
	</form>
{/block}
