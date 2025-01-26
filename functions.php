<?php
function check_login($con)
{
    if(isset($_SESSION['CustSSN']))
    {
        $id=$_SESSION['CustSSN'];
        $query= "select * from customer where CustSSN = '$id' limit 1";
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
function generateRandomNumber($length = 4) {
    return rand(pow(4, $length-1), pow(4, $length)-1);
}
?>