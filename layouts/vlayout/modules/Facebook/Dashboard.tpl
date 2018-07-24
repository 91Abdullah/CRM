
<br>
<div class="container">
    <div class="pull-right">
        <a href="{$LOGOUT_URL}" class="btn"><i class="icon-wrench"></i> Revoke Access</a>
    </div>
    <br>
    <br>
    {foreach from=$RATINGS_DATA item=data}
    <hr>
    <div style="text-align:center;margin: 10px;">
        <h2>{$data['page_name']}</h2>
        <p>{$data['category']}</p>
    </div>
    <div class="row">
        <div class="span12">
            {if $data['reviews']|@count gt 0}
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Reviewer Name</th>
                    <th>Date/Time</th>
                    <th>Rating</th>
                    <th>Review Text</th>
                </tr>
                {foreach from=$data['reviews'] item=item key=key}
                <tr>
                    <td>{$key + 1}</td>
                    <td>{$item['reviewer']['name']}</td>
                    <td>{$item['created_time']|date_format:'%D %H:%M:%S'}</td>
                    <td>{$item['rating']}</td>
                    <td>{$item['review_text']}</td>
                </tr>
                {/foreach}
            </table>
            {else}
            <p style="text-align:center; font-weight: bold;">No reviews found for above page.</p>
            {/if}
        </div>
    </div>
    <hr>
    {/foreach}
</div>