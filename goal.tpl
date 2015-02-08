{extends file = 'base.tpl'}
{block name = "header"}
{/block}
{block name = "body"}
	<div id="goal_info_div">
            <h3>{$goal->getName()}</h3>
            <h4>Start Date: </h4>
            <h4>{$goal->getBeginDate()->format('Y-m-d')}</h4>
            <br>
            <h4>End Date: </h4>
            <h4>{$goal->getEndDate()->format('Y-m-d')}</h4>
            <br>
            <h4>Campaign Status: </h4>
            <h4>{$goal->getCampaignStatus()->getStatus()}</h4>
            <br>
            <h4>Balance: </h4>
            <h4>PLACEHOLDERZ</h4>
        </div>
        <div id="progress_bar_div">
            PLACEHOLDER FOR PROGRESS BAR
        </div>
{/block}

