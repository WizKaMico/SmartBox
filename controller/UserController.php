<?php
include('../../connection/connection.php');

class smartBox extends DBController
{

    //USER
    function create_Account($imageName, $firstname, $lastname, $contact, $email, $hashed, $password)
    {
        $query = "CALL smart_CreateUserAccount(?,?,?,?,?,?,?,?)";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $imageName
            ),
            array(
                "param_type" => "s",
                "param_value" => $firstname
            ),
            array(
                "param_type" => "s",
                "param_value" => $lastname
            ),
            array(
                "param_type" => "s",
                "param_value" => $contact
            ),
            array(
                "param_type" => "s",
                "param_value" => $email
            ),
            array(
                "param_type" => "s",
                "param_value" => $hashed
            ),
            array(
                "param_type" => "s",
                "param_value" => $password
            ),
            array(
                "param_type" => "i",
                "param_value" => rand (6666,9999)
            )
        );

        $accountResultCredentials = $this->getDBResult($query, $params);
        return $accountResultCredentials;
    }

    function validateAccount($email)
    {
        $query = "CALL smart_AccountForgotPasswordValidation(?)";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $email
            )
        );

        $accountResultCredentials = $this->getDBResult($query, $params);
        return $accountResultCredentials;
    }

    function updateAccountCredentialPassword($code,$password,$hashed)
    {
        $query = "CALL smart_CreateUserAccountUpdateCredentials(?,?,?)";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $code
            ),
            array(
                "param_type" => "s",
                "param_value" => $hashed
            ),
            array(
                "param_type" => "s",
                "param_value" => $password
            )
        );

        $accountResultCredentials = $this->getDBResult($query, $params);
        return $accountResultCredentials;
    }

    function specificAccountLoginAdmin($email, $password)
    {
        $query = "CALL smart_UserAccountAdminLogin(?,?)";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $email
            ),
            array(
                "param_type" => "s",
                "param_value" => $password
            )
        );

        $accountResultCredentials = $this->getDBResult($query, $params);
        return $accountResultCredentials;
    }
    //USER

}

$portCont = new smartBox();

?>