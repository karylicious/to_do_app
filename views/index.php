<!DOCTYPE html>
<html lang = "en">
    <head>
        <title> WishList </title>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel = "stylesheet" href = "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>        
        
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"></script>
        
        <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">    
        <link href = "https://fonts.googleapis.com/css?family=Lobster" rel = "stylesheet">
        <link rel = "stylesheet" href = "http://localhost/ci/static/style.css">
    </head>

    <body>    
        <div class = "container-fluid">
            <div class = "row effectShadow">                
                <div id = "topDiv">
                    <div class = "centered">WishList</div>
                </div>              
            </div>
            <div id = "div_unlogged_area" class = "row" style = "height: 100vh;">                
                <div id = "div_register" style = "text-align: center; display: none; margin-top: 5%;">
                    <h2>Register</h2>
                    <br>
                    <table align = "center" style = "width: 30%;">
                        <tr><td style = "text-align: left;"><label> Name </label> <span class = "errorSpan" > can't be blank</span></td></tr>
                        <tr><td><input type = "text" class = "form-control" id = "reg_name"><br></td></tr>

                        <tr><td style = "text-align: left;"><label> Username </label><span class = "errorSpan" > can't be blank</span></td></tr>
                        <tr><td><input type ="text" class = "form-control" id = "reg_username"><br></td></tr>

                        <tr><td style = "text-align: left;"><label> Password </label><span class = "errorSpan" > can't be blank</span></td></tr>
                        <tr><td><input type = "password" class = "form-control" id = "reg_password"><br></td></tr>

                        <tr><td style = "text-align: left;"><label> Confirm Password </label><span class = "errorSpan" > can't be blank</span></td></tr>
                        <tr><td><input type =  "password" class = "form-control" id = "reg_conf_password"><hr></td></tr>
                        <tr><td style = "text-align: left;"><label> Name of wish list </label><span class = "errorSpan" > can't be blank</span></td></tr>
                        <tr><td><input type = "text" class = "form-control" id = "reg_listname"><br></td></tr>
                        <tr><td style = "text-align: left;"><label> Description of wish list</label><span class = "errorSpan" > can't be blank</span></td></tr>
                        <tr><td><textarea class = "form-control" rows = "3" id = "reg_listdescr" style = "resize: none;"></textarea><br></td></tr>
                        <tr><td><button class = "btn btn-info" id = "registerbutton" style = "width: 100%">Create account</button><br><br></td></tr>
                        <tr><td><p id = "p_regerror" style = "color:red;"></p><div id = "d_mess" ></div><hr></td></tr>



                        <tr><td style="text-align: left;">Already have an account? <a id = "log_link" style = "cursor: pointer; text-decoration: none;">Sign in &#8227;</a><br><br><br></td></tr>
                    </table>
                </div>

                <div id = "div_login" style = "text-align: center; margin-top: 10%;  ">
                    <h2>Login</h2>
                    <br>                        
                        <table align = "center" style = "width: 30%;">
                            <tr><td style = "text-align: left;"><label>Username</label><span class = "errorSpan" > can't be blank</span></td></tr>
                            <tr><td><input type = "text" class = "form-control" id = "log_username"><br></td></tr>

                            <tr><td style = "text-align: left;"><label>Password</label><span class = "errorSpan" > can't be blank</span></td></tr>
                            <tr><td><input type = "password" class = "form-control" id = "log_password"><br></td></tr>

                            <tr><td><input type = "submit" class = "btn btn-info" id = "loginbutton" style = "width: 100%" value = "Login"><br><br></td></tr>
                            <tr><td><p id = "p_logerror" style = "color:red;"></p><hr></td></tr>
                            <tr><td style = "text-align: left;">New member? <a id = "reg_link" style = "cursor: pointer; text-decoration: none;">Create an account &#8227;</a></td></tr>
                        </table>
                </div>
            
            </div> 
        </div>     
        <div id = "div_logged_area" class = "container-fluid" style = "height: 100vh; display: none;" ></div> 
        <script src = "http://localhost/ci/static/myscript.js"></script>    
    </body>
</html>