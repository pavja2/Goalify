{extends file='base.tpl'}
{block name='header'}
    <script src="purl.js" type="text/javascript"></script>
    <script src="signup.js" type="text/javascript"></script>
{/block}
{block name='body'}
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
{/block}
