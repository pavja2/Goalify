{extends file='base.tpl'}
{block name = "header"}
<script src="balance.js" type="text/javascript"></script>
{/block}
{block name = 'body'}
        
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
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
    data-amount=""
    data-name="Demo Site"
    data-description=""
    data-image="/128x128.png">
  </script>
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
{/block}
