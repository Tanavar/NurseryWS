<?
class TTClass {
    var $periodName = "";
    var $startDate = "";
    var $endDate = "";
    var $rows;
    var $dates;
    
    function __construct(){
    $db = new db();
    $this->dbCon = new mysqli("localhost", $db->userName, $db->passWord, $db->dataBase);
        /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    }
    
         function getData()
    {
                if ($result = $this->dbCon->query("SELECT TimetableID, PeriodName, StartDate, EndDate, Locked FROM TimeTablePeriods")) {
        
        while($row = $result->fetch_row()) {
             $this->rows[]=$row;
            }
           
    
         }
    }
    
             function getNonLockedData()
    {
                if ($result = $this->dbCon->query("SELECT TimetableID, PeriodName, StartDate, EndDate, Locked FROM TimeTablePeriods WHERE Locked = 0")) {
        
        while($row = $result->fetch_row()) {
             $this->rows[]=$row;
            }
           
    
         }
    }
    
    function storePeriod($periodName, $periodStart, $periodEnd)
    {
        $query = "INSERT INTO TimeTablePeriods (PeriodName, StartDate, EndDate) VALUES ('$periodName','$periodStart','$periodEnd')";
            
        $this->dbCon->query($query);
    }
    
        function runScript($query)
    {
        $this->dbCon->query($query);
    }
    
    function getDates($ttid)
    {
        if ($result = $this->dbCon->query("SELECT TimetableID, PeriodName, StartDate, EndDate, Locked FROM TimeTablePeriods WHERE TimeTableID = '$ttid'"))
        
        while($row = $result->fetch_assoc()) {
       // echo $row["PeriodName"];
         $this -> dates = array(new DateTime($row["StartDate"])
         , new DateTime($row["EndDate"]));
    }
      /*  $this -> dates = array( new DateTime( '2017-03-01' ), new DateTime( '2017-04-01' ));
   */
    }
}
?>