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
      background-size: cover;
      border: none;
    }

    .manage-btn {
      background-color: #ffffff;
      color: #7B2CF8;
      border: none;
      padding: 15px 25px;
      border-radius: 5px;
      cursor: pointer;
    }

    /* Panel Styles */
    .panel {
      background-color: #000000;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 20px;
      margin: 20px;
      height: auto;
    }

    .panel h1 {
      color: #ffffff;
      font-size: 90px;
      font-weight: 900;
      text-transform: none;
      letter-spacing: -1px;
      margin-bottom: 10px;
      text-align: center;
      font-family: RlFreight, HoeflerText-Black, Times New Roman, serif;
    }

    /* Main Content Styles */
    .header {
      text-align: center;
      font-family: RlBasisGrotesque, Avenir, Helvetica Neue, Helvetica, sans-serif;
      font-size: 28px;
      font-weight: 900;
      letter-spacing: -0.2px;
      line-height: 40px;
      margin-top: 40px;
      margin-bottom: 40px;
      margin-left: 100px;
      margin-right: 100px;
    }

    .date {
      text-align: center;
      font-family: RlBasisGrotesque, Avenir, Helvetica Neue, Helvetica, sans-serif;
      font-size: 16px;
      font-weight: 400;
      letter-spacing: 0;
      text-transform: none;
      margin-bottom: 20px;
    }

    .services {
      color: #121214;
      font-family: RlBasisGrotesque, Avenir, Helvetica Neue, Helvetica, sans-serif;
      font-size: 16px;
      font-weight: 400;
      letter-spacing: 0;
      line-height: 22px;
      text-transform: none;
      margin: 20px;
    }

    /* Hyperlink Styles */
    .hyperlink {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #7B2CF8;
      text-decoration: underline;
      cursor: pointer;
    }

    .hyperlink {
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      /* Optional: Centers the items horizontally */
    }

    .hyperlink ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      display: flex;
      gap: 10px;
      /* Adjust the gap between items */
    }

    .hyperlink li {
      margin-bottom: 0;
      /* Remove the margin bottom to avoid extra spacing */
    }

    .hyperlink a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }

    .hyperlink a:hover {
      text-decoration: underline;
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
    <div class="panel" id="legal-matters">
      <h1>Legal Matters</h1>

      <!-- List of hyperlinks -->
      <div class="hyperlink">
        <ul>
          <li><a href="#introduction" class="hyperlink">Introduction</a></li>
          <li><a href="#eligibility" class="hyperlink">Eligibility</a></li>
          <li><a href="#content" class="hyperlink">Content</a></li>
          <li><a href="#other-matter" class="hyperlink">Other Matter</a></li>
        </ul>
      </div>
    </div>


    <div class="header" id="terms-of-service">
      <h1>Terms Of Service</h1>
      <p class="date">Last revised: May, 2024</p>
      <p class="services">Welcome to Vroom Car Rental!<br><br>
        PLEASE TAKE A MOMENT TO REVIEW THESE TERMS OF SERVICE CAREFULLY. THEY CONTAIN IMPORTANT INFORMATION THAT IMPACTS
        YOUR RIGHTS AND OBLIGATIONS. THIS INCLUDES AN AGREEMENT TO RESOLVE DISPUTES THROUGH ARBITRATION (UNLESS YOU
        CHOOSE TO OPT OUT). THESE TERMS ALSO PROHIBIT CLASS AND REPRESENTATIVE ACTIONS AND LIMIT THE REMEDIES AVAILABLE
        FOR ALL MATTERS, WHETHER HANDLED IN COURT OR THROUGH ARBITRATION. ADDITIONALLY, THE TERMS DEFINE THE
        JURISDICTION, VENUE, AND GOVERNING LAW FOR DISPUTES, EXCEPT WHERE PROHIBITED. THERE ARE ALSO OBLIGATIONS TO
        COMPLY WITH APPLICABLE LAWS AND REGULATIONS.</p>
    </div>

    <!-- Navigation Links -->


    <!-- Introduction Section -->
    <div class="header" id="introduction">
      <h1>Introduction</h1>
      <p class="date">Welcome to Vroom Car Rental, where we provide an online car sharing platform connecting vehicle
        owners with travelers and locals looking to book those vehicles. You can access Vroom through our website at
        vroom.com and our mobile application. The Vroom website, blog, mobile apps, and related services are
        collectively referred to as "the Services". By using or accessing the Services, including communicating with us
        or other Vroom users, you agree to comply with and be bound by the provisions of these Terms of Service (these
        "Terms"), whether or not you register as a user.

        These Terms, along with our cancellation policy, nondiscrimination policy, applicable insurance terms and
        certificates, roadside assistance terms, and additional policies (together, the "Policies") form the "Agreement"
        between you and Vroom (each a "Party" and together, "the Parties"). Additionally, we provide a Car Sharing
        Agreement summarizing reservation terms, accessible in the Services for any booked or previous trips, which can
        serve as proof of reservation.

        Modification. Vroom reserves the right, at our sole discretion, to modify the Services or the Agreement,
        including these Terms, at any time. If we make changes to these Terms, we will post the modifications on the
        Services and update the "Last Revised" date at the top. By continuing to use the Services after we post a
        modification or provide notice of a modification, you indicate your agreement to be bound by the modified terms.
        If you do not agree with the modified terms, your sole recourse is to stop using the Services and close your
        Vroom Account within 30 days. If you choose to close your Vroom Account, the previous version of these Terms
        will apply to you, unless you use the Services during the 30-day period, in which case the new version of these
        Terms will apply.</p>
    </div>

    <!-- Eligibility Section -->
    <div class="header" id="eligibility">
      <h1>Eligibility</h1>
      <p class="date">Our Services are designed for guests who meet our eligibility requirements in the location where
        the vehicle is booked and for hosts who are 21 years old or older (except in the United Kingdom and France,
        where hosts as young as 18 can list eligible vehicles). Use of the Services by individuals who do not meet these
        eligibility requirements is strictly prohibited.

        Additionally, our platform aims to ensure safety and compliance with local regulations. Users must adhere to
        these requirements to participate in Vroom's car sharing community. If you have any questions about eligibility
        or need clarification on our policies, please don't hesitate to reach out to our support team.

        Furthermore, Vroom is committed to providing a secure and reliable platform for all users. By setting clear
        guidelines, we can maintain a positive experience for everyone involved in the car rental process.</p>
    </div>

    <!-- Content Section -->
    <div class="header" id="content">
      <h1>Content</h1>
      <p class="date">Turo Content and User Content License. Subject to your compliance with these Terms, Vroom grants
        you a limited, revocable, non-exclusive, non-transferable license to access and view any Vroom and/or user
        content to which you are permitted access, solely for your personal and non-commercial purposes. You may not
        sublicense these license rights. No licenses or rights are granted to you under any intellectual property owned
        or controlled by Vroom or its licensors, except for those expressly granted in these Terms.

        User Content. We may, at our discretion, allow you to post, upload, publish, submit, or transmit content through
        our Services, such as photographs of you and your vehicle(s), reviews, feedback, and descriptions related to
        you, your vehicle, or your trip. By making any content available on our Services, you grant Vroom a worldwide,
        irrevocable, perpetual, non-exclusive, transferable, royalty-free license (with the right to sublicense) to use,
        view, copy, adapt, modify, distribute, transfer, publicly display, publicly perform, transmit, stream,
        broadcast, access, view, and otherwise exploit such content for the purpose of promoting or marketing the
        Services. Vroom does not claim ownership rights in any user-generated content, and these Terms do not restrict
        your rights to use and exploit such content.

        Copyright Protection. We take copyright infringement seriously and comply with the Digital Millennium Copyright
        Act and similar laws. If you believe someone is violating your copyright and wish to notify us, please refer to
        our process for submitting notices.

        Google Terms. Some parts of our Services utilize Google Maps/Places mapping services, including the Google
        Places API. Additionally, to combat spam and abuse, Vroom employs reCAPTCHA Enterprise, a Google service. Your
        use of our Services binds you to Google's Terms of Service.</p>
    </div>

    <!-- Other Matter Section -->
    <div class="header" id="other-matter">
      <h1>Other Matter</h1>
      <p class="date">Violations. Vroom reserves the right, though not the obligation, to investigate, pursue, and seek
        to address violations of our Agreement to the fullest extent permissible by law.

        Vroom maintains the right, at any time and in accordance with applicable law, to remove or disable access to any
        content that we, at our sole discretion, deem objectionable, in violation of these Terms, or detrimental to the
        Services or our community. If we suspect misuse of Vroom, our users, or any violation of these Terms, we reserve
        the right, at our sole discretion and without limiting other remedies, to restrict, suspend, or terminate your
        Vroom Account and access to our Services, remove hosted content, deny claims, adjust or remove listings, revoke
        discounts, and take technical and/or legal measures to prevent further use of our Services. Additionally, we
        reserve the right to deny or terminate access to our Services to any individual or entity at our discretion to
        the full extent allowed under applicable law.

        Policy Enforcement. When addressing issues, we take into account a user's history and specific circumstances in
        applying our Policies. We may exercise leniency in policy enforcement to act in the best interest of our
        community, subject to our sole and absolute discretion.

        Communications with You. By using Vroom, you consent to electronic communication (e.g., email, notifications
        within the Vroom app) in place of mailed notices. For efficiency, we may also contact you via automated calls or
        texts at the phone number(s) you provide. These communications may include confirming your account, notifying
        you about account activity, fraud prevention, debt collection, or urgent messages. We may share your phone
        number(s) with contracted service providers assisting us in pursuing these objectives, but we will not share
        them for unrelated purposes without your consent. Standard telephone minute, text, and data charges may apply.
        Where required by law, you may revoke consent for these communications.

        You authorize Vroom and our service providers to monitor or record telephone conversations or web chat
        interactions for quality control, training, or other purposes without notice. Your communications with Vroom may
        be monitored or recorded. If you prefer not to have your call recorded, please contact us in writing at
        help.vroom.com. If you do not wish to have your chat activity monitored or recorded, please refrain from using
        the chat function on our Services.

        Non-Disparagement. Both parties agree not to take actions that would harm each other's reputation or result in
        unwanted publicity.

        Insurance and Protection Plans. Vroom is not an insurance provider and does not insure hosts or guests. Any
        protection plans offered through our Services are independent. To benefit from a protection plan, hosts and
        guests must comply with these Terms. Protection plans are available only in select countries. Please refer to
        the specific terms for guests and hosts for more information based on your use of our Services.</p>
    </div>
  </main>

</body>

</html>