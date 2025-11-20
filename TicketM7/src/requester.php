<?php
#[\AllowDynamicProperties]

class Requester{
    
    public $id = null;
    
    public $name = '';

    public $email = '';

    public $phone = '';

    private $db = null;


    public function __construct($data = null) 
    {
        $this->name = isset($data['name']) ? $data['name'] :null ;
        $this->email = isset($data['email']) ? $data['email'] : null ;
        $this->phone = isset($data['phone']) ? $data['phone'] : null ;
        
        $this->db = Database::getInstance();

        return $this;
    }
    
    public static function find($id) : Requester
    {
        $sql ="SELECT * FROM tblrequester WHERE id = '$id'";
        $self = new static;
        $res = $self->db->query($sql);
        if($res->num_rows < 1) return $self;//return false;
        $self->populateObject($res->fetch_object());
        return $self;
    }
    public function populateObject($object) : void
    {

        foreach($object as $key => $property){
            $this->$key = $property;
        }
    }



}
