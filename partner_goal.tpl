{extends file = 'base.tpl'}
{block name = "header"}
<link href="goal.css" rel="stylesheet" type="text/css"/>
<script src="goal.js"></script>
{/block}
{block name = "body"}
            <h3>{$goal->getName()}</h3>
<div id="goal_container">
	<div id="goal_info_div">
	<div id="sub_info">
            <h4>Start Date:</h4>
            <h4>{$goal->getBeginDate()->format('Y-m-d')}</h4>
            <br>
            <h4>End Date: </h4>
            <h4>{$goal->getEndDate()->format('Y-m-d')}</h4>
            <br>
            <h4>Campaign Status: </h4>
            <h4>{$goal->getCampaignStatus()->getStatus()}</h4>
            <br>
            <h4>Balance: </h4>
            <h4>${$balance->getAmount()}</h4>
		</div>
    </div>
	<div id="checkpoint_info_div">
		<button type="button" class="btn btn-default btn-lg">
			<h2>Mark Complete</h2>
		</button>
	</div>
</div>


{/block}

