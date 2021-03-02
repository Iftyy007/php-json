<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File_Handling_03_Login</title>
</head>
<body>


<?php
    $uname = $password = $unameErr = $passwordErr = $msg = "";
    $userName = $password = "";
    $flag = 0;
    

    if ($_SERVER["REQUEST_METHOD"] =="POST" )
    {
        if(empty($_POST['uname'])) 

            {
                $unameErr = "Please Fill Up the UserName";
            }
            else
            {
                $uname = $_POST['uname'];
            }

        if(empty($_POST['password'])) 

            {
                $passwordErr = "Please Fill Up the Password";
            }
            else
            {
                $password = $_POST['password'];
            }


            $filepath = "data3.txt";
            $f = fopen($filepath,'r') or die("fail to open file");
            
            


            while (!feof($f))
            {
                $line = fgets($f);
                $json_decoded_text = json_decode($line,true);
                $userName = $json_decoded_text['userName'];
                $password = $json_decoded_text['password'];


                if($userName == $uname && $password == $password){
                    $flag++;
                    break;
                }
        
              
        
            }
        
            if ($flag>0)
            {
                $msg = "Successful";
                echo $msg;
                echo "<br>";
        
                $_SESSION['userId'] = $uname;
                $_SESSION['password'] = $password;
            
                echo "User Id is: " . $_SESSION['userId'];
                echo "<br>";
                echo "Password is: " . $_SESSION['password'];
            }
        
            else
            {
                $msg = "Try Again";
                echo "Unsuccessful! " .$msg;
            }
                
                
            }

            


    



    //fclose($f);
    session_unset();
    session_destroy();
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

    <center>
    <i>
    <h2>User Login</h2>
    
    <b> <p style="font-size: 16px;">UserName</p> <input type="text" name="uname" value="" placeholder="Type UserName" size="30px">
    <p style="color:red"><?php echo $unameErr; ?></p>
    
                    
    <b> <p style="font-size: 16px;">Password</p> <input type="password" name="password" value="" placeholder="Type Password" size="30px">
    <p style="color:red"><?php echo $passwordErr; ?></p>
    
    <br> <br> <input type="submit" name="" value="Login">
    
    
    
    
    
    </center>                    

</form>
    
</body>
</html>