<?
class adminClass {
    var $adminName = "";
    
    function __construct(){
    $db = new db();
    $this->dbCon = new mysqli("localhost", $db->userName, $db->passWord, $db->dataBase);
        /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    }
    
         function getData($userID)
    {
        if ($result = $this->dbCon->query("SELECT * FROM AdminDetails AD
        WHERE UserID = '$userID'")) {

        $row = $result->fetch_assoc(); 
        $this->adminName = $row["FirstName"] . ' ' . $row["Surname"];
    
    }
    }
}
?>