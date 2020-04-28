<style>
/* Container */
.container{
    width:40%;
    margin:0 auto;
}

/* Login */
#div_login{
    border: 1px solid gray;
    border-radius: 3px;
    width: 470px;
    height: 270px;
    box-shadow: 0px 2px 2px 0px  gray;
    margin: 0 auto;
}

#div_login h1{
    margin-top: 0px;
    font-weight: normal;
    padding: 10px;
    background-color: cornflowerblue;
    color: white;
    font-family: sans-serif;
}

#div_login div{
    clear: both;
    margin-top: 10px;
    padding: 5px;
}

#div_login .textbox{
    width: 96%;
    padding: 7px;
}

#div_login input[type=submit]{
    padding: 7px;
    width: 100px;
    background-color: lightseagreen;
    border: 0px;
    color: white;
}
</style>

<script src="md5.min.js"></script>
<script>
function IncreaseSecurity() {
    document.getElementById('txt_pwd').value = md5(document.getElementById('txt_pwd').value);
}
</script>

<?php
include "config.php";

if(isset($_POST['but_submit'])){

    $uname = $_POST['txt_uname'];
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);

    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser from users where username='".$uname."' and pw_hash='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            setcookie("user", [secret cookie value here]);
            header('Location: /[path]/index.php');
        }else{
            echo "Invalid username and password";
        }

    }

}
?>

<div class="container">
    <form method="post" action="/[path]/login.php" onsubmit="IncreaseSecurity()" id="form">
        <div id="div_login">
            <h1>Login</h1>
            <div>
                <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
            </div>
            <div>
                <!-- Make sure to chose a secure password, default is admin:matrix -->
                <input type="password" class="textbox" id="txt_pwd" name="txt_pwd" placeholder="Password"/>
            </div>
            <div>
                <input type="submit" value="Submit" name="but_submit" id="but_submit"/>
            </div>
        </div>
    </form>
</div>
