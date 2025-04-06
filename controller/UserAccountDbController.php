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

    function payment_transaction()
    {
        $query = "CALL smart_ReportPaymentTransaction";
//         $query = "SELECT SR.name as name, SR.email as email, SR.phone as phone, SL.locker as locker, SR.price as price, SRP.src_link as reference, SRP.created_date as date_created, SR.session as session FROM smart_report SR
// LEFT JOIN smart_reportpayment SRP ON SR.account_id = SRP.account_id
// LEFT JOIN smart_locker SL ON SL.id = SR.locker_id;";
        $paymentTrans = $this->getDBResult($query);
        return $paymentTrans;
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

    function addLocker($locker, $size, $dimension, $status, $price)
    {
        $query = "CALL smart_CreatingLocker(?,?,?,?,?)";
        
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $locker
            ),
            array(
                "param_type" => "s",
                "param_value" => $size
            ),
            array(
                "param_type" => "s",
                "param_value" => $dimension
            ),
            array(
                "param_type" => "s",
                "param_value" => $status
            ),
            array(
                "param_type" => "s",
                "param_value" => $price
            )
        );
        
        $accountHistoryCredentials = $this->getDBResult($query, $params);
        return $accountHistoryCredentials;
    }

    function updateLockerPrice($id, $price)
    {
        $query = "CALL smart_lockerUpdate(?,?)";
        
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $price
            ),
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );
        
        $accountHistoryCredentials = $this->getDBResult($query, $params);
        return $accountHistoryCredentials;
    }

    function deleteLocker($id)
    {
        $query = "CALL smart_LockerDelete(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id
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