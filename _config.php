<?php
DEFINE('SOCIALIZERPATH', basename(dirname(__FILE__)));

DataObject::add_extension('SiteTree', 'SocializerDecorator');
Object::add_extension('ContentController' , 'Socializer');

Object::addStaticVars('LeftAndMain', array(
	'extra_menu_items' => array(
		'SocializerAdmin' => 'admin/socializer/',
	)
));

Director::addRules(100, array(
	'admin/socializer/$Action/$ID' => 'SocializerAdmin',
));

SocializerAdmin::set_InviteFriendEmail(true);
SocializerAdmin::set_PrintPage(true);
SocializerAdmin::set_SocializerTheme('wpzoom');
SocializerAdmin::set_SocializerThemeSize('32px');
SocializerAdmin::set_LibraryUse('MT'); //JQuery  MT  Prototype
SocializerAdmin::set_SimpleSocializer(true);


if (SocializerAdmin::get_InviteFriendEmail()) {
    Director::addRules('50',array(
        'send2friend/$Action/$ID/$OtherID' => 'Send2Friend_Controller'
    ));
}


?>