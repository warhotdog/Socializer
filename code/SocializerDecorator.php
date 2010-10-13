<?php 
class SocializerDecorator extends DataObjectDecorator {

    function extraStatics() {
        return array(
                'db' => array(
                        'SocializerDecorator' => 'Boolean'
                )
        );
    }
    function updateCMSFields(FieldSet &$fields) {
        $fields->addFieldToTab("Root.Behaviour",
                new CheckboxField(
                "SocializerDecorator",
                _t('SocializerDecorator.SHOWICONS')
                ),'ShowInMenus');
        return $fields;
    }
}

class Socializer extends Extension {

    public function getSocialItems() {
        $A_obj = DataObject::get('Socializer_items');

        $ob = new DataObjectSet();
        $curr = $this->owner;
        foreach($A_obj as $obj) {
            $obj->Url = str_ireplace('$page_url',  Director::absoluteURL($curr->Link()),$obj->Url);
            $obj->Url = str_ireplace('$page_title', $curr->Title,$obj->Url);
            $ob->push($obj);
        }
        if (SocializerAdmin::get_InviteFriendEmail()){
            $ob->push(new ArrayData(array(
                    'Service' => 'email',
                    'Name'  => 'Send2Friend',
                    'Url'   =>  $curr->BaseHref() . 'send2friend',
                    'Title' => _t('SocializerDecorator.INVITEFRIEND')
                    )));
        }
        if (SocializerAdmin::get_PrintPage()) {
            $ob->push(new ArrayData(array(
                'Service' => 'print',
                'Name'  => 'PrintPage',
                'Url'   => 'javascript:void(0);" onclick="window.print()"',
                'Title' => _t('SocializerDecorator.PRINT')
            )));
        }

        return $ob?$ob:false;
    }

    public function getSocializerTheme(){
        return Director::absoluteURL( SOCIALIZERPATH .
                "/images/" .
                SocializerAdmin::get_SocializerTheme() .
                "/" .
                SocializerAdmin::get_SocializerThemeSize() .
                "/");
    }


    public function SocializerBar() {
       if (SocializerAdmin::get_SimpleSocializer()) {
           return $this->SocializerSimple();
       } else {
           return $this->SocializerComplex();
       }
    }

    public function SocializerSimple() {
        $sitetree = $this->owner;
        if ($sitetree->SocializerDecorator) {
            return  $this->owner->renderWith('Socializer');
        }
    }

    public function getSocializerItemAction(){
        switch (SocializerAdmin::get_LibraryUse()) {
            case 'MT':
                $action = 'rel="lightbox[send2friend 400 205]"';
                break;
            case 'JQuery':
                $action = 'id="send2friend" '; //suck JQuery i cant add onclick  i can do?
                break;
            case 'Prototype':
                $action = 'id="send2friend"'; //'onclick="Modalbox.show(this.href, {title: this.title, width: 400}); return false;"';

                break;
            default:
                $action = 'id="send2friend"';
                break;
        }
        return $action;
    }
    public function SocializerComplex() {
        
       switch (SocializerAdmin::get_LibraryUse()) {
           case 'MT':
               Requirements::javascript(SOCIALIZERPATH."/javascript/mediaboxAdvance/mootools-1.2.4-core.js");
               Requirements::javascript(SOCIALIZERPATH."/javascript/mediaboxAdvance/mediaboxAdv-1.3.1b.js");
               Requirements::css(SOCIALIZERPATH."/javascript/mediaboxAdvance/mediaboxAdvBlack21.css");
               break;
           case 'JQuery':
               //Requirements::javascript(THIRDPARTY_DIR . "/jquery/jquery.js");
               Requirements::javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js');
               Requirements::javascript(SOCIALIZERPATH.'/javascript/fancybox/jquery.mousewheel-3.0.2.pack.js');
               Requirements::javascript(SOCIALIZERPATH.'/javascript/fancybox/jquery.fancybox-1.3.1.js');
               Requirements::css(SOCIALIZERPATH.'/javascript/fancybox/jquery.fancybox-1.3.1.css');
               Requirements::customScript('jQuery(document).ready(function() { var s2f =  $("#send2friend").fancybox({"width":400, "height":205, "type":"iframe" });});');
               
               break;
           case 'Prototype':
               //Requirements::javascript(THIRDPARTY_DIR . '/prototype/prototype15.js');
               Requirements::javascript('http://ajax.googleapis.com/ajax/libs/prototype/1.6.1.0/prototype.js');
               Requirements::javascript('http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.3/scriptaculous.js?load=effects');
                Requirements::javascript('http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.3/effects.js');
               // Requirements::javascript(THIRDPARTY_DIR . '/scriptaculous/scriptaculous.js?load=effects');
               Requirements::javascript(SOCIALIZERPATH . '/javascript/modalbox/modalbox.js');
               Requirements::css(SOCIALIZERPATH . '/javascript/modalbox/modalbox.css' );
           default:
               //Nothing
               break;
       }
       Requirements::javascript(SOCIALIZERPATH . '/javascript/closebox.js');
       return $this->owner->renderWith('SocializerComplex');
    }

}
?>