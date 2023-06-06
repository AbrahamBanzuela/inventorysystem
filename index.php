<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Inventory System Program</title>
 
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!--Stylesheet-->
    <style>

@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    
*{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
} 

body{
  height: 100vh;
  width: 100%;
  background: linear-gradient(115deg, #56d8e4 10%, #9f01ea 90%);
}


.container{
  display: block;
  background: #fff;
  width: 410px;
  padding: 30px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.container .text{
  font-size: 35px;
  font-weight: 600;
  text-align: center;
}
.container form{
  margin-top: -20px;
}
.container form .data{
  height: 45px;
  width: 100%;
  margin: 40px 0;
}
form .data label{
  font-size: 18px;
}
form .data input{
  height: 100%;
  width: 100%;
  padding-left: 10px;
  font-size: 17px;
  border: 1px solid silver;
}
form .data input:focus{
  border-color: #3498db;
  border-bottom-width: 2px;
}
form .forgot-pass{
  margin-top: -8px;
}
form .forgot-pass a{
  color: #3498db;
  text-decoration: none;
}
form .forgot-pass a:hover{
  text-decoration: underline;
}
form .btn{
  margin: 30px 0;
  height: 45px;
  width: 100%;
  position: relative;
  overflow: hidden;
}
form .btn .inner{
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  z-index: -1;
  background: -webkit-linear-gradient(right, #56d8e4, #9f01ea, #56d8e4, #9f01ea);
  transition: all 0.4s;
}
form .btn:hover .inner{
  left: 0;
}
form .btn button{
  height: 100%;
  width: 100%;
  background: none;
  border: none;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 1px;
  cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
    <form action="login_page.php" method="POST" >
        <h3>Login</h3>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error" style="color: red; text-align: center;"> <?php echo $_GET['error']; ?></p>
        <?php } ?>  

<div class="data">
    <label for="username">Username</label>
    <input type="text" placeholder="Email or Phone" name="username">
</div>
       
<div class="data">
    <label for="password">Password</label>
    <input type="password" placeholder="Password" name="password">
</div>
<div class="btn">
    <div class="inner">
    <button type="submit" name="submit" id="btn_login">Log In</button>
    </div>
</div>

    </form>
    </div>
    
</body>
</html>