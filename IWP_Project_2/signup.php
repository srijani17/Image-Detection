<!DOCTYPE html>
<html> 
    <head> 
        <title>SignUp Page</title>
        <meta charset="utf-8">
        <style>
            body {
                background-color: black;
                color: white;
                transition: background-color 0.5s;
            }

            button {
                background-color: white;
                color: black;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 8px;
                transition: background-color 0.3s;
                background: linear-gradient(to right, #ff105f, #ffad06);
                transform: scale(1);
                transition: transform 0.3s ease;
            }

            button:hover {
                transform: scale(1.05);
            }

            .outer-container {
                display: flex;
                justify-content: center;
                align-items: center;
                border: 1px solid white;
                padding: 80px;
            }

            .container {
                border: 1px solid black;
                padding: 45px;
            }
            
            .container a{
                color: white;
                
                display: block;
                transition: color 0.3s;
            }



            #first_name , #last_name {
                padding: 12px;
                margin: 0px;
                border-radius: 8px;
            }

            #email , #password {
                width: 100%;
                margin-top: 15px;
                padding: 12px;
                box-sizing: border-box;
                border-radius: 8px;
            }

            #birthday{
                border-radius: 8px;
                padding: 10px;
            }

            #male , #female , #custom {
                width: 30%;
                padding: 5px;
                box-sizing: border-box;
                border-radius: 8px;
            }

            #alert-box {
                color: black;
                text-align: center;
                box-sizing: border-box;
                width: 100%;
                display: none;
            }
        </style>
    </head>
    <body> 
        <div class="outer-container"> 
            <div class="container"> 
                <h1>Sign Up</h1>
                <p>It's quick and easy</p>
                <hr>
                <input type="text" name="first_name" placeholder="First Name" id="first_name">
                <input type="text" name="last_name" placeholder="Last Name" id="last_name">
                <br>
                <input type="email" name="email" placeholder="Email" id="email">
                <br>
                <input type="password" name="password" placeholder="Choose a Strong Password" id="password">
                <br><br><br>
                <p>Birthday</p>
                <input type="date" name="birthday" id="birthday">
                <br><br><br>
                <p>Gender</p>
                <button id="male"><input type="radio" name="gender" value="male" id="_male">Male</button>
                <button id="female"><input type="radio" name="gender" value="female" id="_female">Female</button>
                <button id="custom"><input type="radio" name="gender" value="custom" id="_custom">Custom</button>
                <br><br><br><br>
                <button onclick="processSignup()">Sign Up</button>
                <br><br><br><br>
                <a href="./login.php">Already a registered user?<button>Sign In</button></a>
                <p id="alert-box"></p>
            </div>
            
        </div>
    </body>
    <script> 
        function processSignup(){
            let first_name = document.getElementById("first_name").value;
            let last_name = document.getElementById("last_name").value;
            let birthday = document.getElementById("birthday").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let male = document.getElementById("_male");
            let female = document.getElementById("_female");
            let custom = document.getElementById("_custom");
            if(first_name.length == 0){
                showAlert("Enter First Name" , "red" , document.getElementById("alert-box"));
                return;
            }
            if(last_name.length == 0){
                showAlert("Enter Last Name" , "red" , document.getElementById("alert-box"));
                return;
            }
            if(email.length == 0){
                showAlert("Enter Email" , "red" , document.getElementById("alert-box"));
                return;
            }
            if(birthday.length == 0){
                showAlert("Enter Date of Birth" , "red" , document.getElementById("alert-box"));
                return;
            }
            if(male.checked || female.checked || custom.checked){
                let gender = "";
                if(male.checked){
                    gender = male.value;
                }
                if(female.checked){
                    gender = female.value;
                }
                if(custom.checked){
                    gender = custom.value;
                }
                if(userExists(email)){
                    showAlert("Email ID already exists. Please GoTo Sign in Page" , "red" , document.getElementById("alert-box"));
                    return;
                }else{
                    let xhr = new XMLHttpRequest();
                    xhr.open("POST" , "./add_user.php" , false);
                    xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
                    xhr.onload = function(){
                        let response = JSON.parse(xhr.responseText);
                        if(response.success){
                            showAlert(response.message , "green" , document.getElementById("alert-box"));
                        }else{
                            showAlert(response.message , "green" , document.getElementById("alert-box"));
                            return;
                        }
                    }
                    let request_data = "first_name=" + encodeURIComponent(first_name) + "&last_name=" + encodeURIComponent(last_name) + "&email=" + encodeURIComponent(email) + "&birthday=" + encodeURIComponent(birthday) + "&password=" + encodeURIComponent(password) + "&gender=" + encodeURIComponent(gender);
                    xhr.send(request_data);
                }
            }else{
                alert("Select your Gender");
                return;
            }
        }
        function userExists(email){
            let xhr = new XMLHttpRequest();
            xhr.open("POST" , "./check_user.php" , false);
            xhr.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
            xhr.onload = function(){
                if(xhr.status == 200){
                    console.log(xhr.responseText);
                    console.log(xhr.responseText.length);
                    let response =  JSON.parse(xhr.responseText);
                    if(response.userExists){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    showAlert("Error Code " + xhr.status , "red" , document.getElementById("alert-box"));
                    return false;
                }
            }
            let request_data = "email=" + email;
            xhr.send(request_data);
        }
        function showAlert(message , color , p){
            p.innerHTML = message;
            console.log(message + " " +  color);
            p.style.color = color;
            p.style.boxSizing = "border-box";
            p.style.display = "block";
            p.style.textAlign = "center";
            p.style.width = "100%";
        }
    </script>

</html>

