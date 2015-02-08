{extends file = "base.tpl"}
{block name = "header"}
{/block}
{block name = "body"}
	<h3>Partnerships</h3> 
	<table id = partner_table class = "dataTable display" cellspacing = "0" width = 100%">
		<thread>
			<tr>
				<th>Partner Name</th>
				<th>Parther Goal</th>
				<th>Partner Start Date</th>
				<th>Partner End Date</th>
				<th>Partner Status</th>
			</tr> 
		</thread>
		<tbody>
			{foreach from=$partnerList item = partner}
				<tr onclick = "window.document.location = 'goal.php?goalId={$goal->getId()}'">
					<td>{$partner->getPartnerName()}</td>
					<td>{$partner->getPartnerGoal()}</td>
					<td>{$partner->getPartnerBeginDate()->format('Y-m-d')}</td>
					<td>{$partner->getPartnerEndDate()->format('Y-m-d;)}</td>
					<td>{$partner->getPartnerStatus()}</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
{/block} 
