<?php 
$view = isset($_GET['view']) ? $_GET['view'] : 'HOME'; 
include('../../../controller/MobileDbController.php');  
include('../../../controller/session.php');

$account = $portCont->myAccount($account_id);
$notifCount = $portCont->myNotif($account_id);



if(!empty($_GET['action']))
{
  switch($_GET['action'])
  { 
    case "TERMS":
        if(isset($_POST['signed']))
        {
            $account_id = $account[0]['account_id'];
            $terms = 'signed';
            $portCont->myAccount_terms($account_id, $terms);
            Header('Location:?view=HOME&route=');
        }
        else
        {
            $account_id = $account[0]['account_id'];
            $terms = 'un-signed';
            $portCont->myAccount_terms($account_id, $terms);
            Header('Location:./logout.php');
        }
        break;
    case "LOCKER":
        if(isset($_POST['locker']))
        {
            try
            {   
                $account_id = $account[0]['account_id'];
                $name = $account[0]['fullname'];
                $email = $account[0]['email'];
                $phone = $account[0]['phone'];
                $lockerStatus = $account[0]['lockerStat'];
                if ($lockerStatus == 'unlocked') {
                    $lockerStatus = 'locked';
                    $portCont->myAccount_Locker($account_id,$lockerStatus);
                    require("../../../public/assets/mail/lockerNotif.php");
                    Header('Location:?view=HOME');
                } else {
                    $lockerStatus = 'unlocked';
                    $portCont->myAccount_Locker($account_id,$lockerStatus);
                    require("../../../public/assets/mail/lockerNotif.php");
                    Header('Location:?view=HOME');
                }
            }
            catch(Exception $e)
            {
                Header('Location:?view=HOME&message=failed');
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
    <title>SmartLocker</title>
    <link rel="stylesheet" href="../../../public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
         <?php 
            if(!empty($view)) { 
                switch($view)
                {
                    case "HOME":
                        include('../style/account_home.css');
                    case "LOGOUT":
                        include('../style/account_home.css');
                    case "NOTIFICATION":
                        include('../style/account_notification.css');
                    default:
                        include('../style/account_home.css');
                        break;
                }
            } else {
                include('../style/account_home.css');
            }
        ?>
    </style>
    <?php include('../../../public/assets/swal/alert.php'); ?>
</head>

<body class="d-flex text-white bg-dark vh-100 fs-6">
    <?php 
        if(!empty($view))
        {
            if($account[0]['session'] != 'EXPIRE'){
                switch($view)
                {
                    case "HOME": 
                        include('../routes/account/home.php');
                        break;
                    case "TERMS":
                        include('../routes/account/terms.php');
                        break;
                    case "LOGOUT": 
                        include('../routes/account/home.php');
                        break;
                    case "NOTIFICATION":
                        include('../routes/account/notification.php');
                        break;
                    default: 
                        include('../routes/account/home.php');
                        break;
                }
            }else{
                switch($view)
                {
                    case "EXPIRE":
                        include('../routes/account/expire.php');
                        break;
                    default: 
                        include('../routes/account/expire.php');
                        break;
                }    
            }
            
        }
        else
        {
            include('../routes/account/home.php');
        }
    ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const view = "<?php echo $view; ?>"
            switch (view) {

                case 'HOME':
                    loadScript('../js/home_account.js');      
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