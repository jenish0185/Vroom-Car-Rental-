<div class="car-panel">
    <div class="car-image">
        <?php
        // Decode the base64 encoded image retrieved from the database
        $imageData = base64_decode($row['carImage']);
        // Output the image data
        echo '<img src="data:image/jpeg;base64,'.base64_encode($imageData).'" alt="'.$row['carName'].'">';
        ?>
    </div>
    
    <div class="car-details">
        <!-- Display car name -->
        <h3><?php echo $row['carName']; ?></h3>
        <!-- Display car brand -->
        <div class="car-spec">
            <img src="brand-image.png" alt="Brand Icon">
            <span><?php echo $row['carBrand']; ?></span>
        </div>
        <!-- Display car type -->
        <div class="car-spec">
            <img src="vehicles.png" alt="Type Icon">
            <span><?php echo $row['carType']; ?></span>
        </div>
        <!-- Display number of seats -->
        <div class="car-spec">
            <img src="car-chair.png" alt="Seats">
            <span><?php echo $row['carSeats']; ?> seats</span>
        </div>
        <!-- Display transmission type with color indicating automatic or manual -->
        <div class="car-spec">
            <img src="gear-shift.png" alt="Transmission">
            <span style="color: <?php echo ($row['carTransmission'] == 'Automatic') ? 'rgb(2, 255, 2)' : 'rgb(255, 0, 0)'; ?>"><?php echo $row['carTransmission']; ?></span>
        </div>
        <!-- Display car location with color indicating different locations -->
        <p class="location" style="color:<?php echo ($row['carLocation'] == 'Kathmandu') ? '#4285F4' : '#F4B400'; ?>"><?php echo $row['carLocation']; ?></p>
    </div>
    
    <!-- Price Section -->
    <div class="price">
        <!-- Price for a day -->
        <h4>Price for a day:</h4>
        <p class="number">Rs. <?php echo number_format($row['carPrice'], 2); ?></p>

        <!-- Free cancellation -->
        <p class="free-cancel">Free cancellation</p>
        
        <!-- Rent Button -->
        <div class="rent-btn">
            <?php
            // Check if user_id is set
            if(isset($user_id)) {
                // If user_id is set, redirect to CarInformation.php with both car_id and user_id
                echo '<a href="CarInformation.php?car_id='.$row['id'].'&user_id='.$user_id.'">Rent</a>';
            } else {
                // If user_id is not set, redirect to login.php
                echo '<a href="login.php">Rent</a>';
            }
            ?>
        </div>


    </div>
</div>
