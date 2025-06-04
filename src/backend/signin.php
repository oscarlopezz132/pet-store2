<?php
 include('../config/database.php');
sessiom_start();
if(isset($_SESSION['user_id'])){
     header('Refresh: 0; url=http://127.0.0.1/pet-store2/src/');
}
$email =$_POST['e_mail'];
$passw =$_POST['p_assw'];

//$hashed_password =password_hash($passw,PASSWORD_DEFAULT);
$hashed_password = $passw;

$sql = " 
select u.id from users u where email = '$email' and passw ='$hashed_password' group by u.id
";
$res = pg_query($conn, $sql);
if(res){
    $row = pg_fetch_assoc($res);
    if($row['total' ]> 0){
        
        $sql_data = " 
select u.id, u.firstname
 from users u where email = '$email' and passw ='$hashed_password' group by u.id
";
        $res_data = pg_query($conn, $sql_data);
        $row_data = pg_fetch_assoc($res_data);
        $_SESSION['user_id'] = $row_data['id'];
        $_SESSION['user_id'] = $row_data['firstname'];
        header('Refresh: 0; url=http://127.0.0.1/pet-store2/src/');
    }else{
        echo "<script>alert('login failed !!!!')</script>";
        header('Refresh: 0; url=http://127.0.0.1/pet-store2/src/login.html');
    }
}


?>