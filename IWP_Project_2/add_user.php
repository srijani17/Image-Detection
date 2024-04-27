<?php 
    $arr = array();
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $first_name = $_POST["first_name"];
        $last_name  = $_POST["last_name"];
        $email      = $_POST["email"];
        $password   = $_POST["password"];
        $birthday   = $_POST["birthday"];
        $gender     = $_POST["gender"];
        $con = new mysqli("localhost" , "root" , "" , "users_database");
        if($con->connect_error){
            $arr["success"] = false;
            $arr["message"] = "CouldNotConnectToDatabase";
        }else{
            $query_string = "INSERT INTO users (email , first_name , last_name , password , birthday , gender) values ('$email' , '$first_name' , '$last_name' , '$password' , '$birthday' , '$gender')";
            if($con->query($query_string)){
                $arr["success"] = true;
                $arr["message"] = "UserAdded";
            }else{
                $arr["success"] = false;
                $arr["message"] = "CouldNotAddUser";
            }
            $con->close();
        }
    }else{
        $arr["success"] = false;
        $arr["message"] = "UsePostMethodToSendData";
    }
    echo json_encode($arr);
?>
