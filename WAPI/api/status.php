<?php
header("Content-Type: application/json");
include('../../controller/ApiController.php');  


$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    $lockers = $portCont->smart_lockerViewStatus($id);
}

echo json_encode([
    "status" => "success",
    "data" => $lockers
]);
?>
