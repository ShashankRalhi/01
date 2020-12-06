s<?php
session_start();
include("action.php");
include("customer-dashboard.php");



$obj = new connection();

if(isset($_POST['submit'])){
     $name = $_SESSION['username'];
     $newpass = md5($_POST['newupass']);
     $repass = md5($_POST['reupass']);

     if($repass==$newpass)
    {
        $sql = $obj->pass($name,$newpass);

        //if($sql){
              echo "<script>alert('Password Updated');</script>";
              session_destroy();
              header("location:login.php");
        //}
    }
    else
    {
        echo "<script>alert('New & Re-Passsword both are not same');</script>";
    }
}

?>

<div class="bookcontainer">
            <form method="POST" id="form">
               <h1 style="text-align: center;">UPDATE PASSWORD</h1>
               <hr />

               <label>New Password</label>
               <input type="Password" name="newupass" placeholder="Enter New Password"  id="newpass"><br>

               <label>Re Password</label>
               <input type="Password" name="reupass" placeholder="Enter Re-Password"  id="newpass">

               <button name="submit" class="btn">Update</button>
            </form>
</div>




<?php include("footer.php"); ?>