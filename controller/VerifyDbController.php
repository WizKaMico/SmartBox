<?php
include('../../../connection/connection.php');

class smartBox extends DBController
{

    //VERIFY
    function updateAccountVerification($code)
    {
        $query = "CALL smart_CreateUserAccountVerification(?)";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $code
            )
        );

        $accountResultCredentials = $this->getDBResult($query, $params);
        return $accountResultCredentials;
    }
    //VERIFY

}

$portCont = new smartBox();

?>