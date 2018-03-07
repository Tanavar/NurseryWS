<?
class manageUserClass {
    var $rows;
    
    function __construct(){
    $db = new db();
    $this->dbCon = new mysqli("localhost", $db->userName, $db->passWord, $db->dataBase);
        /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    }
    
         function getParentData()
    {
    
        if ($result = $this->dbCon->query("SELECT UM.UserID, PD.FirstName, PD.Surname, PD.Email, PD.Address, UM.UserType FROM UserMaster UM INNER JOIN ParentDetails PD ON UM.UserID = PD.UserID ")) {

        while($row = $result->fetch_row()) {
            $this->rows[]=$row;
      
        }
 
    
    }
    }
    
    function getAdminData()
    {
        if ($result = $this->dbCon->query("SELECT * FROM AdminDetails AD
        WHERE UserID = '$userID'")) {

        $row = $result->fetch_assoc(); 
        $this->adminName = $row["FirstName"] . ' ' . $row["Surname"];
    
    }
    }
    
        function getAdminUsers()
    {
        if ($result = $this->dbCon->query("SELECT * FROM AdminDetails AD")) {

        while($row = $result->fetch_row()) {
            $this->rows[]=$row;
      
        }
    
    }
    }
}
?>