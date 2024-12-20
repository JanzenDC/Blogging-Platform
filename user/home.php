<?php
session_start();
require 'backend/db_conn.php';

// Check if user is an admin
$isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : '0';

// Fetch events from the database
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$events_result = $conn->query($sql);

?>
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
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            color: #4A4947;
            line-height: 1.6;
            padding-top: 80px;
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
            <a href="home.php" class="active">Home</a>
            <a href="blogging-platform.php">Blogging Platform</a>
            <a href="leaderboard.php">Leaderboard</a>
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

    <!-- Where To Section -->
    <div class="where-to">
        <h1 id="category-heading">Where to?</h1> <!-- Default heading -->
        <div class="search-container">
            <div class="categories">
                <span class="active">Search All</span>
                <span>Tourist Spots</span>
                <span>Things to Do</span>
                <span>Restaurants</span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search" />
                <button>Search</button>
            </div>
        </div>
    </div>

    <style>
    /* Where To Section */
        .where-to {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(45deg, #1e3c72, #2a5298)
        }

        .where-to h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;
        }

    /* Categories (Tabs) */
        .categories {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #fff;
        }

        .categories span {
            cursor: pointer;
            padding: 5px 10px;
            position: relative;
            transition: color 0.3s ease;
        }

        .categories .active {
            color: #fff;
            font-weight: bold;
        }

        .categories .active::after {
            content: "";
            display: block;
            margin: 5px auto 0;
            width: 40%;
            height: 2px;
            background-color: #000;
        }

    /* Search Bar */
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 1px solid #ddd;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: 0 auto;
        }

        .search-bar input {
            border: none;
            outline: none;
            font-size: 1rem;
            flex: 1;
            padding: 10px;
            border-radius: 50px;
        }

        .search-bar input::placeholder {
            color: #aaa;
        }

        .search-bar button {
            background-color: #000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .search-bar button:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
    const categories = document.querySelectorAll('.categories span');

    // Add click event listener to each category span
    categories.forEach(category => {
        category.addEventListener('click', function() {
            // Remove 'active' class from all categories
            categories.forEach(cat => cat.classList.remove('active'));
            // Add 'active' class to the clicked category
            this.classList.add('active');
        });
    });
    </script>

    <!-- Ask Section -->
    <section class="ask-section">
        <div class="ask-header">
            <h1>Ask our AI assistant</h1>
            <span class="beta-tag">BETA</span>
        </div>
        
        <div class="suggestions">
            <button class="suggestion-btn">Learn about Japanese tea ceremonies</button>
            <button class="suggestion-btn">What is the significance of Indian festivals?</button>
            <button class="suggestion-btn">Explore the history of Brazilian Carnival</button>
            <button class="suggestion-btn">What are the traditional dances of Spain?</button>
            <button class="suggestion-btn">Understand Chinese New Year customs</button>
            <button class="suggestion-btn">What are some famous Italian food traditions?</button>
            <button class="suggestion-btn">How does the Moroccan culture celebrate Eid?</button>
        </div>
        
        <div class="ask-input">
            <input type="text" placeholder="Enter your question" id="user-question">
            <button id="ask-btn">Ask</button>
        </div>
    </section>
    

    <style>
    /* Ask Section Styling */
        .ask-section {
            background: linear-gradient(135deg, #154eb8, #18315e); 
            padding: 40px;
            max-width: 2200px;
            margin: 30px auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            text-align: center;
            color: white;
            transition: all 0.3s ease-in-out;
        }
        
        .ask-header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .beta-tag {
            font-size: 1rem;
            background-color: #e4b1e6;
            color: #4b2c7b;
            padding: 8px 15px;
            border-radius: 20px;
            margin-top: 10px;
            display: inline-block;
        }
        
        .suggestions {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .suggestion-btn {
            background-color: #ffffff;
            color: #3a45e0;
            border: none;
            padding: 15px 25px;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .suggestion-btn:hover {
            background-color: #ffffff;
            transform: translateY(-3px); 
        }
        
        .ask-input {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .ask-input input {
            padding: 15px;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            width: 70%;
            outline: none;
            transition: all 0.3s ease;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
            background-color: #f8f9fc;
        }
        
        .ask-input input:focus {
            border: 2px solid #000000;
            box-shadow: 0px 0px 10px rgba(108, 75, 149, 0.3);
        }
        
        .ask-input button {
            padding: 15px 30px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .ask-input button:hover {
            background-color: #000;
            transform: translateY(-3px); 
        }
        
        .ask-input button:active {
            transform: translateY(1px); 
        }
    </style>

    <script>
    document.getElementById('ask-btn').addEventListener('click', function() {
        const question = document.getElementById('user-question').value;
        if (question) {
            alert(`You asked: ${question}`);
            document.getElementById('user-question').value = ''; 
        } else {
            alert('Please enter a question.');
        }
    });
    </script>
    
    <!-- About Section -->
    <div class="about">
        <h1>About Kulturifiko</h1>
        <div class="about-logo">
            <img src="https://scontent.xx.fbcdn.net/v/t1.15752-9/462567709_1724925585031052_4490126238712417040_n.png?_nc_cat=109&ccb=1-7&_nc_sid=0024fc&_nc_ohc=aXcrO29n7uIQ7kNvgHCi3nC&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.xx&oh=03_Q7cD1QEYs_r8YD6E0edmvQDXiy__0n-15fylEZhQIi5GI1RD2Q&oe=676A986A" alt="Kulturifiko Logo" />
        </div>
        <p>At Kulturifiko, we believe in the power of cultural exchange and understanding. Our platform connects people from around the world, offering a space to discover diverse cultural experiences, events, and communities.</p>
    </div>

    <style>
    /* About Section */
        .about {
            text-align: center;
            padding: 60px 20px;
            background-color: #fff;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .about h1 {
            font-size: 2.8rem;
            color: #365486;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .about p {
            font-size: 1.2rem;
            color: #4A4947;
            line-height: 1.8;
            margin-bottom: 40px;
        }
    </style>

    <!-- Blog Previews Section -->
    <section class="blog-previews">
        <h2>Top Blog Previews</h2>
        <div class="blog-card-container">
        <!-- Blog Card 1 -->
        <div class="blog-card">
            <img src="https://i.pinimg.com/736x/1e/8d/4b/1e8d4b0c3c846839663d8bf9132425b4.jpg" alt="Exploring Japan">
            <div class="blog-card-info">
                <h3>Exploring Japan: A Journey Through Tradition and Modernity</h3>
                <p>Discover how Japan seamlessly blends ancient customs with cutting-edge technology, from the serenity of Kyoto’s temples to the neon lights of Tokyo.</p>
            </div>
        </div>
        <!-- Blog Card 2 -->
        <div class="blog-card">
            <img src="https://i.pinimg.com/736x/cb/bc/2e/cbbc2e31f6682b2289fb2e95f9ccd278.jpg" alt="Festival of Colors">
            <div class="blog-card-info">
                <h3>Festival of Colors: Holi Celebrations in India</h3>
                <p>Immerse yourself in the vibrant festival of Holi, where people across India celebrate the arrival of spring with a riot of colors and joyous music.</p>
            </div>
        </div>
        <!-- Blog Card 3 -->
        <div class="blog-card">
            <img src="https://i1.wp.com/wpcdn.us-east-1.vip.tn-cloud.net/www.nhmagazine.com/content/uploads/2022/04/o/z/mexicanrestaurant.jpg" alt="Cuisine of Mexico">
            <div class="blog-card-info">
                <h3>Flavors of Mexico: A Culinary Adventure</h3>
                <p>Experience the rich and diverse flavors of Mexican cuisine, from street tacos in Mexico City to traditional mole in Oaxaca.</p>
            </div>
           </div>
        </div>
    </section>

    <style>
    /* Blog Previews */
        .blog-previews {
    background-color: #ffffff;
        }

        .blog-card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .blog-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(30% - 20px);
            transition: transform 0.3s ease;
        }

        .blog-card:hover {
            transform: scale(1.05);
        }

        .blog-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .blog-card-info {
           padding: 15px;
        }

        .blog-card-info h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #000;
        }

        .blog-card-info p {
           font-size: 0.9rem;
        color: #666;
        }
    </style>

    <!-- Events Section -->
    <section class="events">
    <h2>Upcoming Events</h2>

    <!-- Show form to add event if user is admin -->
    <?php if ($isAdmin == '1'): ?>
        <button onclick="toggleEventForm()" id="toggle-form-btn" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 16px; border-radius: 5px; transition: background-color 0.3s;">
            Add New Event
        </button>

        <div id="event-form" style="display:none; margin-top: 20px; padding: 20px; background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 8px; max-width: 600px; margin: 0 auto;">
            <form method="POST" action="add_event.php" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                <label for="event_name" style="font-size: 14px; margin-bottom: 5px;">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required style="padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                
                <label for="event_date" style="font-size: 14px; margin-bottom: 5px;">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required style="padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                
                <label for="event_location" style="font-size: 14px; margin-bottom: 5px;">Event Location:</label>
                <input type="text" id="event_location" name="event_location" required style="padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px;">
                
                <label for="event_description" style="font-size: 14px; margin-bottom: 5px;">Event Description:</label>
                <textarea id="event_description" name="event_description" required style="padding: 8px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px; min-height: 100px;"></textarea>
                
                <label for="event_image" style="font-size: 14px; margin-bottom: 5px;">Event Image:</label>
                <input type="file" id="event_image" name="event_image" required style="font-size: 14px; margin-bottom: 10px;">
                
                <button type="submit" name="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 16px; border-radius: 5px; transition: background-color 0.3s; margin-top: 10px;">
                    Submit Event
                </button>
            </form>
        </div>
    <?php endif; ?>

    <!-- Event Cards -->
    <div class="event-card-container">
        <?php if ($events_result->num_rows > 0): ?>
            <?php while ($event = $events_result->fetch_assoc()): ?>
                <div class="event-card">
                    <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['event_name']); ?>">
                    <div class="event-card-info">
                        <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                        <p>Date: <?php echo date("F j, Y", strtotime($event['event_date'])); ?></p>
                        <p>Location: <?php echo htmlspecialchars($event['event_location']); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($event['event_description'])); ?></p>
                    </div>
                    <?php if ($isAdmin == '1'): ?>
                        <form method="POST" action="delete_event.php" style="display:inline;">
                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                            <button type="submit" name="delete" style="padding: 5px 10px; background-color: #f44336; color: white; border: none; cursor: pointer; font-size: 14px; border-radius: 5px; transition: background-color 0.3s;">
                                Delete Event
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>
</section>


    <script>
    // Function to toggle the visibility of the event form
    function toggleEventForm() {
        const form = document.getElementById('event-form');
        const button = document.getElementById('toggle-form-btn');
        if (form.style.display === 'none') {
            form.style.display = 'block';
            button.textContent = 'Hide Event Form';
        } else {
            form.style.display = 'none';
            button.textContent = 'Add New Event';
        }
    }
    </script>

    <?php $conn->close(); ?>

    <style>
    /* Events Section */
        .events {
            background-color: #ffffff;
            margin-top: 50px;
        }

        .event-card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .event-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: calc(30% - 20px);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: scale(1.05);
        }

        .event-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .event-card-info {
            padding: 15px;
        }

        .event-card-info h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #000;
        }

        .event-card-info p {
            font-size: 0.9rem;
            color: #666;
        }
    </style>

    <!-- Rewards Section -->     
    <section id="rewards" class="rewards-section">
        <div class="container">
          <h2>Rewards Program</h2>
          <p>Earn points and redeem exciting rewards!</p>
          <div class="rewards-grid">
            <!-- Reward Card 1 -->
            <div class="reward-card">
              <img src="welcome.png" alt="Welcome Reward">
              <h3>Welcome Reward</h3>
              <p>Earn 500 bonus points when you sign up for the first time!</p>
              <span>500 Points</span>
            </div>
      
            <!-- Reward Card 2 -->
            <div class="reward-card">
              <img src="loyalty.png" alt="Loyalty Points">
              <h3>Loyalty Points</h3>
              <p>Earn 10 points for every purchase and redeem them for exclusive rewards.</p>
              <span>Ongoing</span>
            </div>
      
            <!-- Reward Card 3 -->
            <div class="reward-card">
              <img src="refer.png" alt="Refer a Friend">
              <h3>Refer a Friend</h3>
              <p>Invite your friends and get 100 points for each successful referral.</p>
              <span>100 Points</span>
            </div>
      
            <!-- Reward Card 4 -->
            <div class="reward-card">
              <img src="discount.png" alt="Discount Coupon">
              <h3>20% Off on Next Purchase</h3>
              <p>Redeem 200 points to get 20% off your next order.</p>
              <span>200 Points</span>
            </div>
      
            <!-- Reward Card 5 -->
            <div class="reward-card">
              <img src="gift.png" alt="Free Gift">
              <h3>Free Gift with Purchase</h3>
              <p>Redeem 300 points to receive a free gift on your next order.</p>
              <span>300 Points</span>
            </div>
          </div>
        </div>
      </section>
      
    <style>
    /* Rewards Section */
        .rewards-section {
          background-color: #f9f9f9;
          padding: 50px 0;
          text-align: center;
        }
        
        .rewards-section h2 {
          font-size: 2.5rem;
          margin-bottom: 10px;
        }
        
        .rewards-section p {
          font-size: 1.2rem;
          margin-bottom: 30px;
        }
        
        .rewards-grid {
          display: flex;
          flex-wrap: wrap;
          gap: 20px;
          justify-content: center;
        }
        
        .reward-card {
          background-color: white;
          border: 1px solid #ddd;
          border-radius: 8px;
          padding: 20px;
          width: 280px;
          text-align: center;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .reward-card img {
          width: 80px;
          height: 80px;
          object-fit: contain;
          margin-bottom: 15px;
        }
        
        .reward-card h3 {
          font-size: 1.5rem;
          margin-bottom: 10px;
        }
        
        .reward-card p {
          font-size: 1rem;
          margin-bottom: 15px;
        }
        
        .reward-card span {
          font-weight: bold;
          color: #27ae60;
          font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
        .rewards-grid {
          flex-direction: column;
          align-items: center;
        }

        .reward-card {
          width: 90%;
        }
        }      
    </style>

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