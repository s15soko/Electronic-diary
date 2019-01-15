<link rel="stylesheet" type="text/css" href="public/css/loginForm.css"/>
<div id="loginForm">
    <form action="src/Controller/loginController.php" method="post">

        <p>
        <h1>Login:</h1>
        <input type="text" name="login"/>
        </p>

        <p>
        <h1>Password:</h1>
        <input type="password" name="password"/>
        </p>

        <div id="login_form_error_container">
            
            <?php 
            // show error if is set
            if(isset($_SESSION['login_error']))
            {
                echo "<span>". $_SESSION['login_error']. "</span>";
                unset($_SESSION['login_error']);
            }
            ?>
            
        </div>

        <p>
        <input type="submit" name="submit" value="Submit"/>
        </p>
    <form>
  
</div>