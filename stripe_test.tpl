{extends file="base.tpl"}
{block head}{/block}
{block body}
<form action="balance.php" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
    data-amount=""
    data-name="Demo Site"
    data-description=""
    data-image="/128x128.png">
  </script>
</form>
{/block}