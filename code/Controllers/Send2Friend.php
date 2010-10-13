<?php
class Send2Friend_Controller extends Page_Controller {
    var $owner;
    
    public function init() {
        $this->owner = $this;
        if(Director::is_ajax()) {
            $this->isAjax = true;
        }
        else {
            $this->isAjax = false;
        }
        parent::init();
    }
    public function Link($action = null) {
        return "send2friend/$action";
    }
    public function ref(){
        return isset($_REQUEST['ref'])?$_REQUEST['ref']:$this->owner->BaseHref();
    }
    public function Iframe(){
        Requirements::clear();
        Requirements::css(SOCIALIZERPATH . '/css/Iframe.css');
        Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js'); 
        Requirements::javascript(SOCIALIZERPATH."/javascript/FormSubmit.js");
        return $this->renderWith('Iframe');
    }
    public function getSendFriendForm(){
        $fields = new FieldSet(
                new EmailField('From','De'),
                new EmailField('To','Para'),
                new HiddenField('ref','ref',$this->ref())
                );
        $actions = new FieldSet(
                new FormAction('DoSend','Enviar')
                //new FormAction('Cerrar','Cerrar')
                );
        $validator = new RequiredFields('From','To');
        $form = new Form($this,'DoSend',$fields,$actions,$validator);
        //$form->forAjaxTemplate();
        return $form->forAjaxTemplate();
    }

    public function DoSend($data) {

        $from = $data['From'];
        $to = $data['To'];
        $subject = '';
        $body = '';


        $mail = new Email($from, $to, $subject, $body);
        $mail->setTemplate('Send2Friend');
        $mail->populateTemplate(array(
            'Ref' => $data['ref']
        ));
        $mail->send();
        FormResponse::update_dom_id('Form_DoSend_error', '<div>Enviado..</div>');
        FormResponse::add(' window.setTimeout("parent.s2fclose();",3000);'."\n\r");
        
        //Director::redirectBack();
        return FormResponse::respond();

    }

}