{extends file = "before_login.tpl"}
{block name = "header"}
<script src="//cdnjs.cloudflare.com/ajax/libs/dropbox.js/0.10.2/dropbox.min.js">
</script>
<script src="jquery.cookie.js" type="text/javascript"></script>
<script src='index.js'> </script>
{/block}
{block name = "body"}
	<h3>You have succesfully logged out.</h3>
	<h3>Come back soon!</h3>
        <br>
        <br>
        <p style="text-align: center;">
            <button type=button class="btn btn-info btn-lg" id="signup-button">Log In Again</button>
        </p>

{/block}
