<?php 
//TODO: Comentarizar LOL

class SocializerAdmin extends LeftAndMain {
    static $url_segment = 'socialize';
    static $url_rule = '$Action/$ID';
    static $menu_title = 'Socializer';
    static $menu_priority = 60;
    static $tree_class = "Socializer_items";
    
    protected static $InviteFriendEmail = false;
        static function set_InviteFriendEmail($bool) { self::$InviteFriendEmail = $bool; }
        static function get_InviteFriendEmail() { return self::$InviteFriendEmail; }
   
    protected static $PrintPage = false;
        static function set_PrintPage($bool) { self::$PrintPage = $bool; }
        static function get_PrintPage() { return self::$PrintPage; }
    

    public function init() {
        parent::init();
        Requirements::javascript ("Socializer/javascript/SocializerAdmin_left.js");
        LeftAndMain::setApplicationName('Socializer', 'Socializer');
    }

//TODO: Get Setting Form when request ID = 0
//on the next version


    public function getEditForm($id) {
        if (is_null($id)) return false;
        if ($id == '0') {
            return false;
        }

        $fields = new FieldSet(
                new HiddenField('ID','ID',$id),
                new TextField('Service',_t('Socializer.SERVICE')),
                new TextField('Name',_t('Socializer.NAME')),
                new TextField('Url',_t('Socializer.URL')),
                new LiteralField('instruction', _t('Socializer.INSTRUCTION')),
                new TextField('Title',_t('Socializer.TITLE'))
        );

        if ($id == 'new') {
            $actions = new FieldSet(
                    $save =  new FormAction('DoSaveSocial',_t('Socializer.SAVE'))
            );
        } else {
            $actions = new FieldSet(
                    $del = new FormAction('DoDeleteSocial',_t('Socializer.DELETE')),
                    $update = new FormAction('DoUpdateSocial',_t('Socializer.UPDATE'))
            );
        }
        $form = new Form($this,'EditForm', $fields, $actions);

        if ($id != 'new') {
            $currentLink = DataObject::get_by_id( 'Socializer_items', $id );
            $form->loadDataFrom(array(
                    'ID' => $currentLink->ID,
                    'Service' => $currentLink->Service,
                    'Name' => $currentLink->Name,
                    'Url' => $currentLink->Url,
                    'Title' => $currentLink->Title
            ));
        }
        return $form;
    }

    function DoDeleteSocial($data,$form) {
        $id = $_REQUEST['ID'];

        $social = DataObject::get_one('Socializer_items',"Socializer_items.ID=$id");
        $social->Status = _t('Socializer.DELETESTATUS');
        $social->delete();
        FormResponse::status_message(_t('Socializer.DELETEITEM'),'good');
        FormResponse::update_status($social->Status);
        $response = $this->deleteTreeNodeJS($social);
        FormResponse::add($response);

        return FormResponse::respond();
    }

    function DoUpdateSocial($data,$form) {
        $id = $_REQUEST['ID'];

        $social = DataObject::get_one('Socializer_items',"Socializer_items.ID=$id");
        $social->Status= _t('Socializer.UPDATESTATUS');
        $form->saveInto($social);
        if ($social->write()) {
            FormResponse::status_message(_t('Socializer.UPDATEITEM'),'good');
            FormResponse::update_status($social->Status);
            FormResponse::set_node_title($id, $social->Name);
            FormResponse::get_page($id);
            Session::set('currentSocializerPage',$id);
        } else {
            FormResponse::status_message(_t('Socializer.FAILNEWITEM'), 'bad');
        }
        return FormResponse::respond();
    }

    function DoSaveSocial($data,$form) {
        $social = new Socializer_items();
        $social->Status = _t('Socializer.SAVESTATUS');
        $form->saveInto($social);
        if ($social->write()) {
            FormResponse::status_message(_t('Socializer.SAVENEWITEM'),'good');
            FormResponse::update_status($social->Status);
            $title = Convert::raw2js($social->Name);
            $response = <<<JS
            var newNode = $('sitetree').createTreeNode($social->ID,"$title","$social->class");
            $('sitetree').appendTreeNode(newNode);
JS;
            FormResponse::add($response);
            Session::set('currentSocializerPage',$social->ID);
            FormResponse::get_page($social->ID);
        } else {
            FormResponse::status_message(_t('Socializer.FAILNEWITEM'), 'bad');
        }
        return FormResponse::respond();

    }

    function Link($action = null) {
        return "admin/socializer/$action";
    }

    public function SiteTreeAsUL() {
        $siteTree = "";
        $Socializer = DataObject::get("Socializer_items");
        if ($Socializer) {
            foreach($Socializer as $ID => $data) {
                $siteTree .= "<li id=\"record-" . $data->ID . "\" class=\"" . $data->class . " " .
                        ($data->Locked ? " nodelete" : "") . "\" >" .
                        "<a href=\"" . Director::baseURL() . 'admin/socializer/show/' .  $data->ID . "\" >" . $data->Name . "</a>";
            }
        }

        $siteTree = "<ul id=\"sitetree\" class=\"tree unformatted\">" .
                "<li id=\"record-0\" class=\"Root nodelete\">" .
                "<a href=\"admin/socializer/show/0\" ><strong>"._t('Socializer.ROOT')."</strong></a>"
                . $siteTree .
                "</li>" .
                "</ul>";
        return $siteTree;
    }

    public function addlink() {
        $id = $_REQUEST['ID'];
        FormResponse::add("$('Form_EditForm').getPageFromServer('$id');");
        return FormResponse::respond();
    }



}

class Socializer_items extends DataObject {

    public static $db = array(
            'Service' => 'Varchar(255)',
            'Name'    => 'Varchar(255)',
            'Url'	  => 'Varchar(255)',
            'Title'	  => 'Varchar(255)'
    );
}
//TODO: Settings on id=0

/*class Socializer_settings extends DataObject {
    public static $db = array (
        'Theme' => 'Varchar(255)',
        'Size'  => 'Varchar(255)',
        'Send2Friend' => 'Boolean',
        'PrintThis'   => 'Boolean'
        );

}
*/
?>