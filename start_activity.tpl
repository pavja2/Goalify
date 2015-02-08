{extends file= "base.tpl"}
{block name = "header"}
	<script src="start_activity.js" type="text/javascript"></script>
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
		<input type="date"  id="end_date"></input>
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
<div style="text-align: center;">
  <button type="button" class="btn btn-success btn-lg" id="submit"> Submit</button>
</div>
<br>
<br>
<br>
<br>
<br>
{/block}
