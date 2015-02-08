{extends file = "base.tpl"}
{block name = "header"}
    <script src="partnerhsips.js" type="text/javascript"></script>
{/block}
{block name = "body"}
	<h3>Partnerships</h3> 
	<table id="partner-table" class="dataTable display" cellspacing = "0" width = "100%">
		<thead>
			<tr>
				<th>My Name</th>
				<th>My Partner's Goal</th>
				<th>My Partner's Start Date</th>
				<th>My Partner's End Date</th>
				<th>My Partner's Goal Status</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$partnerList item=partnership}
			<tr onclick='window.document.location = "goal.php?goalId={$partnership->getCampaign()->getId()}?partner=true"'>
                                <td>{$partnership->getUserRelatedbyPartnerId()->getUserName()}</td>
                                <td>{$partnership->getCampaign()->getName()}</td>
                                <td>{$partnership->getCampaign()->getBeginDate()->format('m/d/Y')}</td>
                                <td>{$partnership->getCampaign()->getEndDate()->format('m/d/Y')}</td>
                                <td>{$partnership->getCampaign()->getCampaignStatus()->getStatus()}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{/block}
