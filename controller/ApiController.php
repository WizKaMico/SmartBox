<?php 

include('../../connection/connection.php');


class smartBox extends DBController
{
    function smart_lockerViewStatus($id)
    {
       $query = "CALL smart_lockerViewStatus (?)";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id
            )
        );
        
        $accountCredentials = $this->getDBResult($query, $params);
        return $accountCredentials;
    }
}

$portCont = new smartBox();