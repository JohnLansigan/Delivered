<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div id='nav-container'>
        <a href = "index.php"><img id='logo' src="icon.png" alt="logo.png"></a>
        <div class="hamburger-menu" onclick="menuIcon(this)">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <div id='middle-nav'>
            <a href="index.php"><button id='home'>Home</button></a>
            <a href="about.php"><button id='about'>About</button></a>
            <a href="terms.php"><button id='terms'>Terms</button></a>
            <a href="create.php"><button id='create'>Create</button></a>
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
  <div class="dashboard-layout">
    <nav class="sidebar">
      <nav class="nav-menu">
        <div class="search-bar">
          <div class="search-input">
            <img src="search.png" alt="Search" class="search-icon" />
            <span class="search-text">Search</span>
          </div>
          <img src="clear.png" alt="Menu" class="menu-icon" />
        </div>  
        <a href="#" class="menu-item active">DASHBOARD</a>
        <a href="#" class="menu-item">USERS</a>
        <a href="#" class="menu-item">ANALYTICS</a>
      </nav>
    </nav>

      
        <main class="main-content">
          <section class="stats-grid">
            <article class="stat-card users-card">
              <div class="card-content">
                <div class="stat-info">
                  <img src="users.png" alt="Users" class="stat-icon" />
                  <h3 class="stat-title">TOTAL USERS</h3>
                  <p class="stat-value">#####</p>
                </div>
              </div>
            </article>
      
            <article class="stat-card messages-card">
              <div class="card-content">
                <img src="favicon.png" alt="Messages" class="stat-icon" />
                <h3 class="stat-title">TOTAL MESSAGES DELIVERED</h3>
                <p class="stat-value">#####</p>
              </div>
            </article>
      
            <article class="stat-card active-users-card">
              <div class="card-content">
                <div class="stat-info">
                  <img src="users.png" alt="Active Users" class="stat-icon" />
                  <h3 class="stat-title">ACTIVE USERS</h3>
                  <p class="stat-value">#####</p>
                </div>
              </div>
            </article>
      
            <article class="stat-card flagged-card">
              <div class="card-content">
                <img src="flagged.png" alt="Flagged" class="stat-icon" />
                <h3 class="stat-title">FLAGGED MESSAGES</h3>
                <p class="stat-value">#####</p>
              </div>
            </article>
          </section>
      
          <button class="action-button view-analysis">View Analysis</button>
      
          <section class="analytics-section">
            <div class="analytics-grid">
              <article class="terms-card">
                <h3 class="card-title">MOST USED TERMS</h3>
                <hr class="divider" />
                <div class="terms-content">
                  <div class="terms-list">
                    1. "Mom"<br />
                    2. "Dad"<br />
                    3. "Bro"<br />
                    4. Name<br />
                    5. Name
                  </div>
                  <div class="terms-count">
                    256<br />
                    209<br />
                    187<br />
                    87<br />
                    54
                  </div>
                </div>
              </article>
      
              <article class="activity-card">
                <h3 class="card-title">Recent Activity</h3>
                <hr class="divider" />
                <div class="activity-feed">
                  <p class="activity-item">@Username posted a message.</p>
                  <p class="activity-item">
                    @<span class="highlight">Admin</span> removed a
                    <span class="highlight">flagged</span> message.
                  </p>
                  <p class="activity-item">
                    @<span class="highlight">Admin</span> suspended @Username for
                    <span class="highlight"># days</span>
                  </p>
                  <p class="activity-item">@Username posted a message.</p>
                </div>
              </article>
            </div>
          </section>
      
          <div class="action-buttons">
            <button class="action-button">View All Users</button>
            <button class="action-button">Review Flagged</button>
          </div>
        </main>
      </div>
      
</body>
<script>
  function menuIcon(x) {
  x.classList.toggle("change");
  const sidebar = document.querySelector(".sidebar");
  const dashboardLayout = document.querySelector(".dashboard-layout");
  sidebar.classList.toggle("open");
  dashboardLayout.classList.toggle("sidebar-open");
}
</script>
</html>