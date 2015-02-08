{extends file = "base.tpl"}
{block name = "header"}
    <script src="partnerhsips.js" type="text/javascript"></script>
{/block}
{block name = "body"}
	<h3>Partnerships</h3> 
	<table id="partner-table" class="dataTable display" cellspacing = "0" width = "100%">
		<thead>
			<tr>
				<th>Partner Name</th>
				<th>Partner Goal</th>
				<th>Partner Start Date</th>
				<th>Partner End Date</th>
				<th>Partner Status</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$partnerList item=partnership}
			<tr>
                                <td>{$partnership->getUserRelatedByPartnerId()->getUserName()}</td>
                                <td>{$partnership->getCampaign()->getName()}</td>
                                <td>{$partnership->getCampaign()->getBeginDate()->format('m/d/Y')}</td>
                                <td>{$partnership->getCampaign()->getEndDate()->format('m/d/Y')}</td>
                                <td>{$partnership->getCampaign()->getCampaignStatus()->getStatus()}</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
{/block}
