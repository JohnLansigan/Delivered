<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Delivered]</title>

    <link rel="icon" type="image/x-icon" href="favicon.png">
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="about.css">

    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>

<body>

    <div id='nav-container'>

        <a href = "index.php"><img id='logo' src="icon.png" alt="logo.png"></a>

        <div id='middle-nav'>

            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>
            <?php
                session_name("session_delivered");
                session_start();

                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $dbname = "db_delivered";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
                    $loggedInUserID = $_SESSION["userID"];

                    $adminCheckSql = "SELECT adminID FROM tbl_admins WHERE userID = ?";
                    $adminCheckStmt = $conn->prepare($adminCheckSql);
                    $adminCheckStmt->bind_param("i", $loggedInUserID);
                    $adminCheckStmt->execute();
                    $adminCheckResult = $adminCheckStmt->get_result();

                    if ($adminCheckResult->num_rows > 0) {
                        echo "<a href='dashboard.php'><button id='dashboard'>Admin</button></a>";
                    }
                    $adminCheckStmt->close();
                }
            ?>

        </div>
            <?php
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
    </div>
    <div class="desc1">
        <p>
            <h1><center>LET YOUR MESSAGE <br>
            BE DELIVERED.</center></h1><br><br><Br> </div>

            <center><div class = "wrapper">
                <i id="left" class = "fa-solid fa-angle-left"></i>
                <div class = "carousel">
                    <img src = "abt1.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt2.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt3.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt4.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt1.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt2.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt3.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt4.png" alt = "img" height = "26vw" width = "26vw">
                    <img src = "abt1.png" alt = "img" height = "26vw" width = "26vw">
                </div>
                <i id = "right" class = "fa-solid fa-angle-right"></i>
            </div></center>
                 
            <br><br><div class = "desc2"><h3>A messaging website addressed to those we can’t, or choose not to, communicate directly. Here, you can anonymously post a message dedicated to a person and be part of our growing community by browsing through the submissions and discover the common threads that weave through our experiences of love, loss, hope, and the myriad of feelings that often remain trapped within. Who knows? The messages you are reading could be about you!</h3>
        </p>
    </div><br>

    <div id="panel1">
        <div id="aboutUsPic">
            <img id='ourPic' src="aboutPic.jpg" alt="img" height = "100%" width = "100%">
        </div>
        <div class="aboutUsText">
            <center>
                <div id="aboutUsTitle">
                    <Center><h2>About Us</h2></Center>
                </div>
            <br>
            <h3>Hello! We are a group of students from the UST College of Information and Computing Sciences. We created this project in partial fulfillment of our requirements for our school. We also wanted to create a freedom wall-like website where users can freely express themselves or lift their feelings by anonymously posting a message to a person they can’t directly send the message to.</h3>
            </center>
        </div>
    </div>

    <div id="panel2">
        <div class="aboutUsText2">
            <center>
                <div id="aboutUsTitle">
                    <Center><h2>For You</h2></Center>
                </div>
                <br>

            <h3>We hope that through this platform, users will find comfort in knowing they are not alone in their thoughts and emotions. By allowing anonymous posts, we aim to encourage honesty and vulnerability without fear of judgment or exposure. Each message shared on our site reflects real feelings and experiences, creating a space of empathy and understanding. We believe that even in silence, every voice deserves to be heard and every emotion acknowledged.</h3>
            </center>
        </div>
        <div id="aboutUsPic">
            <img id='ourPic' src="forYouPic.jpg" alt="placeholder.jpg" height = "100%" width = "100%">
        </div>
    </div>
    <br>

    <center>
    <div id="joinPanel">
        <div id="joinPanelLogo">
            <img id='ourPic' src="favicon.png" alt="placeholder.jpg" height = "120px" width = "120px">
        </div>
        <h1>Join us in a space where anonymous words<br>are delivered with meaning.</h1>
        <br>
        <center>
            <a href = "signup.php"><button class = "signupButton">To signup</button></a>
        </center>
    </div>
    </center>
    
    <br><br><br><br><br>
    
    <div id='footer-container'>

        <div>
            
            <h2>[Delivered]</h2>
            <p>a passion project.</p>
            <br>
            <br>
            <p>© 2025 [Delivered] All rights reserved</p>
    
        </div>

        <div>

            <h3>Links</h3>
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="terms.php">Terms</a>
            <a href="create.php">Create</a>

        </div>

        <div>

            <h3>The Project</h3>
            <p>News</p>
            <p>Partners</p>
            <p>Contact Us</p>
            <p>Contact Us</p>
            
        </div>

        <div>

            <h3>Services</h3>
            <p>Feedback</p>
            <p>Report Bugs</p>
            <p>Download</p>
            <p>Get Help</p>
            
        </div>

        <div>

            <h3>Socials</h3>
            <p>Instagram</p>
            <p>Facebook</p>
            <p>Twitter</p>
            <p>TikTok</p>
            
        </div>

    </div>

    <script>
        const carousel = document.querySelector(".carousel"),
        firstImg = carousel.querySelectorAll("img")[0];
        arrowIcons = document.querySelectorAll(".wrapper i");

        let isDragStart = false, prevPageX, prevScrollLeft;
        let firstImgWidth = firstImg.clientWidth + 14;


        arrowIcons.forEach(icon => {
            icon.addEventListener("click", () => {
                carousel.scrollLeft += icon.id == "left" ? - firstImgWidth : firstImgWidth;
            });
        });

        const dragStart = (e) => {
            isDragStart = true;
            prevPageX = e.pageX;
            prevScrollLeft = carousel.scrollLeft;
        }

        const dragging = (e) => {
            if(!isDragStart) return;
            e.preventDefault();
            carousel.classList.add("dragging");
            let positionDiff = e.pageX - prevPageX;
            carousel.scrollLeft = prevScrollLeft - positionDiff;
        }

        const dragStop = () => {
            isDragStart = false;
            carousel.classList.remove("dragging");
        }
        
        carousel.addEventListener("mousedown", dragStart);
        carousel.addEventListener("mousemove", dragging);
        carousel.addEventListener("mouseup", dragStop);
    </script>
    
</body>

</html>