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

SocializerAdmin::set_InviteFriendEmail(true); // false
/* enable/disable - Invite Friend Form */

SocializerAdmin::set_PrintPage(true); //false
/* enable/disable - PrintPage  maybe you need print css (windows.print()) */

SocializerAdmin::set_SocializerTheme('wpzoom'); //VSM
/* Theme images sets of socializer icos view images folder */
SocializerAdmin::set_SocializerThemeSize('32px'); //16px, 24px, 32px, 48px, 64px
/* Under Image Folder add 16px 24px ..etc icon size look estructure for add yours icons */

SocializerAdmin::set_LibraryUse('JQuery'); //JQuery  MT  Prototype
// Prototype No Ready Yet
/* Select JS Library
 * when you enable InviteFriendEmail and SimpleSocializer is false
 * the InviteForm open on Lightbox
 * MT = Mootools
 * JQuery = JQuery
 * Prototype = Protorype    No Ready Yet
 */

SocializerAdmin::set_SimpleSocializer(false); // false
/* Enable/Disable - SimpleBar
 * Enable - Icon are disable and Lightbox open are disable
 * Disable - Icon Are Enable and Lightbox/Modalbox form open
 */


if (SocializerAdmin::get_InviteFriendEmail()) {
    Director::addRules('50',array(
        'send2friend/$Action/$ID/$OtherID' => 'Send2Friend_Controller'
    ));
}


?>