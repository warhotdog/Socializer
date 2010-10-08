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
                "Show Share Icons on this page ?"
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
                    'Title' => 'Invitar a un amigo'
                    )));
        }
        if (SocializerAdmin::get_PrintPage()) {
            $ob->push(new ArrayData(array(
                'Service' => 'print',
                'Name'  => 'PrintPage',
                'Url'   => 'javascript:void(0);" onclick="window.print()"',
                'Title' => 'Imprimir'
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

                break;
            case 'Prototype':
                break;
            default:
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
               Requirements::javascript(THIRDPARTY_PATH . "/jquery/jquery-packed.js");
               Requirements::javascript(SOCIALIZERPATH.'/javascript/fancybox/jquery.mousewheel-3.0.2.pack.js');
               Requirements::javascript(SOCIALIZERPATH.'/javascript/fancybox/jquery.fancybox-1.3.1.js');
               Requirements::css(SOCIALIZERPATH.'/javascript/fancybox/jquery.fancybox-1.3.1.css');
               break;
           case 'Prototype':
               Requirements::javascript(THIRDPARTY_PATH . 'prototype/prototype.js');
               Requirements::javascript(THIRDPARTY_PATH . 'scriptaculous/scriptaculous.js?load=effects');
               Requirements::javascript(SOCIALIZERPATH . '/javascript/modalbox/modalbox.js');
               Requirements::css(SOCIALIZERPATH . '/javascript/modalbox/modalbox.css' );
           default:
               //Nothing
               break;
       }
       return $this->owner->renderWith('SocializerComplex');
    }

}
?>