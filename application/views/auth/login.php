<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>login with fullscreen background - Sample  - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
.login2background{    
    background-image: url(https://s13.postimg.org/8xs7irifb/education2.png);
    background-repeat:no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
.loginbox{  
    background: white;
    color: black;    
    margin-top: 30%;
    left: 0;
    padding: 20px;   
    box-shadow: 0 8px 50px -2px #000;
    border-radius:5px;

}
.logo{
    width: 50px; 
    height: 78px;
    margin-left: 10%;
}
@media (max-width:767px) {
    .loginbox{ 
        margin-top: 10%;
    }    
}

.loginbox_content{
    padding:5% 11% 5% 11%;

}

.singtext{
    font-family: "Open Sans",sans-serif;
    font-size: 27px;  
    color: #82C226;
    float: right;
    padding-right: 25%;
}

.submit-btn{
    float: right;
    margin-right: 28%;
}

.forgotpassword{
    padding-left: 10%;
}
@media (max-width:800px) {
    .submit-btn{
        
        margin-right: 23%;
    }

   
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<body class="login2background">
        <div class="container">  
            <div class="col-lg-6 col-md-6 col-sm-8  loginbox">
                <div class=" row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6">
                        <img src="<?php echo base_url();?>assets/img/upgris.png" alt="Logo" class="logo"> 
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6  ">
                        <span class="singtext" >Log In </span>   
                    </div>
                                 
                </div>
                <?php echo form_open("auth/login");?>
                <div class=" row loginbox_content ">                        
                    <div class="input-group input-group-sm" >
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </span>
                        <input class="form-control"  type="text" name="identity" value="" placeholder="User name" id="identity">
                       
                    </div>
                    <br>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </span>
                        <input class="form-control" type="password" placeholder="Password" name="password" value="" id="password">
                        
                    </div>              
                </div>
                <div class="row ">                   
                    <div class="col-lg-8 col-md-8  col-sm-8 col-xs-7 forgotpassword "> 
                        <a href="#"  > </a>                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4  col-xs-5 ">                         
                        <input class=" btn btn-default submit-btn"type="submit" name="submit" value="Login">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-4 "></div>
<?php echo form_close();?>

        </div>
    </body>
<script type="text/javascript">

</script>
</body>
</html>