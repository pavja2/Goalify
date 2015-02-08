{extends file= "base.tpl"}
{block name = "header"}
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="create_activity.js" type="text/javascript"></script>
{/block}
{block name = 'body'}
	<h3>Start An Activity!</h3>
<br>
<br>
<div style="text-align: center;">
    <h4 id = "opening"> Congratulations! You're at the first step of doing something great!</h4>
    <h4 id = "opening"> Please fill out this form with a goal that you would like to achieve. </h4>
</div>
	<ol>
<br>
		<li>
<div class="boxed">
			<h4 id = "form">Activity Description:</h4>
			<p>Goals must be SMART: specific, measurable, attainable, relevant, and timely.</p>
			<input id="description" size= "80" placeholder="e.g., Do 11 pushups for 7 days">
<br>
</div>
		</li>
<br>
		<li>
<div class="boxed">

		<label for="end_date">Enter Expected Completion Date: </label>
		<input id="end_date"></input>
		</li>
</div>
<br>
		<li>
<div class="boxed">
			<h4 id = "form">Charity:</h4>
                        <input type="radio" name="charities" value="cancer"> American Cancer Society</input>
<br>
                        <input type="radio" name="charities" value="habitat"> Habitat For Humanity</input>
<br>
                        <input type="radio" name="charities" value="redCross"> Red Cross</input>
<br>
			<input type="radio" name="charities" value="unicef"> UNICEF
</div>
		</li>
	</ol>
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
