<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Message Analytics</title>
    <link rel="stylesheet" href="template.css">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.cdnfonts.com/css/glacial-indifference-2" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            session_start(); // Ensure session is started to access $_SESSION variables
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

    <div id='hourlyMessages'>
        <h2>Messages Sent Per Hour (Last 24 Hours)</h2>
        <canvas id="messagesPerHourChart"></canvas>
    </div>

    <div id='hourlyUsers'>
        <h2>Messages Sent Per Hour (Last 24 Hours)</h2>
        <canvas id="usersPerHourChart"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('messagesPerHourChart').getContext('2d');
        let messageChart; // Variable to hold the chart instance

        function fetchDataAndRenderChart() 
        {
            fetch('hourly_messages.php') // Path to your PHP script
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(apiData => {
                    if (apiData.error) {
                        console.error('Error from server:', apiData.error);
                        document.getElementById('analytics').innerHTML = '<p>Error loading chart data: ' + apiData.error + '</p>';
                        return;
                    }

                    if (messageChart) {
                        messageChart.destroy();
                    }

                    messageChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: apiData.labels, 
                            color: 'white',
                            datasets: [{
                                label: 'Total Messages', 
                                data: apiData.data,
                                fill: true,
                                borderColor: '#2791f5',
                                backgroundColor: '#2791f56a',
                                tension: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true, // Set to false if you want to control width/height independently more strictly
                            font:{family: 'Glacial Indifference'},
                            scales: {
                                y: {
                                    beginAtZero: true, // Start Y-axis at 0
                                    title: {
                                        display: true,
                                        text: 'Total Messages',
                                        color: 'white',
                                        font:{family: 'Glacial Indifference'}
                                    },
                                    ticks: {
                                        stepSize: 1,
                                        color: 'white',
                                        font:{family: 'Glacial Indifference'}
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Time (Hour Slot)',
                                        color: 'white',
                                        font:{family: 'Glacial Indifference'}
                                    },
                                    ticks: {
                                        color: 'white',
                                        font:{family: 'Glacial Indifference'}
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top',
                                    color: 'white',
                                    font:{family: 'Glacial Indifference'}
                                },
                                title: {
                                    display: true,
                                    text: 'Hourly Message Volume',
                                    color: 'white',
                                    font:{family: 'Glacial Indifference'}
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching or parsing data:', error);
                    document.getElementById('analytics').innerHTML = '<p>Could not load chart. ' + error.message + '</p>';
                });
        }

        fetchDataAndRenderChart(); 
    });

    document.addEventListener('DOMContentLoaded', function () {
    const usersCtx = document.getElementById('usersPerHourChart').getContext('2d');
    let userChart;
    const chartFont = 'Glacial Indifference';

    function fetchDataAndRenderUsersChart() {
        fetch('hourly_users.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network error: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('Error from server (users):', data.error);
                    document.getElementById('usersMessages').innerHTML = '<p>Error loading chart data: ' + data.error + '</p>'; // Correct ID
                    return;
                }

                if (userChart) {
                    userChart.destroy();
                }

                userChart = new Chart(usersCtx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'New Users',
                            data: data.data,
                            fill: true,
                            borderColor: '#4caf50',
                            backgroundColor: 'rgba(76, 175, 80, 0.3)',
                            tension: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        font: {
                            family: chartFont
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Users',
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
                                },
                                ticks: {
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    },
                                    callback: function(value) {
                                        return value;
                                    }
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Time (Hour)',
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
                                },
                                ticks: {
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Users Created Per Hour (Last 24 Hours)',
                                color: 'white',
                                font: {
                                    family: chartFont
                                },
                                padding: {
                                    bottom: 20
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                document.getElementById('usersMessages').innerHTML = '<p>Could not load chart. ' + error.message + '</p>'; // Correct ID
            });
    }

    fetchDataAndRenderUsersChart();
    setInterval(fetchDataAndRenderUsersChart, 300000);
});
    
    </script>

</body>
</html>