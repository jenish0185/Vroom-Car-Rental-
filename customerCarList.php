<div class="car-panel">
    <div class="car-image">
        <img src="<?php echo $row['carImage']; ?>" alt="<?php echo $row['carName']; ?>">
    </div>
    
    <div class="car-details">
        <h3><?php echo $row['carName']; ?></h3>
        <div class="car-spec">
            <img src="brand-image.png" alt="Brand Icon">
            <span><?php echo $row['carBrand']; ?></span>
        </div>
        <div class="car-spec">
            <img src="vehicles.png" alt="Type Icon">
            <span><?php echo $row['carType']; ?></span>
        </div>
        <div class="car-spec">
            <img src="car-chair.png" alt="Seats">
            <span><?php echo $row['carSeats']; ?> seats</span>
        </div>
        <div class="car-spec">
            <img src="gear-shift.png" alt="Transmission">
            <span style="color: <?php echo ($row['carTransmission'] == 'Automatic') ? 'rgb(2, 255, 2)' : 'rgb(255, 0, 0)'; ?>"><?php echo $row['carTransmission']; ?></span>
        </div>
        <!-- Add more specifications as needed -->
        <p class="location" style="color:<?php echo ($row['carLocation'] == 'Kathmandu') ? '#4285F4' : '#F4B400'; ?>"><?php echo $row['carLocation']; ?></p>

    </div>
    <div class="price">
        <h4>Price for a day:</h4>
        <p class="number">Rs. <?php echo number_format($row['carPrice'], 2); ?></p>
        <p class="free-cancel">Free cancellation</p>
        <div class="rent-btn">
            <a href="rentCar.html">Rent</a>
        </div>

    </div>
</div>
