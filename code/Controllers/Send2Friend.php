<?php
class Send2Friend_Controller extends Page_Controller {
    var $owner;
    public static $url_handlers = array(
            'send2friend/$Action/$ID/$OtherID' => 'index'
    );

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
    public function forTemplate() {
        if ($this->isAjax) {
        return $this->renderWith(array('Page','Send2Friend'));
        } else {
        return $this->renderWith('Send2Friend');
        }
    }
    
    public function ref(){
        return isset($_REQUEST['ref'])?$_REQUEST['ref']:$this->owner->BaseHref();
    }

    public function SendFriendForm(){
        $fields = new FieldSet(
                new EmailField('From','De'),
                new EmailField('To','Para'),
                new HiddenField('ref','ref',$this->ref())
                );
        $actions = new FieldSet(
                new FormAction('DoSend','Enviar')
                //new FormAction('Cerrar','Cerrar')
                );
        $form = new Form($this,'SendFriendForm',$fields,$actions);
        return $form;
    }

    public function DoSend($data,$form) {


        print_r($data);
        $from = $data['From'];
        $to = $data['To'];
        $subject = '';
        $body = '';


        $mail = new Email($from, $to, $subject, $body);
        $mail->setTemplate('Send2Friend');
        $mail->populateTemplate(array(
            'Ref' => $data['ref']
        ));
        //$mail->send();
    }

}
