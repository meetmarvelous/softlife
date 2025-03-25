<?php
session_start();
// error_reporting(0);
include('admin/includes/config.php');

$alertMessage = '';
$alertType = ''; // 'success' or 'danger'

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
  $surname = mysqli_real_escape_string($con, $_POST['surname']);
  $phone = mysqli_real_escape_string($con, $_POST['phone']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $checkin = mysqli_real_escape_string($con, $_POST['checkin']);
  $checkout = mysqli_real_escape_string($con, $_POST['checkout']);
  $nights = (int)$_POST['nights'];
  $room_type = mysqli_real_escape_string($con, $_POST['room_type']);
  $total_price = (float)str_replace(['₦', ','], '', $_POST['total_price']);
  $message = mysqli_real_escape_string($con, $_POST['message']);
  $status = 'unread';
  $submitted_at = date('Y-m-d H:i:s');

  // Insert data into database
  $sql = "INSERT INTO reservation (firstname, surname, phone, email, checkin, checkout, nights, room_type, total_price, message, status, submitted_at)
            VALUES ('$firstname', '$surname', '$phone', '$email', '$checkin', '$checkout', $nights, '$room_type', $total_price, '$message', '$status', '$submitted_at')";

  if (mysqli_query($con, $sql)) {
    $alertMessage = 'Booking submitted successfully!';
    $alertType = 'success';

    // Clear form fields
    $_POST = array();
  } else {
    $alertMessage = 'Error: ' . mysqli_error($con);
    $alertType = 'danger';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>SOFTLIFE Hotel | Reservation</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">


  <!-- Additional meta tags for SEO -->
  <!-- Description should highlight the hotel's luxury, affordability, and key offerings -->
  <meta name="description"
    content="Enjoy premium hospitality with well-furnished rooms, a bush-bar, restaurant, gym, and more at SOFT-LIFE Luxury Hotel, Ibadan.">

  <!-- Keywords should focus on relevant search terms for hospitality and location -->
  <meta name="keywords"
    content="luxury hotel Ibadan, affordable hotel Ibadan, best hotel in Ibadan, Soft-Life Luxury Hotel, business hotel, relaxation, conference center, bush-bar, restaurant, free Wi-Fi">

  <!-- Author should reflect the business name or owner -->
  <meta name="author" content="SOFT-LIFE Luxury Hotel">

  <!-- Open Graph Meta Tags -->
  <!-- Ensure the URL points to the hotel's actual website -->
  <meta property="og:url" content="http://softlifehotel.com/">
  <meta property="og:type" content="website">
  <meta property="og:title" content="SOFT-LIFE Luxury Hotel - Making Luxury Affordable">
  <meta property="og:description"
    content="Enjoy premium hospitality with well-furnished rooms, a bush-bar, restaurant, gym, and more at SOFT-LIFE Luxury Hotel, Ibadan.">
  <meta property="og:image" content="http://softlifehotel.com/img/ogimage.png">
  <meta property="og:image:alt" content="SOFT-LIFE Luxury Hotel - Premium Hospitality in Ibadan">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:creator" content="@realmarvelous">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="SOFT-LIFE Luxury Hotel - Comfort & Elegance in Ibadan">
  <meta name="twitter:description"
    content="Book a luxurious stay at SOFT-LIFE Luxury Hotel. Well-furnished rooms, a restaurant, gym, bush-bar, free Wi-Fi, and more!">
  <meta name="twitter:image" content="http://softlifehotel.com/img/ogimage.png">
  <meta name="twitter:image:alt" content="Experience Comfort & Hospitality at SOFT-LIFE Luxury Hotel">


  <!-- Favicon -->
  <link href="img/favicon.html" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&amp;family=Montserrat:wght@400;500;600;700&amp;display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
    <!-- Spinner End -->

    <!-- Header Start -->
    <div class="container-fluid bg-dark px-0">
      <div class="row gx-0">
        <div class="col-lg-3 bg-dark d-none d-lg-block">
          <a href="" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
            <h1 class="m-0 text-primary text-uppercase">SOFTLIFE</h1>
          </a>
        </div>
        <div class="col-lg-9">
          <div class="row gx-0 bg-white d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
              <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                <i class="fa fa-envelope text-primary me-2"></i>
                <p class="mb-0">info@softlifehotel.com</p>
              </div>
              <div class="h-100 d-inline-flex align-items-center py-2">
                <i class="fa fa-phone-alt text-primary me-2"></i>
                <p class="mb-0">09135284477</p>
              </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
              <div class="d-inline-flex align-items-center py-2">
                <a class="me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="me-3" href="#"><i class="fab fa-twitter"></i></a>
                <a class="me-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="me-3" href="#"><i class="fab fa-instagram"></i></a>
                <a class="" href="#"><i class="fab fa-youtube"></i></a>
              </div>
            </div>
          </div>
          <!-- <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0"> -->
          <nav class="navbar navbar-expand-lg bg-white navbar-light p-3 p-lg-0">
            <a href="" class="navbar-brand d-block d-lg-none">
              <img src="img/logo.svg" alt="SoftLife Logo" class="img-fluid me-2" style="max-height: 40px;">
              <!-- <h1 class="m-0 text-primary text-uppercase">SOFTLIFE</h1> -->
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
              <div class="navbar-nav mr-auto py-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About Us</a>
                <!-- <a href="" class="nav-item nav-link">Services</a> -->
                <!-- <a href="" class="nav-item nav-link">Rooms</a> -->
                <a href="booking.php" class="nav-item nav-link">Reservation</a>
              </div>
              <a href="booking.php" class="btn btn-primary rounded-0 py-4 px-md-5 d-none d-lg-block">Book Now<i
                  class="fa fa-arrow-right ms-3"></i></a>
            </div>
          </nav>
        </div>
      </div>
    </div>
    <!-- Header End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-1.jpg);">
      <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
          <h1 class="display-3 text-white mb-3 animated slideInDown">Booking</h1>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center text-uppercase">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <!-- <li class="breadcrumb-item"><a href="#">Pages</a></li> -->
              <li class="breadcrumb-item text-white active" aria-current="page">Booking</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <!-- Page Header End -->

    <!-- Booking Start -->
    <div class="container-xxl py-5">
      <div class="container">
        <?php if ($alertMessage): ?>
          <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
            <?php echo $alertMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <script>
            // Show alert message as popup
            alert("<?php echo $alertMessage; ?>");
          </script>
        <?php endif; ?>

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
          <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
          <h1 class="mb-5">Book A <span class="text-primary text-uppercase">Luxury Room</span></h1>
        </div>
        <div class="row g-5">
          <div class="col-lg-1"></div>
          <div class="col-lg-10">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
              <form method="POST" action="">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="firstname" name="firstname"
                        placeholder="Your First Name" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>" required>
                      <label for="firstname">Your First Name</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="surname" name="surname"
                        placeholder="Your Surname" value="<?php echo isset($_POST['surname']) ? $_POST['surname'] : ''; ?>" required>
                      <label for="surname">Your Surname</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="tel" class="form-control" id="phone" name="phone"
                        placeholder="Your Phone Number" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>" required>
                      <label for="phone">Your Phone Number</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="email" class="form-control" id="email" name="email"
                        placeholder="Your Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                      <label for="email">Your Email</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating date" id="date3" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" id="checkin" name="checkin"
                        placeholder="Check In" data-target="#date3" data-toggle="datetimepicker"
                        value="<?php echo isset($_POST['checkin']) ? $_POST['checkin'] : ''; ?>" required />
                      <label for="checkin">Check In</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating date" id="date4" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input" id="checkout" name="checkout"
                        placeholder="Check Out" data-target="#date4" data-toggle="datetimepicker"
                        value="<?php echo isset($_POST['checkout']) ? $_POST['checkout'] : ''; ?>" required />
                      <label for="checkout">Check Out</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="number" class="form-control" id="nights" name="nights"
                        placeholder="Number of Nights" value="<?php echo isset($_POST['nights']) ? $_POST['nights'] : ''; ?>" readonly>
                      <label for="nights">Number of Nights</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <select class="form-select" id="room_type" name="room_type" required>
                      <option disabled selected>--- Select a room/suite ---</option>
                        <option value="25000" <?php echo (isset($_POST['room_type']) && $_POST['room_type'] == '25000') ? 'selected' : ''; ?>>Classic Room - ₦25,000</option>
                        <option value="28000" <?php echo (isset($_POST['room_type']) && $_POST['room_type'] == '28000') ? 'selected' : ''; ?>>Super Classic Room - ₦28,000</option>
                        <option value="32000" <?php echo (isset($_POST['room_type']) && $_POST['room_type'] == '32000') ? 'selected' : ''; ?>>Deluxe Room - ₦32,000</option>
                        <option value="45000" <?php echo (isset($_POST['room_type']) && $_POST['room_type'] == '45000') ? 'selected' : ''; ?>>Executive Suites - ₦45,000</option>
                      </select>
                      <label for="room_type">Select A Room</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="total_price" name="total_price"
                        placeholder="Total Price" value="<?php echo isset($_POST['total_price']) ? $_POST['total_price'] : ''; ?>" readonly>
                      <label for="total_price">Total Price (₦)</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Special Request" id="message" name="message"
                        style="height: 100px"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                      <label for="message">Special Request</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-1"></div>
        </div>
      </div>
    </div>
    <!-- Booking End -->


    <!-- Newsletter Start -->
    <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="row justify-content-center">
        <div class="col-lg-10 border rounded p-1">
          <div class="border rounded text-center p-1">
            <div class="bg-white rounded text-center p-5">
              <h4 class="mb-4">Subscribe Our <span class="text-primary text-uppercase">Newsletter</span></h4>
              <div class="position-relative mx-auto" style="max-width: 400px;">
                <input class="form-control w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                <button type="button"
                  class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Newsletter Start -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
      <div class="container pb-5">
        <div class="row g-5">
          <div class="col-md-6 col-lg-4">
            <div class="bg-primary rounded p-4">
              <a href="">
                <h1 class="text-white text-uppercase mb-3">SOFTLIFE</h1>
              </a>
              <p class="text-white mb-0">
                Lodge, relax, and enjoy—your perfect stay starts here!
              </p>
              <!-- <p class="text-white mb-0">
                Download <a class="text-dark fw-medium" href="#">SOFTLIFE –
                  Premium Version</a>, build a professional website for your hotel business and grab the attention of
                new visitors upon your site’s launch.
              </p> -->
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6 class="section-title text-start text-primary text-uppercase mb-4">
              Contact
            </h6>
            <p class="mb-2">
              <i class="fa fa-map-marker-alt me-3"></i>21b Afijagba Zone A,
              Off Gbagi International Market, Old Ife Road Ibadan.
            </p>
            <p class="mb-2">
              <i class="fa fa-phone-alt me-3"></i>09135284477, 08144894289.
            </p>
            <p class="mb-2">
              <i class="fa fa-envelope me-3"></i>info@softlifehotel.com
            </p>
            <div class="d-flex pt-2">
              <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
              <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
              <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
              <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="col-lg-5 col-md-12">
            <div class="row gy-5 g-4">
              <div class="col-md-6">
                <h6 class="section-title text-start text-primary text-uppercase mb-4">
                  Company
                </h6>
                <a class="btn btn-link" href="about.html">About Us</a>
                <a class="btn btn-link" href="booking.php">Reservation</a>
                <a class="btn btn-link" href="#footer">Privacy Policy</a>
                <a class="btn btn-link" href="#footer">Terms & Condition</a>
                <a class="btn btn-link" href="#footer">Support</a>
              </div>
              <div class="col-md-6">
                <h6 class="section-title text-start text-primary text-uppercase mb-4">
                  Services
                </h6>
                <a class="btn btn-link" href="#services">Food & Dining</a>
                <!-- <a class="btn btn-link" href="#">Spa & Fitness</a> -->
                <a class="btn btn-link" href="#services">Beverages & Bar</a>
                <a class="btn btn-link" href="#services">Comfort & Convenience</a>
                <a class="btn btn-link" href="#services">Event & Party</a>
                <!-- <a class="btn btn-link" href="#">GYM & Yoga</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="copyright">
          <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy;
              <a class="border-bottom" href="#">SOFTLIFE Luxury Hotel</a>, All
              Right Reserved.
            </div>
            <!-- <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
              &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. Designed By <a
                class="border-bottom" href="https://htmlcodex.com/">HTML Codex</a>
            </div> -->
            <div class="col-md-6 text-center text-md-end">
              <div class="footer-menu">
                <a href="#">Home</a>
                <a href="#">Cookies</a>
                <a href="#">Help</a>
                <a href="#">FQAs</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/rating/rating.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>

  <script>
    $(document).ready(function() {
      // Initialize date pickers with min date set to today
      var today = new Date();
      $('#date3').datetimepicker({
        format: 'L',
        minDate: today
      });
      $('#date4').datetimepicker({
        format: 'L',
        minDate: today,
        useCurrent: false
      });

      // Calculate nights and total price when dates or room type change
      $('#checkin, #checkout, #room_type').change(function() {
        calculateNightsAndPrice();
      });

      // Calculate on page load if values exist
      if ($('#checkin').val() && $('#checkout').val()) {
        calculateNightsAndPrice();
      }

      function calculateNightsAndPrice() {
        var checkin = $('#checkin').val();
        var checkout = $('#checkout').val();
        var roomPrice = $('#room_type').val();

        if (checkin && checkout) {
          var startDate = moment(checkin, 'MM/DD/YYYY');
          var endDate = moment(checkout, 'MM/DD/YYYY');

          // Ensure checkout is after checkin
          if (endDate.isBefore(startDate, 'day')) {
            alert('Check-out date must be after check-in date');
            $('#checkout').val('');
            $('#nights').val('');
            $('#total_price').val('');
            return;
          }

          // Calculate nights (minimum 1 night)
          var nights = endDate.diff(startDate, 'days');
          nights = nights < 1 ? 1 : nights;

          // Calculate total price
          var totalPrice = nights * roomPrice;

          // Format with commas
          var formattedPrice = totalPrice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          // Update fields
          $('#nights').val(nights);
          $('#total_price').val('₦' + formattedPrice);
        }
      }
    });
  </script>
</body>

</html>