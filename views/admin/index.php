<?php 
session_start();
include('../../controller/UserController.php');  
$view = $_GET['view'] ?? 'HOME';

if(!empty($_GET['action']))
{
  switch($_GET['action'])
  { 
    case "SIGNUP":
        if (isset($_POST['submit'])) {
            $image = $_FILES['image'];
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
            $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
            $hashed = md5($password);
            
    
            if (!empty($image) && !empty($firstname) && !empty($lastname) && !empty($contact) && !empty($email) && !empty($password) && !empty($hashed)) {
              
                try {
                    $targetDir = "users/upload/";
    
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
                                $result = $portCont->create_Account($imageName, $firstname, $lastname, $contact, $email, $hashed, $password);

                                    $fullname = $firstname.' '.$lastname;
                                    $code = $result[0]['code'];
                                    require("../../public/assets/mail/accountCreation.php");
                                    Header('Location:?view=SIGNUP&message=creationSuccess'); 
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
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    Header('Location:?view=SIGNUP&message=creationFailed'); 
                    exit; 
                }
            } else {
                Header('Location:?view=SIGNUP&message=failed');
                exit;
            }
        }
        break;
        case "FORGOT":
            if(isset($_POST['submit']))
            {
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
                if(!empty($email))
                {
                    try
                    {
                        $result = $portCont->validateAccount($email);
                        if(!empty($result))
                        {
                            if(!empty($result[0]['email']))
                            {
                                $fullname = $result[0]['firstname'].' '.$result[0]['lastname'];
                                $code = $result[0]['code'];
                                require("../../public/assets/mail/accountForgotPassword.php");
                                Header('Location:?view=FORGOT&message=accountvalid');
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        Header('Location:?view=FORGOT&message=failed');
                        exit;
                    }
                }
            }
            break;
            case "FORGOTACCOUNT":
                if(isset($_POST['submit']))
                {
                    $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_STRING);
                    $hashed = md5($password);
                    if(!empty($password) && !empty($code))
                    {
                        try
                        {
                            $result = $portCont->updateAccountCredentialPassword($code,$password,$hashed);
                            if(!empty($result))
                            {
                                Header('Location:?view=HOME&message=successchangepassword');
                                exit;
                            }
                        }
                        catch(Exception $e)
                        {
                            Header('Location:?view=FORGOT&message=failed');
                            exit;
                        }
                    }
                }
            break;
            case "LOGIN":
                if(isset($_POST['submit']))
                {
                    $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_STRING);
                    $password = md5(filter_input(INPUT_POST,"password",FILTER_SANITIZE_STRING));
                    if(!empty($email) && !empty($password))
                    {
                        try
                        {
                            $account = $portCont->specificAccountLoginAdmin($email, $password);
                            if(!empty($account))
                            {
                                if($account[0]["user_id"] > 0)
                                {
                                    if($account[0]["role_name"] == "ADMIN")
                                    {
                                        if($account[0]["status"] == 'VERIFIED')
                                        {
                                            $_SESSION['user_id'] = $account[0]["user_id"];
                                            header('Location: ./account/?view=HOME');
                                        }
                                        else
                                        {
                                            Header('Location:?view=HOME&message=unverified');
                                        }
                                    }
                                    else
                                    {
                                        if($account[0]["status"] == 'VERIFIED' && $account[0]["staff_status"] == 'ACTIVE')
                                        {
                                            $_SESSION['user_id'] = $account[0]["user_id"];
                                            header('Location: ./account/?view=HOME');
                                        }
                                        else
                                        {
                                            Header('Location:?view=HOME&message=unverified');
                                        }
                                    }
                                }
                                else
                                {
                                    Header('Location:?view=HOME&message=failpass');
                                }
                            }
                        }
                        catch(Exception $e)
                        {
                            Header('Location:?view=HOME&message=failed');
                        }
                    }
                    else
                    {
                        Header('Location:?view=HOME&message=loginfail');
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
  <title>Login Form</title>
  <link rel="stylesheet" href="../../public/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<?php include('../../public/assets/swal/alert.php'); ?>
<body class="d-flex min-vh-100" style="background-color: #333;">
 
<?php 
        if(!empty($view))
        {
            switch($view)
            {
                case "HOME": 
                    include('./routes/home.php');
                    break;
                case "SIGNUP": 
                    include('./routes/signup.php');
                    break;
                case "FORGOT": 
                    include('./routes/forgot.php');
                    break;
                case "FORGOTACCOUNT":
                     include('./routes/forgot_account.php');
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
</body>
</html>
