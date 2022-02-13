<?php

namespace Sessoes\Form;
class SessoesForm extends \Zend\Form\Form
{
    public function __construct()
    {
        parent::__construct('sessoes', []);

        $this->add(new \Zend\Form\Element\Hidden('id'));
        $this->add(new \Zend\Form\Element\Text('name', ['label' => 'Nome da sessão',]));
        $this->add(new \Zend\Form\Element\TextArea('description', ['label' => 'Descrição / Observações']));

        $this->add(new \Zend\Form\Element\Text('server', ['label' => 'Servidor:porta']));
        $this->add(new \Zend\Form\Element\Text('sessionkey', ['label' => 'Chave da sessão (sessionkey)']));
        $this->add(new \Zend\Form\Element\Text('session', ['label' => 'Aparelho (sessioname)']));
        $this->add(new \Zend\Form\Element\Text('apitoken', ['label' => 'API Token (apitoken)']));

        //$this->add(new \Text('status'));
        $this->add(new \Zend\Form\Element\Text('wh_status', ['label' => 'Webhook status']));
        $this->add(new \Zend\Form\Element\Text('wh_message', ['label' => 'Webhook mensagens']));
        $this->add(new \Zend\Form\Element\Text('wh_qrcode', ['label' => 'Webhook QR Code']));
        $this->add(new \Zend\Form\Element\Text('wh_connect', ['label' => 'Webhook conexão']));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(['value' => 'Salvar sessão', 'class' => 'btn btn-primary float-end', 'id' => 'submit']);
        $this->add($submit);
    }

}