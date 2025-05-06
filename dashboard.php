<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
</head>
<body>
    
        <div id='nav-container'>
        <a href = "index.php"><img id='logo' src="icon.png" alt="logo.png"></a>

        <div id='middle-nav'>
            <a href="index.php"><button id='home'>Home</button></a>
            <a href="dashboard.php"><button id='dashboard'>Dashboard</button></a>
            <a href="users.php"><button id='users'>Users</button></a>
        </div>

        <?php
          session_name("session_delivered");
          session_start();
          if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
              echo "<div class='dropdown'>";
              echo "  <a href='account.php'><button class='dropdown-button'><img src='profile.png' alt='profile.png'><span>" . htmlspecialchars($_SESSION["username"]) . "</span></button></a>";
              echo "  <div class='dropdown-content'>";
              echo "    <a href='logout.php'>Logout</a>";
              echo "  </div>";
              echo "</div>";
          } else {
              echo "<a href='login.php'><button id='login'><img src='profile.png' alt='profile.png'>Login</button></a>";
          }
        ?>

    </div>
  
      
</body>

</script>
</html>