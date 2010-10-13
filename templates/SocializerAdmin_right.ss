<div class="title"><div>$ApplicationName</div></div>

<% if EditForm %>
	$EditForm
<% else %>
	<form id="Form_EditForm" action="admin/my?executeForm=EditForm" method="post" enctype="multipart/form-data">
		<p><% _t('Socializer.ADMININSTRUCTIONS') %></p>
	</form>
<% end_if %>

<p id="statusMessage" style="visibility:hidden"></p>