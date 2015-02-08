{extends file = "before_login.tpl"}
{block name = "header"}
<script src="//cdnjs.cloudflare.com/ajax/libs/dropbox.js/0.10.2/dropbox.min.js"></script>
<script src="jquery.cookie.js" type="text/javascript"></script>
<script src='index.js'></script>
{/block}
{block name = "body"}
		<h3>Log In</h3>
                <button id=login-button">Log In With Dropbox!</button>
{/block}
