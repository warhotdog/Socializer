<?php

global $lang;

$lang['en_US']['Socialize_items']['PLURALNAME'] = array(
	'Socialize_itemss',
	50,
	'Pural name of the object, used in dropdowns and to generally identify a collection of this object in the interface'
);
$lang['en_US']['Socialize_items']['SINGULARNAME'] = array(
	'Socialize_items',
	50,
	'Singular name of the object, used in dropdowns and to generally identify a single object in the interface'
);

$lang['en_US']['Socializer']['ADMININSTRUCTIONS'] = <<<INSTRUCTIONS
Add new links from social networks if none click on "New Socializer" to start
INSTRUCTIONS;

$lang['en_US']['Socializer']['MODULENAME'] = 'Socializer';
$lang['en_US']['Socializer']['ROOT'] = 'Socializer';
$lang['en_US']['Socializer']['BTNNEW'] = 'New Socializer';

$lang['en_US']['Socializer']['SERVICE'] = 'Service';
$lang['en_US']['Socializer']['NAME'] = 'Name';
$lang['en_US']['Socializer']['URL'] = 'Url';
$lang['en_US']['Socializer']['TITLE'] = 'Title';
$lang['en_US']['Socializer']['SAVE'] = 'Save';
$lang['en_US']['Socializer']['UPDATE'] = 'Update';
$lang['en_US']['Socializer']['DELETE'] = 'Delete';

$lang['en_US']['Socializer']['SAVENEWITEM'] = 'New Socializer Save';
$lang['en_US']['Socializer']['UPDATEITEM'] = 'Socializer Updated';
$lang['en_US']['Socializer']['DELETEITEM'] = 'Socializer Eraser';
$lang['en_US']['Socializer']['FAILNEWITEM'] = 'Error  to Save/Update/Erase Socializer';

$lang['en_US']['Socializer']['SAVESTATUS'] = 'Saved (New)';
$lang['en_US']['Socializer']['UPDATESTATUS'] = 'Saved (Updated)';
$lang['en_US']['Socializer']['DELTESTATUS'] = 'Save (Eraserd)';

$lang['en_US']['Socializer']['INSTRUCTION'] = <<<INSTRUCTIONS
<div>
    <h5> Instructions: </ h5> You can use the following variables <br/>
     <strong> $ page_title </ strong>: Take the title of the page, <br/>
     <strong> $ Page_Url </ strong>: Returns the URL of the current page to share <br/>
     <strong> Example usage: </ strong> <br/>
     http://www.google.com/bookmarks/mark?op=edit&output=popup&bkmk = $ Page_Url & title = $ page_title
     <br/>
</div>

INSTRUCTIONS;

$lang['en_US']['SocializerDecorator']['SHOWICONS'] = 'You want show Socializer Icons?';
$lang['en_US']['SocializerDecorator']['INVITEFRIEND'] = 'Invite a Friend';
$lang['en_US']['SocializerDecorator']['PRINT'] = 'Print';

$lang['en_US']['Send2Friend']['FROM'] = 'From';
$lang['en_US']['Send2Friend']['TO'] = 'To';
$lang['en_US']['Send2Friend']['SEND'] = 'Send';
$lang['en_US']['Send2Friend']['SENDING'] = "Sending";
$lang['en_US']['Send2Friend']['INVITINGTEMPLATE'] = <<<TEMPLATE
<div>
<p> A friend thought you might be interested or who should see the next page: %s </p>
</div>
TEMPLATE;
?>