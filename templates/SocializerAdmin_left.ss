<div class="title"><div><% _t('Socializer.MODULENAME') %></div></div>

<div id="treepanes" style="overflow-y: auto;">
	<ul id="TreeActions">
		<li class="action" id="addlink"><button><% _t('Socializer.BTNNEW') %></button></li>
	</ul>
	<div style="clear:both;"></div>
	<form class="actionparams" id="addlink_options" style="display: none" action="admin/socializer/addlink">
		<input type="hidden" name="ID" value="new" />
		<input type="submit" value="<% _t('ADDLINK','Add a link xXx') %>" />
	</form>
<div id="sitetree_holder" style="overflow:auto">
	$SiteTreeAsUL
</div>
</div>
