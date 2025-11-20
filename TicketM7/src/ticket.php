<?php

#[\AllowDynamicProperties]
class Ticket
{

    public $title = '';

    public $body = '';

    public $requester = null;

    public $team = null;

    public $team_member = null;

    public $status = '';
    
    public $attachment = '';


    private $db = null;

    public function __construct($data = null)
    {
        $this->title =  isset($data['title']) ? $data['title'] : null;
        $this->body = isset($data['body']) ? $data['body'] : null;
        $this->requester = isset($data['requester']) ? $data['requester'] : null;
        $this->team = isset($data['team']) ? $data['team'] : null;
        $this->team_member = isset($data['team_member']) ? $data['team_member'] : null;
        $this->status = isset($data['status']) ? $data['status'] : 'inprogress';
        $this->attachment = isset($data['attachment']) ? $data['attachment'] : null;

        $this->db = Database::getInstance();

        return $this;
    }


    
    public static function findAll(): array
    {
        $sql = "SELECT * FROM tblticket where deleted_at IS NULL ORDER BY id DESC ";
         //echo "<br>sql=".$sql."<br>";
         //die();
        $tickets = [];
        $self = new static;
        $res = $self->db->query($sql);

        if ($res->num_rows < 1) {
            return new static;
        }

        while ($row = $res->fetch_object()) {
            $ticket = new static;
            $ticket->populateObject($row);
            $tickets[] = $ticket;
        }
        // echo "<br>tickets=".$tickets."<br>";
       //  die();

        return $tickets;
    }

    public static function find($id): Ticket
    {
        $sql = "SELECT * FROM tblticket WHERE id = '$id' and deleted_at IS NULL ";
        //echo "<br>sql=".$sql."<br>";
        //die();
        $self = new static;
        $res = $self->db->query($sql);
        if ($res->num_rows < 1) {
            return $self;
            //return false;
        }

        $self->populateObject($res->fetch_object());
        return $self;
    }
     public function update($id): Ticket
    {

   /* print_r("title=".$this->title."<br>");             */

        $sql = "UPDATE tblticket set `team_member` = '$this->team_member', `title` = '$this->title',`body` = '$this->body',
         `requester`='$this->requester', `team`= '$this->team', `status`= '$this->status'
          Where id = '$id'";

        if ($this->db->query($sql) === false) {
            throw new Exception($this->db->error);
        }

        return self::find($id);

    }
    public function populateObject($object): void
    {

        foreach ($object as $key => $property) {
            $this->$key = $property;
        }
    }

      public static function findByMember($member)
     {

        $sql = "SELECT * FROM tblticket WHERE team_member = '$member' ORDER BY id DESC";
        //echo "<br>sql=".$sql."<br>";
        $self = new static;
        $tickets = [];
        $res = $self->db->query($sql);

        while($row = $res->fetch_object()){
            $ticket = new static;
            $ticket->populateObject($row);
            $tickets[] = $ticket;
        }

        return $tickets;

     }

     public static function delete($id): bool
    {
        $self = new static;
        $date = date("Y-m-d H:i:s");
        $sql = "UPDATE tblticket set deleted_at = '".$date."' Where id = '$id'";
        $stmt = $self->db->query($sql);

       return true;
    }
    
     public function displayStatusBadge(): string
     {
        $badgeType = '';
        if ($this->status == 'inprogress') {
            $badgeType = 'danger';
        } else if ($this->status == 'pending') {
            $badgeType = 'warning';
        } else if ($this->status == 'completed') {
            $badgeType = 'success';
        } else if ($this->status == 'onhold') {
            $badgeType = 'info';
        }

        return '<div class="badge badge-' . $badgeType . '" role="badge"> ' . ucfirst($this->status) . '</div>';
    }

    public function save(): Ticket
    {
           //echo "<br>att=".$this->attachment."<br>";
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblticket (title, body, requester,created_at,attachment)
                VALUES ('$this->title', '$this->body', '$this->requester','$date','$this->attachment')";

        if ($this->db->query($sql) === false) {
            throw new Exception($this->db->error);
        }
        $id = $this->db->insert_id;
        return self::find($id);

        //return true;
    }

}
