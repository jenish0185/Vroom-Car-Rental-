<?php
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    echo "<script>console.log('User ID:', $user_id);</script>";
} else {
    // Handle the case where user ID is not provided
    // For example, redirect the user to an error page or ask them to log in again
    // This depends on your application's logic
    header("Location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vroom - Favorites</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Meddon:wght@400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/c ss2?family=Mate:wght@400&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Anek Bangla:wght@300;400;500;600;700;800&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Additional styles -->
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        header {
            height: 200px;
            background-color: #7B2CF8;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .branding {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .vroom-text {
            font-family: 'meddon';
            font-size: 32px;
            margin-bottom: 5px;
            margin-top: -70px;
        }

        .slogan-text {
            font-family: 'anek bangla';
            margin-top: -15%;
            font-size: 15px;
        }

        .nav-links {
            display: flex;
            justify-content: space-around;
            background-color: #7B2CF8;
        }

        .nav-links a {
            font-size: 20px;
            font-weight: 500;
            font-family: "Anek Bangla";
            margin-top: 100px;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin-right: 50px;
            /* Add margin between each link */
        }

        .currency-selector {
            display: flex;
            align-items: center;
        }

        .currency-btn {
            background-color: white;
            color: #7B2CF8;
            border: none;
            padding: 15px 25px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 20px;
            margin-top: -70px;
        }

        .profile-picture {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            margin-right: -100px;
            background-image: url('image.png');
            /* Replace 'images.png' with your image path */
            background-size: cover;
            border: none;
            /* Remove the border */
        }

        .manage-btn {
            background-color: #ffffff;
            color: #7B2CF8;
            border: none;
            padding: 15px 25px;
            border-radius: 5px;
            cursor: pointer;
        }



        .single-panel {
            padding: 40px 100px;
            /* Adjust the padding as needed */
            background-color: #f2f2f2;
            border-radius: 5px;
            width: 40%;
            /* Adjust the width of the panel */
            height: auto;
            position: absolute;
            bottom: -600px;
            left: 15%;
            /* Enable positioning */
        }

        .single-panel .step-text {
            font-size: 18px;
            /* Adjust the font size as needed */
            line-height: 2;
            /* Adjust the line-height value as needed */
        }

        .single-panel .step-text h2 {
            font-weight: bold;
            /* Make the heading double layer bold */
        }

        .single-panel .step-text p {
            font-weight: 500px;
            /* Make other text bold */
        }

        /* Style for the image */
        .background-img {
            position: absolute;
            top: 60%;
            left: 48.5%;
            transform: translate(-50%, -50%);
            width: 1000px;
            height: 400px;
        }

        .additional-img {
            width: 500px;
            height: 400px;
            position: absolute;
            /* Ensure proper positioning */
            left: 55.5%;
            /* Adjust left positioning as needed */
            bottom: -470px;
            /* Adjust bottom positioning as needed */
        }

        .Topic {
            position: absolute;
            font-family: RlFreight, HoeflerText-Black, Times New Roman, serif;
            font-size: 68px;
            font-weight: 900;
            letter-spacing: -1px;
            line-height: 72px;
            text-transform: none;
            left: 34%;
            top: 95%;
        }
    </style>
</head>

<body>
    <header>

        <div class="branding">
            <a href="index.php?user_id=<?php echo $user['id']; ?>" class="vroom-text">
                <h1>Vroom</h1>
            </a>
            <p class="slogan-text"><a href="index.php?user_id=<?php echo $user['id']; ?>">Drive, Explore, and Repeat</a></p>
        </div>
        <nav>
            <div class="nav-links">
                <a href="customerdash.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('customerdash.php', this)">Car rentals</a>
                <a href="favorites.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('favorites.html', this)">Favorites</a>
                <a href="book-history.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('book-history.html', this)">Booking History</a>
                <a href="settings.php?user_id=<?php echo $user_id; ?>" onclick="navigateTo('settings.php', this)">Settings</a>
            </div>
        </nav>
        <div class="currency-selector">
            <button class="currency-btn">NPR</button>
            <div class="profile-picture"></div>
        </div>
        <button class="manage-btn">Manage Bookings</button>
    </header>

    <main>
        <div class="Topic"> How Vroom Works?</div>
        <div class="steps-container">
            <div class="step">
                <div class="single-panel">
                    <div class="step">
                        <div class="step-text">
                            <h2>1. Find the perfect car</h2>
                            <p>Enter a location and date and browse thousands
                                of cars shared by
                                local hosts.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-text">
                            <h2>2. Book your trip</h2>
                            <p>Book on the Turo app or online, choose a protection plan,
                                and say hi to your host! Cancel
                                for free up to 24 hours before your trip.</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-text">
                            <h2>3. Hit the road</h2>
                            <p>Have the car delivered or pick it up from your host.
                                Check in with the app, grab the keys,
                                and hit the road!</p>
                        </div>

                    </div>
                </div>
            </div>
            <img src="2024-Hyundai-Kona-Electric-Gear.webp" alt="Another Image" class="additional-img">
            <img src="0x0.webp" alt="redCar" class="background-img">
        </div>
    </main>

</body>

</html>