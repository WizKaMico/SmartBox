<?php
include('../../connection/connection.php');

class smartBox extends DBController
{

    //KIOSK
    function lockers()
    {
        $query = "CALL smart_lockerView";
        $locker = $this->getDBResult($query);
        return $locker;
    }

    function specificLockerView($id)
    {
        $query = "CALL smart_lockerSpecificView(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );

        $LockerResult = $this->getDBResult($query, $params);
        return $LockerResult;
    }

    function specificAccountLockerView($code)
    {
        $query = "CALL smart_lockerAccountSpecificView(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $code
            )
        );

        $accountLockerResult = $this->getDBResult($query, $params);
        return $accountLockerResult;
    }

    function createLockerReportAccount($locker_id, $name, $phone, $email, $hours, $price, $payment, $code)
    {
        $query = "CALL smart_ReportCreation (?,?,?,?,?,?,?,?)";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $locker_id
            ),
            array(
                "param_type" => "s",
                "param_value" => $name
            ),
            array(
                "param_type" => "s",
                "param_value" => $phone
            ),
            array(
                "param_type" => "s",
                "param_value" => $email
            ),
            array(
                "param_type" => "i",
                "param_value" => $hours
            ),
            array(
                "param_type" => "s",
                "param_value" => $price
            ),
            array(
                "param_type" => "s",
                "param_value" => $payment
            ),
            array(
                "param_type" => "i",
                "param_value" => $code
            )

        );

        $reportResult = $this->getDBResult($query, $params);
        return $reportResult;
    }

    function specificAccountLockerViewUpdate($code)
    {
        $query = "CALL smart_lockerAccountSpecificViewUpdate(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $code
            )
        );

        $accountLockerResult = $this->getDBResult($query, $params);
        return $accountLockerResult;
    }

    function accountPaymentDetails($account_id, $code, $sourceId, $checkoutUrl)
    {
        $query = "CALL smart_ReportPaymentCreation(?,?,?,?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $code
            ),
            array(
                "param_type" => "s",
                "param_value" => $sourceId
            ),
            array(
                "param_type" => "s",
                "param_value" => $checkoutUrl
            )
        );

        $accountLockerResultPayment = $this->getDBResult($query, $params);
        return $accountLockerResultPayment;
    }

    function accountPaymentDetailsView($code)
    {
        $query = "CALL smart_ReportPaymentView(?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $code
            )
        );

        $accountLockerResultPayment = $this->getDBResult($query, $params);
        return $accountLockerResultPayment;
    }

    function specificAccountLockerViewUpdateStatus($code,$status)
    {
        $query = "CALL smart_ReportPaymentViewUpdateStatus(?,?)";
        
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $status
            ), 
            array(
                "param_type" => "i",
                "param_value" => $code
            )

        );

        $accountLockerResultPayment = $this->getDBResult($query, $params);
        return $accountLockerResultPayment;
    }

    function createAccountLockerCredentials($account_id, $pincode)
    {
        $query = "CALL smart_lockerCredentials(?,?,?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $account_id
            ), 
            array(
                "param_type" => "i",
                "param_value" => $pincode
            ), 
            array(
                "param_type" => "i",
                "param_value" => rand(6666,9999)
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
     //KIOSK

}

$portCont = new smartBox();

?>