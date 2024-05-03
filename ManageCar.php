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
    
    <!-- Display car price, free cancellation, and delete button -->
    <div class="price">
        <h4>Price for a day:</h4>
        <p class="number">Rs. <?php echo number_format($row['carPrice'], 2); ?></p>
        <p class="free-cancel">Free cancellation</p>
        <!-- Delete button with confirmation -->
        <form id="deleteForm_<?php echo $row['id']; ?>" method="post" action="deleteCar.php">
            <input type="hidden" name="car_id" value="<?php echo $row['id']; ?>">
            <button type="button" class="delete-btn" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</button>
        </form>
    </div>
</div>

<script>
    // Function to confirm deletion
    function confirmDelete(carId) {
        if (confirm("Are you sure you want to delete this car?")) {
            // If user confirms, submit the form asynchronously
            document.getElementById("deleteForm_" + carId).submit();
        }
    }
</script>
