<?php

namespace Sessoes\Form;

use Zend\Form\Form;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Element\TextArea;
use Zend\Form\Element\Submit;

class SessoesForm extends Form
{
    public function __construct()
    {
        parent::__construct('sessoes', []);

        $this->add(new Hidden('id'));
        $this->add(new Text('name', ['label' => 'Nome da sessão',]));
        $this->add(new TextArea('description', ['label' => 'Descrição / Observações']));

        $this->add(new Text('server', ['label' => 'Servidor:porta']));
        $this->add(new Text('sessionkey', ['label' => 'Chave da sessão (sessionkey)']));
        $this->add(new Text('session', ['label' => 'Aparelho (sessioname)']));
        $this->add(new Text('apitoken', ['label' => 'API Token (apitoken)']));

        //$this->add(new \Text('status'));
        $this->add(new Text('wh_status', ['label' => 'Webhook status']));
        $this->add(new Text('wh_message', ['label' => 'Webhook mensagens']));
        $this->add(new Text('wh_qrcode', ['label' => 'Webhook QR Code']));
        $this->add(new Text('wh_connect', ['label' => 'Webhook conexão']));

        $submit = new Submit('submit');
        $submit->setAttributes(['value' => 'Salvar sessão', 'class' => 'btn btn-primary float-end', 'id' => 'submit']);
        $this->add($submit);
    }

}