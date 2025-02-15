<?php

include('../../../connection/connection.php');

class smartBox extends DBController
{
    function myAccountAdmin($user_id)
    {
       $query = "CALL smart_LockerAccountSessionAdmin (?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $user_id
            )
        );
        
        $accountCredentials = $this->getDBResult($query, $params);
        return $accountCredentials;
    }

    function lockers()
    {
        $query = "CALL smart_lockerView";
        $locker = $this->getDBResult($query);
        return $locker;
    }

    function smartReport()
    {
        $query = "CALL smart_ReportView";
        $report = $this->getDBResult($query);
        return $report;
    }

    function ActiveRentals()
    {
        $query = "CALL ActiveRentals";
        $activeRental = $this->getDBResult($query);
        return $activeRental;
    }

    function smart_profits()
    {
        $query = "CALL smart_profits";
        $activeProfits = $this->getDBResult($query);
        return $activeProfits;
    }

    function smart_rents()
    {
        $query = "CALL smart_rents";
        $activeRents = $this->getDBResult($query);
        return $activeRents;
    }

    function smart_users()
    {
        $query = "CALL smart_usersAdmin";
        $activeUser = $this->getDBResult($query);
        return $activeUser;
    }

    function smart_checkLogs() 
    {
        $query = "CALL smart_checkLogs";
        $activeUserLogs = $this->getDBResult($query);
        return $activeUserLogs;
    }

    function smart_usershistory($user_id)
    {
        $query = "CALL smart_usershistory (?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $user_id
            )
        );
        
        $accountHistoryCredentials = $this->getDBResult($query, $params);
        return $accountHistoryCredentials;
    }

     //GRAPH
     function smart_reportViewGraph()
     {
         $query = "CALL smart_reportViewGraph()";
         $graphResult = $this->getDBResult($query);
         return $graphResult;
     }
     //GRAPH
}

$portCont = new smartBox();


?>