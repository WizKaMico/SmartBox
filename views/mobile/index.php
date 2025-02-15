<?php 
session_start();
include('../../controller/DbController.php');  
$view = $_GET['view'] ?? 'HOME';

if(!empty($_GET['action']))
{
  switch($_GET['action'])
  { 
        case "HOMENEW":
            if(isset($_POST['submit']))
            {
                $code = filter_input(INPUT_POST,"code",FILTER_SANITIZE_STRING);
                $pin = filter_input(INPUT_POST,"pin",FILTER_SANITIZE_STRING);
                if(!empty($code) && !empty($pin))
                {
                    try
                    {
                        $lockerAccountResult = $portCont->specificAccountLockerView($code); 
                        if(!empty($lockerAccountResult))
                        {
                            $account_id = $lockerAccountResult[0]['account_id'];
                            $result = $portCont->specificAccountLockerCredentials($account_id,$pin);
                            if(!empty($result))
                            {
                                Header('Location:?view=HOME');
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view=HOME&code='.$code.'&message=failed');
                    }
                }
            }
            break;
            case "HOMEOLDLOGIN":
                if(isset($_POST['submit']))
                {
                    $pin = filter_input(INPUT_POST,"pin",FILTER_SANITIZE_STRING);
                    if(!empty($pin))
                    {
                        try
                        {
                            $account = $portCont->specificAccountLogin($pin);
                            $_SESSION['account_id'] = $account[0]["account_id"];
                            if($account[0]['session'] != 'EXPIRE')
                            {
                                if($account[0]['terms'] == NULL || $account[0]['terms'] == 'un-signed')
                                {
                                    header('Location: ./account/?view=TERMS');
                                    exit; 
                                }
                                else
                                {
                                    header('Location: ./account/?view=HOME');
                                    exit; 
                                }
                            }
                            else
                            {
                               header('Location: ./account/?view=EXPIRE');
                            }
                        }
                        catch(Exception $e)
                        {
                            Header('Location:?view=HOME&message=failed');
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
    <title>Mobile</title>
    <link rel="stylesheet" href="../../public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
         <?php 
            if(!empty($view)) { 
                switch($view)
                {
                    case "HOME":
                        include('./style/home.css');
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

<body class="d-flex flex-column bg-dark vh-100">
<?php 
        if(!empty($view))
        {
            switch($view)
            {
                case "HOME": 
                    include('./routes/home.php');
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="../../public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
    
    $view = isset($_GET['view']) ? $_GET['view'] : 'HOME'; 
    $code = isset($_GET['code']);    
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const view = "<?php echo $view; ?>"
        const code = "<?php echo $code; ?>"
        switch (view) {

            case 'HOME':
                if(code)
                {
                    loadScript('./js/home_new.js');      
                }
                else
                {
                    loadScript('./js/home_old.js');
                }
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