<div class="socializer">
    <ul>
    <% if getSocialItems %>
        <% control getSocialItems %>
            <% if Name == Send2Fried %>
            <li><a target="_blank" class="ico_$Service" title="$Title" href="{$Url}/?ref=$Top.Link">$Name</a></li>
            <% else %>
            <li><a target="_blank" class="ico_$Service" title="$Title" href="$Url">$Name</a></li>
            <% end_if %>
        <% end_control %>
    <% end_if %>
    </ul>
</div>