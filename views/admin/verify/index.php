<?php 
include('../../../controller/VerifyDbController.php');  
$code = $_GET['code'];
if(!empty($code))
{
    $result = $portCont->updateAccountVerification($code);
    if(!empty($result))
    {
        $fullname =  $result[0]['firstname'].' '.$result[0]['lastname'];
        $email = $result[0]['email'];
        require("../../../public/assets/mail/accountConfirmation.php");
        Header('Location: ../?view=HOME&message=successfullyverified');
    }
}
else
{
    Header('Location: ../?view=HOME');
}
?>