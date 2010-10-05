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

    function getSocialItems() {
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
                    'Service' => 'mail',
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

    function SocializerSimple() {
        $sitetree = $this->owner;
        if ($sitetree->SocializerDecorator) {
            return  $this->owner->renderWith('Socializer');
        }
    }
}

?>