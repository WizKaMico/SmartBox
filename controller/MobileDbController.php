<?php
include('../../../connection/connection.php');

class smartBox extends DBController
{

     //MOBILE
     function specificAccountLockerCredentials($account_id, $pin)
    {
        $query = "CALL smart_lockercredentialsSpecificView(?,?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $pin
            )
        );

        $accountLockerResultCredentials = $this->getDBResult($query, $params);
        return $accountLockerResultCredentials;
    }

    function specificAccountLogin($pin)
    {
        $query = "CALL smart_reportLoginLocker(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $pin
            )
        );

        $accountLockerResultCredentials = $this->getDBResult($query, $params);
        return $accountLockerResultCredentials;
    }

    function myAccount($account_id)
    {
       $query = "CALL smart_LockerAccountSession (?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            )
        );
        
        $accountCredentials = $this->getDBResult($query, $params);
        return $accountCredentials;
    }

    function myAccount_terms($account_id, $terms)
    {
        
        $query = "CALL smart_lockerCredentialUpdateTerms(?,?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            ),
            array(
                "param_type" => "s",
                "param_value" => $terms
            )
        );
    
        $accountCredentials = $this->updateDB($query, $params);
        return $accountCredentials;
    }

    function myAccount_Locker($account_id,$lockerStatus)
    {
        $query = "CALL smart_LockerAccountLockerUpdate(?,?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            ),
            array(
                "param_type" => "s",
                "param_value" => $lockerStatus
            )
        );
    
        $accountCredentials = $this->updateDB($query, $params);
        return $accountCredentials;
    }

    function myNotif($account_id)
    {
        $query = "CALL smart_AccountSessionNotifCount(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            )
        );
        
        $accountCredentials = $this->getDBResult($query, $params);
        return $accountCredentials;
    }

    function myNotifList($account_id)
    {
        $query = "CALL smart_accountNotificationList(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            )
        );
        
        $accountCredentials = $this->getDBResult($query, $params);
        return $accountCredentials;
    }

}

$portCont = new smartBox();

?>