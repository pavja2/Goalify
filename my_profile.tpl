{extends file="base.tpl"}
{block name=header}
    <link href="my_profile.css" rel="stylesheet" type="text/css"/>
    <script src="my_profile.js"></script>
{/block}
{block name=body}
    <h3>{$username}</h3>
    <div id="goal_div">
        <table id="goal_table" class="dataTable display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Goal Name</th>
                    <th>Start Date</th>
                    <th>End Date</th> 
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$goalList item=goal}
                    <tr onclick = "window.document.location = 'goal.php?goalId={$goal->getId()}'">
                        <td>{$goal->getName()}</td>
                        <td>{$goal->getBeginDate()->format('Y-m-d')}</td>
                        <td>{$goal->getEndDate()->format('Y-m-d')}</td>
                        <td>{$goal->getCampaignStatus()->getStatus()}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}
