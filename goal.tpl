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
            <h4>${$balance->getAmount()}</h4>
        </div>
	<div id="checkpoint_info_div">
		<table id="checkpoint_table" class="dataTable display" cellspacing="0" width="100%">
			<thead>
				<th>Checkpoint Date</th>
				<th>Checkpoint Status</th>
				<th>Upload Proof</th>
			</thead>
			<tbody>
				{foreach from=$checkpoints  item=checkpoint}
					<td>{$checkpoint->getDate()->format('Y-m-d')}</td>
					<td>{$checkpoint->getComplete()}</td>
					<td><button class="checkpoint-button">Upload Proof</button></td>
					<td><button
				{/foreach}
			</tbody>
		</table>
	</div>
{/block}

