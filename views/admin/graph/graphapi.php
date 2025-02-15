<?php 
include('../../../controller/UserAccountDbController.php');  
$result = $portCont->smart_reportViewGraph();
echo json_encode($result);
?>