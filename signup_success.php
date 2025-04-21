<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Successful!</title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="signup.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <style>
        #form-container {
            text-align: center;
            padding: 30px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 50px auto;
            max-width: 600px;
        }

        h1 {
            color: green;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id='nav-container'>
        <div id='left-nav'>
            <img id='logo' src="icon.png" alt="logo.png">
            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>
        </div>
        <div id='right-nav'>
            <a href="signup.php"><img src="profile.png" id='profile' alt="profile.png"></a>
        </div>
    </div>

    <div id='form-container'>
        <h1>Sign Up Successful!</h1>
        <p>Thank you for signing up for Delivered!</p>

        <?php
        session_name("deliveredSession");
        session_start();

        if (isset($_SESSION["username"])) {
            echo "<p>You are now logged in as: <strong>" . htmlspecialchars($_SESSION["username"]) . "</strong></p>";
            echo "<p><a href='index.php' class='button-link'>Go to the Homepage</a></p>";
        } else {
            echo "<p>You can now <a href='login.php' class='button-link'>Log In</a> to your new account.</p>";
        }

        // unset($_SESSION["username"]);
        ?>
    </div>
</body>
</html>