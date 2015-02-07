{extends file = "base.tpl"}
{block name = "header"}
{/block}
{block name = "body"}
<body>
	<h3>Approve Goals</h3>
	<ol>
		<li>
			<h4 id = "form">Has {$PARTNER1} completed their goal?</h4>
			<input type= "radio" name="status" value="yes">Yes
			<br>
			<input type="radio" name="status" value="no">No
		</li>
		<li>
			<h4 id = "form">Has {$PARTNER2} completed their goal?</h4>
			<input type= "radio" name="status2" value="yes">Yes
			<br>
			<input type="radio" name="status2" value="no">No
		</li>
		<li>
			<h4 id = "form">{$CONTINUED}</h4>
			<input type= "radio" name="status3" value="yes">Yes
			<br>
			<input type="radio" name="status3" value="no">No
		</li>
		<br>
		<br>
		<input type="submit" value="Submit">
      </form>
	</ol>
</body>
{/body}
