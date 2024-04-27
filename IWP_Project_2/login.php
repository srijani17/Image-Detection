<html>
<head>
    <title>Login/Signup</title>
    <style> 
        .container{
            border : 1px solid black;
            display : flex;
            padding : 170px;
            flex-direction : column;
            align-items : center;
            background: black;
            
        }
        .inner-container{
            border : 1px white solid;
            padding : 60px;
            display : flex;
            flex-direction : column;
            align-items : center;
        }
        
        .inner-container h1{
            color: white;
        }

        #email , #password{
            padding : 10px;
            width : 350px;
            border-radius : 4px;
            border : 1px solid black;
        }
        #login-button{
            padding : 20px;
            box-sizing : "border-box";
            width : 300px;
            margin-top : 50px;
            border-radius : 8px;
            border : 1px solid black;
            background: linear-gradient(to right, #ff105f, #ffad06);
            transform: scale(1);
            transition: transform 0.3s ease;
        }
        
        #login-button:hover{
            transform: scale(1.05);
        }
        #signup-button{
            padding : 15px;
            box-sizing : "border-box";
            width : 150px;
            margin-top : 50px;
            border : 1px solid black;
            border-radius : 8px;
            background: linear-gradient(to right, #ff105f, #ffad06);
            transform: scale(1);
            transition: transform 0.3s ease;
        }
        
        #signup-button:hover{
            transform: scale(1.05);
        }
        #alert-box{
            display : none;
        }
    </style>
</head>
<body>
    <div class = "container"> 
        <div class = "inner-container">
            <h1> LOGIN ACCOUNT</h1>
            <input type = "email" name = "email" id = "email" placeholder = "Enter your email">
            <br>
            <input type = "password" name = "password" id = "password" placeholder = "Password">
            <br>
            <button onclick = "userLogin()" id = "login-button">
                Login
            </button>
            <p id = "alert-box"> </p>
        </div>
        <a href = "./signup.php"><button id = "signup-button">Click to Signup</button></a>
    </div>

    
    <script> 
        function showAlert(message , color , p){
            p.innerHTML = message;
            console.log(message + " " +  color);
            p.style.color = color;
            p.style.boxSizing = "border-box";
            p.style.display = "block";
            p.style.textAlign = "center";
            p.style.width = "100%";
            p.style.fontSize = "16px";
        }
        function userLogin(){
            let  email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            if(password.length > 0 && email.length > 0){
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "./verify_user.php", false);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {                    
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        let response = JSON.parse(xhr.responseText);
                        if(response.success){
                            console.log("USER VERIFIED");
                            window.location.href = "./page.html";
                        }else{
                            showAlert(response.message , "red" , document.getElementById("alert-box"));
                            return;
                        }
                    } else {
                        showAlert('Error:' +  xhr.status , "red" , document.getElementById("alert-box"));
                        return;
                    }
                };
                const form_data = "email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password);
                xhr.send(form_data);
            } else {
                if (email.length == 0) {
                    showAlert("ENTER EMAIL", "red" , document.getElementById("alert-box"));
                    return;
                }
                if (password.length == 0) {
                    showAlert("ENTER PASSWORD" , "red" , document.getElementById("alert-box"));
                    return;
                }
            }
        }
    </script>
</body>
</html>

