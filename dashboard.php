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

    <div id='analytics-container'>

        <div id='hourlyMessages'>
            <h2>Messages Delivered Per Hour</h2>
            <canvas id="messagesPerHourChart"></canvas>
        </div>

        <div id='hourlyUsers'>
            <h2>Users Created Per Hour</h2>
            <canvas id="usersPerHourChart"></canvas>
        </div>

        <div id='graph'>
            <h2>Website Totals</h2>
            <canvas id="totalsGraph"></canvas>
        </div>

        <div id='activity'>
            <h2>Messages Deleted Per Hour</h2>
            <canvas id="activityLog"></canvas>
        </div>

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
                            datasets: [{
                                label: 'New Messages', 
                                data: apiData.data,
                                fill: true,
                                borderColor: '#2791f5',
                                backgroundColor: '#2791f56a',
                                color: 'white',
                                tension: 0,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true, // Set to false if you want to control width/height independently more strictly
                            font:{family: 'Glacial Indifference'},
                            color: 'white',
                            scales: {
                                y: {
                                    beginAtZero: true, // Start Y-axis at 0
                                    title: {
                                        display: true,
                                        color: 'white',
                                        text: 'Messages',
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
                                        text: 'Time (Hourly)',
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
                                    position: 'none',
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
                                    text: 'Time (Hourly)',
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
                                position: 'none',
                                labels: {
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
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

document.addEventListener('DOMContentLoaded', function () {

    const totalsCtx = document.getElementById('totalsGraph').getContext('2d');
    let totalsChart;
    const chartFont = 'Glacial Indifference';

    function fetchAndRenderTotals() {
        fetch('totals.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('Error from server:', data.error);
                    document.getElementById('graph').innerHTML = '<p>Error loading totals: ' + data.error + '</p>';
                    return;
                }

                if (totalsChart) {
                    totalsChart.destroy();
                }

                totalsChart = new Chart(totalsCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Messages','Users', 'Admins'],
                        datasets: [{
                            label: 'Total Count',
                            data: [data.total_messages, data.total_users, data.total_admins ],
                            backgroundColor: [
                                '#36a2eb',
                                '#ff6384',
                                '#4bc0c0'
                            ],
                            borderColor: [
                                '#36a2eb',
                                '#ff6384',
                                '#4bc0c0'
                            ],
                            borderWidth: 1
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
                                ticks: {
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
                                }
                            },
                            x: {
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
                                position: 'none',
                                labels: {
                                    color: 'white',
                                    font: {
                                        family: chartFont
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching totals data:', error);
                document.getElementById('graph').innerHTML = '<p>Could not load totals data: ' + error.message + '</p>';
            });
    }

    fetchAndRenderTotals();
    setInterval(fetchAndRenderTotals, 300000); //update every 5 minutes
});

        document.addEventListener('DOMContentLoaded', function () {
            function fetchActivityLog() {
                fetch('activity_log.php')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error fetching activity log:', data.error);
                            document.getElementById('activityLog').innerHTML = '<div>Error loading activity log: ' + data.error + '</div>';
                            return;
                        }

                        const activityList = document.getElementById('activityLog');
                        activityList.innerHTML = ''; // Clear previous entries

                        data.forEach(event => {
                            const eventDiv = document.createElement('div');
                            eventDiv.textContent =  event;
                            activityList.appendChild(eventDiv);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching activity log data:', error);
                        document.getElementById('activityLog').innerHTML = '<div>Could not load activity log: ' + error.message + '</div>';
                    });
            }

            fetchActivityLog();
            setInterval(fetchActivityLog, 30000); // Update every 30 seconds
        });

    </script>

</body>
</html>