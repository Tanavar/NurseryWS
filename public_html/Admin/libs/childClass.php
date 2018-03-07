<?
class childClass {
    var $childID = "";
    var $parentID = "";
    var $firstname = "";
    var $dbCon;
    var $rows;
    
    var $surname;
    var $dateOfBirth;
    var $gender;
    var $startDate;
    var $allocatedRoom;
    var $allergies;
    var $notes;
    
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
        if ($result = $this->dbCon->query("SELECT CD.ChildID, CD.ParentID, PD.UserID, CD.FirstName, CD.Surname, CD.DateOfBirth, CD.Gender, CD.StartDate, CD.AllocatedRoom, CD.Allergies, CD.Notes FROM ChildDetails CD
        INNER JOIN ParentDetails PD ON CD.ParentID = PD.ParentID WHERE PD.UserID = '$userID'")) {
        
        while($row = $result->fetch_row()) {
             $this->rows[]=$row;
            }
//$this->row=mysqli_fetch_array($result,MYSQLI_ASSOC);


            $result->close();
        }
        
        /* close connection */
        $this->dbCon->close();

    }
    
    function saveData()
    {
        $updateStatment = " ";
        $updateStatment .= " FirstName = '{$this -> firstname}'";
        $updateStatment .= ", Surname = '{$this -> surname}' ";
        $updateStatment .= ", DateOfBirth = '{$this -> dateOfBirth}'";
        $updateStatment .= ", Gender = '{$this -> gender}'";
        $updateStatment .= ", StartDate = '{$this -> startDate}'";
        $updateStatment .= ", AllocatedRoom = '{$this -> allocatedRoom}'";
        $updateStatment .= ", Allergies = '{$this -> allergies}'";
        $updateStatment .= ", Notes = '{$this -> notes}'";
                $this -> dbCon->query("UPDATE ChildDetails SET {$updateStatment} Where ChildID = '{$this -> childID}'");
    }
    
}

?>