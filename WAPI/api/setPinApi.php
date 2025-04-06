<?php
header("Content-Type: application/json");
include('../../controller/ApiController.php');  


$code = isset($_GET['code']) ? intval($_GET['code']) : null;

if ($code) {
    $lockers = $portCont->accountPaymentDetailsView($code);
}

echo json_encode([
    "status" => "success",
    "data" => $lockers
]);
?>
