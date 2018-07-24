
{strip}
<div class="contentsDiv marginLeftZero">
    <div class="listViewPageDiv" id="listViewContent">
        <div class="listViewTopMenuDiv">
            <div class="listViewActionsDiv row-fluid">
                <div class="span4 btn-toolbar">
                    <span class="customFilterMainSpan btn-group">
                        <select id="customFilter" style="width:200px;">
                            <optgroup label="My Search Streams">
                                <option value="AL">Alabama</option>
                            </optgroup>
                            <hr>
                            <option value="AR">
                                Posts
                            </option>
                            <option value="AF">
                                Favorites
                            </option>
                            <hr>
                            <option value="">
                                <i class="icon-plus"></i> Add New Stream
                            </option>
                        </select>
                    </span>
                </div>
                <div class="span8 btn-toolbar">
                    <div class="listViewActions pull-right">
                        <span class="btn-group">
                            <button class="btn addButton">
                                <i class="icon-pencil"></i> Compose
                            </button>
                        </span> 
                        <span class="btn-group">
                            <a href="index.php?module=Social&view=RevokeAccess" class="btn addButton">
                                <i class="icon-wrench"></i> Revoke Access
                            </a>
                        </span> 
                    </div>
                </div>
            </div>
        </div>
        <div class="listViewContentDiv">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="text-align: center" class="text-center" colspan="3">Actions</th>
                        <th>Media</th>
                        <th>Published On</th>
                        <th>Message</th>
                        <th>Retweets</th>
                        <th>Favorites</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {foreach from=$TWEETS item=tweet key=key name=name}
                        <tr>
                            <td>
                                <a class="tweet-reply" data-id="{$tweet['id']}" href="">
                                    <i class="icon-share"></i>
                                </a>
                            </td>
                            <td>
                                <a class="tweet-favorite" data-id="{$tweet['id']}" href="">
                                    <i class="icon-heart"></i>
                                </a>
                            </td>
                            <td>
                                <a href="">
                                    <i class="icon-cog"></i>
                                </a>
                            </td>
                            <td><img src="{vimage_path('twitter.png')}" alt=""></td>
                            <td>{$tweet['created_at']}</td>
                            <td>
                                <a target="_blank" href="{$tweet['url']}">{$tweet['text']}</a>
                            </td>
                            <td>{$tweet['retweeted']}</td>
                            <td>{$tweet['favorited']}</td>
                        </tr>
                    {/foreach}
                    
                </tbody>
            </table>
            <div style="text-align:center;">
                <form method="post" action="index.php?module=Social&view=Index">
                    <input type="hidden" name="module" value="Social">
                    <input type="hidden" name="view" value="Index">
                    <input type="hidden" name="initialTweets" value="{$TOTAL_TWEETS}">
                    <input type="hidden" name="moreTweets" value="true">
                    <button id="loadMoreTweets" type="submit" class="btn">More</button>
                </form>
            </div>
        </div>
    </div>
</div>

{/strip}