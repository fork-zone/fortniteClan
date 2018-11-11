<?php
$servername = "localhost";
$username = "rickybobby";
$password = "Booty123call!";
$dbname = "fortniteclan";
$key = '6Ld_H3cUAAAAAGpJfvK5G_y7LFeQqOqMqLFtaZgk';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

Class Query {

    public $conn,$no_of_records_per_page,$pageno,$offset;

    function __construct() {
        $this->conn = new mysqli('localhost', 'rickybobby', 'Booty123call!', 'fortniteclan');
        $this->no_of_records_per_page = 12;
        $this->pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;
        $this->offset = ($this->pageno-1) * $this->no_of_records_per_page;
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

    public function clansByNum() {
        $sql = "SELECT COUNT(*) FROM clans";
        $result = $this->conn->query($sql);
        return mysqli_fetch_array($result)[0];
    }

    public function usersByNum() {
        $sql ="SELECT COUNT(*) FROM users";
        $result = $this->conn->query($sql);
        return mysqli_fetch_array($result)[0];
    }

    public function featuredByNum() {
        $sql ="SELECT COUNT(*) FROM clans WHERE featured = 1";
        $result = $this->conn->query($sql);
        return mysqli_fetch_array($result)[0];
    }

    public function clansLimited() {

        $total_pages_sql = "SELECT COUNT(*) FROM clans";

        $total_pages_result = mysqli_query($this->conn,$total_pages_sql);

        $total_rows = mysqli_fetch_array($total_pages_result)[0];

        $total_pages = ceil($total_rows / $this->no_of_records_per_page);

        $sql = "SELECT * FROM clans LIMIT $this->offset, $this->no_of_records_per_page";

        return $this->conn->query($sql);
    }

    public function usersLimited() {

        $total_pages_sql = "SELECT COUNT(*) FROM users";

        $total_pages_result = mysqli_query($this->conn,$total_pages_sql);

        $total_rows = mysqli_fetch_array($total_pages_result)[0];

        $total_pages = ceil($total_rows / $this->no_of_records_per_page);

        $sql = "SELECT * FROM users";

        return $this->conn->query($sql);
    }

}
?>
