<?php

include('admin/includes/config.php');

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
    // Success - redirect to thank you page or show success message
    header("Location: booking_success.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Close connection
mysqli_close($con);
?>