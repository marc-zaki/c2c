<?php
function check_login($con)
{
    if(isset($_SESSION['National_ID']))
    {
        $id=$_SESSION['National_ID'];
        $query= "select * from users where National_ID = '$id' limit 1";
        $result=mysqli_query($con,$query);
        if($result && mysqli_num_rows($result)>0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    header("Location: login.php");
    die;
}
function generateRandomNumber($length = 10) {
    return rand(pow(10, $length-1), pow(10, $length)-1);
}
?>