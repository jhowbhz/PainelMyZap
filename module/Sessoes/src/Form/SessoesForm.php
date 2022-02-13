<?php

namespace Sessoes\Form;
use \Zend\Form\Element;
class SessoesForm extends \Zend\Form\Form
{
    public function __construct()
    {
        parent::__construct('sessoes', []);

        $this->add(new Element\Hidden('id'));
        $this->add(new Element\Text('name', ['label' => 'Nome da sessão',]));
        $this->add(new Element\TextArea('description', ['label' => 'Descrição / Observações']));

        $this->add(new Element\Text('server', ['label' => 'Servidor:porta']));
        $this->add(new Element\Text('sessionkey', ['label' => 'Chave da sessão (sessionkey)']));
        $this->add(new Element\Text('session', ['label' => 'Aparelho (sessioname)']));
        $this->add(new Element\Text('apitoken', ['label' => 'API Token (apitoken)']));

        //$this->add(new \Text('status'));
        $this->add(new Element\Text('wh_status', ['label' => 'Webhook status']));
        $this->add(new Element\Text('wh_message', ['label' => 'Webhook mensagens']));
        $this->add(new Element\Text('wh_qrcode', ['label' => 'Webhook QR Code']));
        $this->add(new Element\Text('wh_connect', ['label' => 'Webhook conexão']));

        $submit = new Element\Submit('submit');
        $submit->setAttributes(['value' => 'Salvar sessão', 'class' => 'btn btn-primary float-end', 'id' => 'submit']);
        $this->add($submit);
    }

}