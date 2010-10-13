<div class="socializer">
    <ul>
    <% if getSocialItems %>
        <% control getSocialItems %>
            <% if Name == Send2Friend %>
            <li>
                <img alt="$Title" src="{$Top.SocializerTheme}{$Service}.png" />
                <a {$Top.SocializerItemAction} target="_blank" class="ico_$Service" title="$Title" href="{$Url}/iframe/?ref=$Top.Link">$Name</a>
            </li>
            <% else %>
            <li>
                <img alt="$Title" src="{$Top.SocializerTheme}{$Service}.png" />
                <a target="_blank" class="ico_$Service" title="$Title" href="$Url">$Name</a></li>
            <% end_if %>
        <% end_control %>
    <% end_if %>
    </ul>
</div>