<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturifiko</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <body>
    <style>
    /* General */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: #ffffff;
        }

        section {
            padding: 50px 20px;
            background-color: #f9f9f9;
        }

        h2 {
           font-size: 2rem;
           margin-bottom: 10px;
           color: #333;
        }
    </style>
    
    <!-- Navigation Bar -->
    <div class="navbar">
        <div style="display: flex; align-items: center;">
            <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462567709_1724925585031052_4490126238712417040_n.png?_nc_cat=109&ccb=1-7&_nc_sid=0024fc&_nc_ohc=aXcrO29n7uIQ7kNvgHCi3nC&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QEYs_r8YD6E0edmvQDXiy__0n-15fylEZhQIi5GI1RD2Q&oe=676A986A" alt="Kulturifiko Logo">
            <h1>Kulturifiko</h1>
        </div>
        <div>
            <a href="home.php">Home</a>
            <a href="blogging-platform.php">Blogging Platform</a>
            <a href="leaderboard.php" class="active">Leaderboard</a>
            <a href="store.php">Store</a>
            <div class="dropdown">
                <a href="#" class="dropdown-btn" onclick="toggleDropdown()">Menu ▼</a>
                <div class="dropdown-content">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
            <a href="login.php">Log In</a>
        </div>
    </div>

    <style>
    /* Navigation Bar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #365486;
            padding: 20px 40px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar img {
            height: 50px;
            width: auto;
        }

        .navbar h1 {
            color: #DCF2F1;
            font-size: 2rem;
            font-weight: 600;
            margin-left: 10px;
        }

        .navbar a {
            color: #DCF2F1;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #7FC7D9;
            color: #0F1035;
        }

        .navbar a.active {
            background-color: #000;
            color: #fff;
        }
        
    /* Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 150px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

    /* Toggle class for show/hide */
        .show {
            display: block;
        }
    </style>

    <script>
        function toggleDropdown() {
            var dropdownContent = document.querySelector(".dropdown-content");
            dropdownContent.classList.toggle("show");
        }
    </script>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>🏆 Interactive Leaderboard 🏆</h1>
        <div class="leaderboard-container">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Name</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody id="leaderboard">
                    <!-- Dynamically filled with JS -->
                </tbody>
            </table>
        </div>
    </div>
    
    <style>
        /* Main Leaderboard Section */
    .main-content {
        margin: 20px auto;
        padding: 20px;
        max-width: 1200px;
        transition: margin-left 0.3s ease;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 2.8rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* Leaderboard Container */
    .leaderboard-container {
        background: #040677;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        padding: 20px;
        max-width: 100%;
        margin: 20px auto;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 1rem;
    }

    thead {
        background: linear-gradient(to right, #1e6dd4, #2575fc);
        color: white;
    }

    th,
    td {
        text-align: center;
        padding: 10px 15px;
    }

    tr:nth-child(even) {
        background-color: #0a0f52;
    }

    tr:hover {
        background: linear-gradient(to right, #0d2de0, #061069);
        transform: translateX(5px);
        transition: transform 0.2s ease-in-out;
    }

    /* Add Responsiveness for Mobile */
    @media (max-width: 768px) {
        h1 {
            font-size: 2.2rem;
        }

        table {
            font-size: 0.9rem;
        }

        .leaderboard-container {
            padding: 15px;
        }
    }
    </style>

<script>
    const names = [
        "John Doe", "Jane Smith", "Alex Johnson", "Maria Gonzalez", "Chris Evans",
        "Linda Carter", "James Anderson", "Patricia Brown", "Robert White", "Emily Adams",
        "David Harris", "Jessica Martinez", "Daniel Thompson", "Sarah Wilson", "Ethan Moore",
        "Hannah Scott", "Brian Hall", "Samantha Allen", "Kevin Young", "Natalie King",
        "Justin Wright", "Mia Lopez", "Adam Clark", "Ava Robinson", "William Lewis",
        "Sophia Walker", "Mason Hall", "Isabella Allen", "Logan Nelson", "Zoe Carter",
        "Oliver Baker", "Lily Rivera", "Lucas Phillips", "Emma Murphy", "Henry Cook",
        "Grace Rogers", "Jack James", "Abigail Evans", "Samuel Turner", "Ella Flores",
        "Aiden Gray", "Scarlett Perry", "Sebastian Green", "Aria Brooks", "Carter Ward"
    ];

    const tbody = document.getElementById('leaderboard');

    // Dynamically fill leaderboard rows
    for (let i = 0; i < 50; i++) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${i + 1}</td>
            <td>${names[i]}</td>
            <td>${Math.floor(Math.random() * 1000)}</td>
        `;
        tbody.appendChild(row);
    }
</script>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kulturifiko. All Rights Reserved.</p>
    </footer>

    <style>
    /* Footer */
        footer {
            background-color: #365486;
            color: #fff;
            text-align: center;
            padding: 25px;
            margin-top: 60px;
        }
    </style>

    </body>
</head>
</html>