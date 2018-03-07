<? 
include ("../../dbConfig.php");
include ("db.php");
class parentClass {
    var $ParentID = "";
    var $UserID = "";
    var $Firstname = "";
    var $Surname = "";
    var $Email = "";
    var $Address = "";
    var $dbCon;
    
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
        if ($result = $this->dbCon->query("SELECT ParentID, UserID, Firstname, Surname, Email, Address FROM ParentDetails WHERE UserID = '$userID'")) {
        
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $this->ParentID = $row["ParentID"];
            $this->UserID = $row["UserID"];
            $this->Firstname = $row["Firstname"];
            $this->Surname = $row["Surname"];
            $this->Email = $row["Email"];
            $this->Address = $row["Address"];

            $result->close();
        }
        
        /* close connection */
        $this->dbCon->close();

    }
}

?>