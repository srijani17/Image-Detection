<?php 
    $arr = array();
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = $_POST["email"];
        $con = new mysqli("localhost" , "root" , "" , "users_database");
        if($con->connect_error){
            $arr["userExists"] = false;
        }else{
            $query_string = "SELECT * from users where email = '$email'";
            $res = $con->query($query_string);
            if($res->num_rows > 0){
                $arr["userExists"] = true;
            }else{
                $arr["userExists"] = false;
            }
            $con->close();
        }
    }else{
        $arr["userExists"] = true;
    }
    echo json_encode($arr);
?>