<?php 
include('../../controller/DbController.php');  
$view = $_GET['view'] ?? 'HOME';

if(!empty($_GET['action']))
{
  switch($_GET['action'])
  { 
     case "RENT":
        if(isset($_POST['submit']))
        {
            $name = filter_input(INPUT_POST,"name",FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST,"phone",FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
            $locker_id = filter_input(INPUT_POST,"locker_id",FILTER_SANITIZE_STRING);
            $hours = filter_input(INPUT_POST,"hours",FILTER_SANITIZE_STRING);
            $payment = filter_input(INPUT_POST,"payment",FILTER_SANITIZE_STRING);
            if(!empty($name) && !empty($phone) && !empty($email) && !empty($locker_id) && !empty($hours) && !empty($payment))
            {
                try
                {
                    $id = $locker_id;
                    $lockerResult = $portCont->specificLockerView($id); 
                    if(!empty($lockerResult))
                    { 
                        $amount = $lockerResult[0]['price'];
                        $price = $hours * $amount;
                        $code = rand(6666,9999);
                        $to = preg_replace('/^0/', '+63', $phone);
                        $message = "SmartBox 4-Digit Code Confirmation ${name} - ${code}";
                        $result = $portCont->createLockerReportAccount($locker_id, $name, $phone, $email, $hours, $price, $payment, $code);
                        if(!empty($result))
                        {
                            require("../../public/assets/mail/verification.php");
                            // require("../../public/assets/sms/sms.php");
                            Header('Location:?view=RENT&locker='.$locker_id.'&price='.$lockerResult[0]['price'].'&message=success&route=CONFIRMATION&code='.$code);
                        }
                    }
                }
                catch(Exception $e)
                {
                    Header('Location:?view=RENT&locker='.$locker_id.'&price='.$lockerResult[0]['price'].'&message=failed');
                }
            }
        }
        break;
     case "CONFIRMATION":
        if(isset($_POST['submit']))
        {
            if(isset($_POST['submit']))
            {
                $code = filter_input(INPUT_POST,"code",FILTER_SANITIZE_STRING);
                $pin = filter_input(INPUT_POST,"pin",FILTER_SANITIZE_STRING);
                if(!empty($pin) && !empty($code))
                {
                    try
                    {
                        $lockerAccountResult = $portCont->specificAccountLockerView($code); 
                        if(!empty($lockerAccountResult))
                        {
                            $actualPin = $lockerAccountResult[0]['code'];
                            if($pin == $actualPin)
                            {
                                $email = $lockerAccountResult[0]['email'];
                                $phone =  $lockerAccountResult[0]['phone'];
                                require("../../public/assets/mail/confirmationverification.php");
                                $result = $portCont->specificAccountLockerViewUpdate($code);
                                Header('Location:?view=CONFIRMATION&code='.$code.'&message=success&route=PAYMENT');
                            }
                            else
                            {
                                Header('Location:?view=CONFIRMATION&code='.$code.'&message=failed');
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view=CONFIRMATION&code='.$code.'&message=failed');
                    }
                }
            }
        }
        break;
        case "SETUPPIN":
            if(isset($_POST['submit']))
            {
                $code = filter_input(INPUT_POST,"code",FILTER_SANITIZE_STRING);
                $pincode = filter_input(INPUT_POST,"pin",FILTER_SANITIZE_STRING);
                if(!empty($code) && !empty($pincode))
                {
                    try
                    {
                        $lockerAccountResult = $portCont->specificAccountLockerView($code); 
                        if(!empty($lockerAccountResult))
                        {
                            $account_id = $lockerAccountResult[0]['account_id'];
                            $email = $lockerAccountResult[0]['email'];
                            $result = $portCont->createAccountLockerCredentials($account_id, $pincode);
                            if(!empty($result))
                            {
                                $coda = $result[0]['code'];
                                require("../../public/assets/mail/confirmationCredentials.php");
                                Header('Location:?view=FINALQR&code='.$code.'&message=success');
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view=SETUPPIN&code='.$code.'&message=failed');
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
    <title>KIOSK</title>
    <link rel="stylesheet" href="../../public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        <?php 
        if(!empty($view)) { 
            switch($view)
            {
                case "HOME":
                    include('./style/home.css');
                case "CONFIRMATION":
                    include('./style/confirmation.css');
                    break;
                case "SETUPPIN":
                    include('./style/confirmation.css');
                    break;
                default:
                    include('./style/home.css');
                    break;
            }
        } else {
            include('./style/home.css');
        }
        ?>
    </style>
</head>
<?php include('../../public/assets/swal/alert.php'); ?>
<body class="d-flex flex-column bg-dark vh-100">
       <?php 
        if(!empty($view))
        {
            switch($view)
            {
                case "HOME": 
                    include('./routes/home.php');
                    break;
                case "RENT": 
                    $id = $_GET['locker'];
                    if(!empty($id))
                    {
                        $lockerResult = $portCont->specificLockerView($id); 
                        include('./routes/rent.php');
                    }
                    else
                    {
                        Header('Location:?view=HOME');
                    }
                    break;
                case "CONFIRMATION":
                    $code = $_GET['code'];
                    if(!empty($code))
                    {
                        $lockerAccountResult = $portCont->specificAccountLockerView($code); 
                        include('./routes/confirmation.php');
                    }
                    break;
                case "PAYMENT":
                    $code = $_GET['code'];
                    if(!empty($code))
                    {
                        $lockerAccountResult = $portCont->specificAccountLockerView($code); 
                        include('./routes/payment.php');
                    }
                    break;
                case "PAYMENTCONFIRMATION":
                    $code = $_GET['code'];
                    $message = $_GET['message'];
                    if(!empty($code) && !empty($message))
                    {   
                        $status = ($message == 'success') ? 'SUCCESS' : 'FAILED';
                        $result = $portCont->specificAccountLockerViewUpdateStatus($code,$status);
                        $email = $result[0]['email'];
                        $ref = $result[0]['src_link'];
                        require("../../public/assets/mail/payment.php");
                        include('./routes/paymentConfirmation.php');
                    }
                    break;
                case "SETUPPIN":
                    $code = $_GET['code'];
                    if(!empty($code))
                    {
                        include('./routes/setuppin.php');
                    }
                    break;
                case "FINALQR":
                    $code = $_GET['code'];
                    if(!empty($code))
                    {
                        include('./routes/finalQR.php');
                    }
                    break;
                default: 
                    include('./routes/home.php');
                    break;
            }
        }
        else
        {
            include('./routes/home.php');
        }
        ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
    
    $view = isset($_GET['view']) ? $_GET['view'] : 'HOME'; 
    $price = isset($_GET['price']) ? $_GET['price'] : '0';    
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const view = "<?php echo $view; ?>"
        switch (view) {

            case 'HOME':
                loadScript('./js/home.js');
                break;
            case 'RENT':
                const basePrice = parseFloat("<?php echo $price; ?>");
                console.log(basePrice)
                loadScript('./js/rent.js?price=' + basePrice);
                break;
            case 'CONFIRMATION':
                loadScript('./js/confirmation.js');
                break;
            case 'SETUPPIN':
                loadScript('./js/setuppin.js');
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


