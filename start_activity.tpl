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
{/block}
