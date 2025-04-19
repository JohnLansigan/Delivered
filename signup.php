<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="signup.css">

    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    
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

            <img id='profile' src="profile.png" alt="profile.png">

            <button id='user'>Login</button>

        </div>

    </div>

    <form id='form-container'>

        <h1>Sign Up</h1>

        <fieldset>
            
            <legend>Account Details</legend>

            <label for="email">Email</label>
            <input id='email' type="text"> 

            <label for="username">Username</label>
            <input id='username' type="text"> 

            <label for="password">Password</label>
            <input id='password' type="text"> 

        </fieldset>
        
        <fieldset>
            
            <legend>Personal Information</legend>

            <label for="fname">First Name</label>
            <input id='fname' type="text"> 

            <label for="lname">Last Name</label>
            <input id='lname' type="text"> 

            <label for="email">Email</label>
            <input id='email' type="text"> 

            <label for="address">Address</label>
            <input id='address' type="text"> 

        </fieldset>

        <button>Sign Up</button>
        
    </form>
   
</body>

</html>