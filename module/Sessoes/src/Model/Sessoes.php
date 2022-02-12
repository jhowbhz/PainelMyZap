<?php

namespace Sessoes\Model;

use Zend\Stdlib\ArraySerializableInterface;

class Sessoes implements ArraySerializableInterface
{

    private $id;
    private $name;
    private $description;
    private $sessionkey;
    private $server;
    private $apitoken;
    private $status;
    private $session;
    private $wh_status;
    private $wh_message;
    private $wh_qrcode;
    private $wh_connect;

    public function exchangeArray(array $data)
    {

        // define os atributos do objeto
        $this->id = !empty($data['id']) ? $data['id'] : null;
        
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->description = !empty($data['description']) ? $data['description'] : null;
        
        $this->server = !empty($data['server']) ? $data['server'] : null;
        $this->apitoken = !empty($data['apitoken']) ? $data['apitoken'] : null;
        $this->sessionkey = !empty($data['sessionkey']) ? $data['sessionkey'] : null;
        $this->session = !empty($data['session']) ? $data['session'] : null;
        $this->status = !empty($data['status']) ? $data['status'] : null;

        $this->wh_status = !empty($data['wh_status']) ? $data['wh_status'] : null;
        $this->wh_message = !empty($data['wh_message']) ? $data['wh_message'] : null;
        $this->wh_qrcode = !empty($data['wh_qrcode']) ? $data['wh_qrcode'] : null;
        $this->wh_connect = !empty($data['wh_connect']) ? $data['wh_connect'] : null;

    }

    // metodos getters e setters
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function getServer(){
        return $this->server;
    }
    public function setServer($server){
        $this->server = $server;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function getApitoken(){
        return $this->apitoken;
    }
    public function setApitoken($apitoken){
        $this->apitoken = $apitoken;
    }
    public function getSessionkey(){
        return $this->sessionkey;
    }
    public function setSessionkey($sessionkey){
        $this->sessionkey = $sessionkey;
    }
    public function getSession(){
        return $this->session;
    }
    public function setSession($session){
        $this->session = $session;
    }
    public function getWh_status(){
        return $this->wh_status;
    }
    public function setWh_status($wh_status){
        $this->wh_status = $wh_status;
    }
    public function getWh_message(){
        return $this->wh_message;
    }
    public function setWh_message($wh_message){
        $this->wh_message = $wh_message;
    }
    public function getWh_qrcode(){
        return $this->wh_qrcode;
    }
    public function setWh_qrcode($wh_qrcode){
        $this->wh_qrcode = $wh_qrcode;
    }
    public function getWh_connect(){
        return $this->wh_connect;
    }
    public function setWh_connect($wh_connect){
        $this->wh_connect = $wh_connect;
    }

    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'sessionkey' => $this->sessionkey,
            'server' => $this->server,
            'apitoken' => $this->apitoken,
            'status' => $this->status,
            'session' => $this->session,
            'wh_status' => $this->wh_status,
            'wh_message' => $this->wh_message,
            'wh_qrcode' => $this->wh_qrcode,
            'wh_connect' => $this->wh_connect,
        ];
    }

}