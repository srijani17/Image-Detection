<?php
$arr = array();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Establish database connection
    $con = new mysqli("localhost", "root", "", "users_database");
    if ($con->connect_error) {
        $arr["success"] = false;
        $arr["message"] = "ErrorConnectingDatabase";
    } else {
        // Prepare and execute a parameterized query
        $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email , $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User exists, you might want to check the password here
            $arr["success"] = true;
            $arr["message"] = "UserExists";
        } else {
            $arr["success"] = false;
            $arr["message"] = "UserDoesNotExist";
        }

        // Close statement and database connection
        $stmt->close();
        $con->close();
    }
} else {
    $arr["success"] = false;
    $arr["message"] = "UsePostMethodToSendData";
}
echo json_encode($arr);
?>