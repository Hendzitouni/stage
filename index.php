<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            background-color: #f5f7fa;
        }

        .container {
            display: flex;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
            width: 800px;
            max-width: 100%;
        }

        .image-section {
            flex: 1;
            background-color: #eaefff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .image-section img {
            max-width: 100%;
            height: auto;
        }

        .form-section {
            flex: 1;
            padding: 40px;
        }

        .form-section h2 {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        button {
            background-color: #2e5bcc;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        .register {
            margin-top: 15px;
            text-align: center;
        }

        .register a {
            color: red;
            text-decoration: none;
        }

        .or-divider {
            text-align: center;
            margin: 20px 0;
            color: #888;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="image-section">
        <img src="img/image.png" alt="Login Illustration">
    </div>
    <div class="form-section">
        <div  style="margin:15px;text-align:center;color:blue; font-size:40px;font-weight:500;">WELCOME</div>
        <form method="post" action="login.php">
            <div class="form-group">
                <input type="text" name="login" placeholder="Login" required>
            </div>
            <div class="form-group">
                <input type="password" name="mot_de_passe" placeholder="Password" required>
            </div>
           
            <button type="submit">LOGIN</button>
        </form>
        
    </div>
</div>
</body>
</html>
