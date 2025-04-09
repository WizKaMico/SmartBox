<?php 

$view = isset($_GET['view']) ? $_GET['view'] : 'HOME'; 
include('../../../controller/UserAccountDbController.php');  
include('../../../controller/session_admin.php');

$account = $portCont->myAccountAdmin($user_id);
$activeRent = $portCont->ActiveRentals();
$activeProfit = $portCont->smart_profits();
$activeRent = $portCont->smart_rents();

if(!empty($_GET['action'])){
    switch($_GET['action'])
    {
        case "ADDLOCKER":   
            if(isset($_POST['create']))
            {
                $locker = $_POST['locker'];
                $size = $_POST['size'];
                $dimension = $_POST['dimension'];
                $status = $_POST['status'];
                $price = $_POST['price'];
                if(!empty($locker) && !empty($size)  && !empty($dimension)  && !empty($status) && !empty($price))
                {
                    try
                    {
                        $portCont->addLocker($locker, $size, $dimension, $status, $price);
                        Header('Location:?view=LOCKER&message=success');
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view=LOCKER&message=failed');
                    }
                }
            }
            break;
        case "UPDATELOCKERPRICE":
            if(isset($_POST['edit']))
            {
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    if(!empty($id) && !empty($price))
                    {
                        try
                        {
                            $portCont->updateLockerPrice($id, $price);
                            Header('Location:?view=LOCKER&message=success');
                        }
                        catch(Exception $e)
                        {   
                            Header('Location:?view=LOCKER&message=failed');
                        }
                    }
            }
            break;
        case "STATUSLOCKER":
            if(isset($_POST['edit']))
            {
                    $id = $_POST['id'];
                    $status = $_POST['status'];
                    if(!empty($id) && !empty($status))
                    {
                        try
                        {
                            $portCont->updateLockerStatus($id, $status);
                            Header('Location:?view=LOCKER&message=success&id='.$id.'&status='.$status);
                        }
                        catch(Exception $e)
                        {   
                            Header('Location:?view=LOCKER&message=failed');
                        }
                    }
            }
            break;
        case "DELETELOCKER":
            if(isset($_POST['delete']))
            {
                $id = $_POST['id'];
                if(!empty($id))
                {
                    try
                    {
                        $portCont->deleteLocker($id);
                        Header('Location:?view=LOCKER&message=success');
                    }
                    catch(Exception $e)
                    {   
                        Header('Location:?view=LOCKER&message=failed');
                    }
                }
            }
        break;
        case "UPDATEADMIN":
            if(isset($_POST['edit']))
            {
                $view = $_GET['view'];
                $user_id = $_POST['user_id'];
                $firstname = filter_input(INPUT_POST,"firstname",FILTER_SANITIZE_STRING);
                $lastname = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_STRING);
                $contact = filter_input(INPUT_POST,"contact",FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING);

                if(!empty($user_id) && !empty($firstname) && !empty($lastname) && !empty($contact) && !empty($email) && !empty($password))
                {
                    try
                    {
                        $portCont->updateAdminInformation($user_id, $firstname, $lastname, $contact, $email, $password);
                        Header('Location:?view='.$view.'&message=success');
                    }
                    catch(Exception $e)
                    {   
                        Header('Location:?view='.$view.'&message=failed');
                    }
                }
            }
        break;
        case "UPDATEADMINIMAGE":
            if(isset($_POST['edit']))
            {
                $view = $_GET['view'];
                $user_id = $_POST['user_id'];
                $image = $_FILES['image'];
                if (!empty($image) && !empty($user_id))
                {
                    try 
                    {
                        $targetDir = "../users/upload/";
                        if (!file_exists($targetDir)) {
                            if (!mkdir($targetDir, 0777, true)) {
                                throw new Exception("Failed to create directory.");
                            }
                        }
        
                        $imageName = basename($image["name"]);
                        $targetFilePath = $targetDir . $imageName;
                        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                        $allowedTypes = array("jpg", "png", "jpeg", "gif", "PNG");
        
                        if (in_array($imageFileType, $allowedTypes)) {
                            if ($image["error"] == UPLOAD_ERR_OK) {
                                if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
                                    $result = $portCont->update_AccountImage($imageName, $user_id);
                                    Header('Location:?view='.$view.'&message=success'); 
                                    exit; 
                                    
                                } else {
                                    throw new Exception("Error moving the uploaded file.");
                                }
                            } else {
                                throw new Exception("Upload error: " . $image["error"]);
                            }
                        } else {
                            throw new Exception("Invalid file type.");
                        }

                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view='.$view.'&message=failed'); 
                        exit; 
                    }
                }

            }   
        break;
        case "UPDATESTATUS":
            if(isset($_POST['edit']))
            {
                $view = $_GET['view'];
                $user_id = $_POST['user_id'];
                $staff_status = $_POST['staff_status'];
                if(!empty($user_id) && !empty($staff_status))
                {
                    try 
                    {   
                        $portCont->updateAdminInformationStatus($user_id, $staff_status);
                        Header('Location:?view='.$view.'&message=success');
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view='.$view.'&message=failed');
                    }
                }
            }
        break;
        case "DELETESTAFF":
            if(isset($_POST['edit']))
            {
                $view = $_GET['view'];
                $user_id = $_POST['user_id'];
                if(!empty($user_id))
                {
                    try 
                    {   
                        $portCont->deleteStaffInformation($user_id);
                        Header('Location:?view='.$view.'&message=success');
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view='.$view.'&message=failed');
                    }
                }
            }
        break;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../../../public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
     <?php 
            if(!empty($view)) { 
                switch($view)
                {
                    case "HOME":
                        include('../style/account_home.css');
                        break;
                    case "LOGOUT":
                        include('../style/account_home.css');
                        break;
                    case "LOCKER":
                        include('../style/account_modal.css');
                        break;
                    case "LOCKER":
                        include('../style/account_modal.css');
                        break;
                    default:
                        include('../style/account_home.css');
                        break;
                }
            } else {
                include('../style/account_home.css');
            }
        ?>
    </style>
</head>

<body class="d-flex vh-100" style="background-color: #f1f4fb">
    <div class="d-flex flex-column text-white p-3" style="max-width: 250px; position: relative; background-image: url('../../../public/assets/images/bg.jpg'); background-size: cover;">
        <div class="d-flex align-items-center mb-4 px-4 py-2">
            <img src="../../../public/assets/images/logo.png" class="me-2" alt="Logo" style="width: 20px; height: 30px;">
            <h3 class="text-white m-0">SmartBox™</h3>
        </div>
        <?php if($account[0]['role_name'] == "ADMIN"){ ?>    
        <a href="?view=HOME" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-house-door me-2"></i>Dashboard
        </a>
        <a href="?view=TRANSRECORDS" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-building me-2"></i> Transaction
        </a>
        <a href="?view=LOCKER" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-lock me-2"></i>Lockers
        </a>
        <a href="?view=ADMIN" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-person me-2"></i>Admins
        </a>
        <a href="?view=STAFF" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-person me-2"></i>Staff
        </a>
        <a href="?view=REPORTS" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-file-earmark-text me-2"></i>Reports
        </a>
        <a href="?view=LOGS" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-card-checklist me-2"></i>Logs
        </a>
        <a href="?view=HISTORY" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded px-5 py-3 w-100">
            <i class="bi bi-clock-history me-2"></i>Login History
        </a>
        <div class="mt-auto w-100">
            <a href="./logout.php" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded px-5 py-3 w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
        </div>
        <?php } else { ?>
            <a href="?view=HOME" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-house-door me-2"></i>Dashboard
        </a>
        <a href="?view=TRANSRECORDS" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-building me-2"></i> Transaction
        </a>
        <a href="?view=LOCKER" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-lock me-2"></i>Lockers
        </a>
        <a href="?view=ADMIN" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-person me-2"></i>Staff
        </a>
        <a href="?view=REPORTS" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-file-earmark-text me-2"></i>Reports
        </a>
        <a href="?view=LOGS" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded mb-2 px-5 py-3 w-100">
            <i class="bi bi-card-checklist me-2"></i>Logs
        </a>
        <a href="?view=HISTORY" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded px-5 py-3 w-100">
            <i class="bi bi-clock-history me-2"></i>Login History
        </a>
        <div class="mt-auto w-100">
            <a href="./logout.php" class="d-flex align-items-center text-white text-decoration-none hover-bg-light rounded px-5 py-3 w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
            </a>
        </div>
        <?php } ?>
    </div>

    <div class="flex-fill">
        <div class="d-flex justify-content-between align-items-center bg-white shadow-sm p-3 mb-4">
            <h3 class="m-0"></h3>
            <div class="d-flex align-items-center">
                <i class="bi bi-bell me-4" style="font-size: 1.5rem;"></i>
                    <span class="fw-bold me-4">
                        <img class="rounded-circle me-2" height="30px" width="30px" src="../users/upload/<?php echo $account[0]['image']; ?>"
                            alt="">
                        <?php echo $account[0]['firstname']; ?> | <?php echo $account[0]['role_name']; ?>
                    </span>
            </div>
        </div>
        <?php 
        if(!empty($view))
        {
            switch($view)
            {
                case "HOME": 
                    include('../routes/account/home.php');
                    break;
                case "LOCKER":
                    include('../routes/account/locker.php');
                    break;
                case "ADMIN":
                    include('../routes/account/admin.php');
                    break;
                case "STAFF":
                    include('../routes/account/staff.php');
                    break;
                case "REPORTS":
                    include('../routes/account/report.php');
                    break;
                case "LOGS":
                    include('../routes/account/logs.php');
                    break;
                case "HISTORY":
                    include('../routes/account/history.php');
                    break;
                case "TRANSRECORDS": 
                    include('../routes/account/transaction_records.php');
                    break;
                default: 
                    include('./routes/account/home.php');
                    break;
            }
        }
        else
        {
            include('./routes/account/home.php');
        }
        ?>

    </div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="../../../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const view = "<?php echo $view; ?>"
            switch (view) {

                case 'HOME':
                    loadScript('../js/home_account.js');   
                    loadScript('../../../public/assets/datatable/dt.js');    
                    break;
                case 'LOCKER':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    loadScript('../js/modal.js');   
                    break;
                case 'LOGS':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    break;
                case 'REPORTS':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    break;
                case 'ADMIN':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    loadScript('../js/modal.js');   
                    break;
                case 'STAFF':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    loadScript('../js/modal.js');   
                    break;
                case 'TRANSRECORDS':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    break;
                case 'HISTORY':
                    loadScript('../../../public/assets/datatable/dt.js');    
                    break;
            }

        });

        function loadScript(src) {
            const script = document.createElement('script');
            script.src = src;
            document.head.appendChild(script);
        }
        </script>

</body>
</html>