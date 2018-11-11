<?php

Class Query {

    public $conn;

    function __construct() {
        $this->conn = new mysqli('localhost', 'xxx', 'xxx', 'fortniteclan');
    }
    
    public function featuredClans() {
        $sql = "SELECT * FROM clans WHERE featured = 1";
        return $this->conn->query($sql);
    }

    public function regularClans() {
        $sql = "SELECT * FROM clans";
        return $this->conn->query($sql);
    }

    public function singleClan($id) {
        $sql = "SELECT * FROM clans WHERE id = $id";
        return $this->conn->query($sql);
    }

}

$query = new Query;
$fcquery = $query->featuredClans();
$rcquery = $query->regularClans();

while ($row = $fcquery->fetch_assoc()):
    echo $row['name'].'<br />';
endwhile;

echo '<br />';

while ($row = $rcquery->fetch_assoc()):
    echo $row['name'].'<br />';
endwhile;

?>