<?php
/**
 * Volt & Velocity (V&V) - Form Submission Endpoint
 * Validates inputs, saves bookings to database, and outputs JSON
 */

header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method Not Allowed. This endpoint requires POST.'
    ]);
    exit;
}

// 1. Retrieve and sanitize input fields
$name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
$modelKey = isset($_POST['carModel']) ? htmlspecialchars(trim($_POST['carModel'])) : '';
$date = isset($_POST['bookingDate']) ? htmlspecialchars(trim($_POST['bookingDate'])) : '';

// 2. Validate fields
if (empty($name) || empty($email) || empty($phone) || empty($modelKey) || empty($date)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Please provide all details. All fields are mandatory.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'The email address provided is invalid. Please try again.'
    ]);
    exit;
}

// Validate date is not in the past
$bookingTimestamp = strtotime($date);
if (!$bookingTimestamp || $bookingTimestamp < strtotime(date('Y-m-d'))) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid booking date. Please select today or a future date.'
    ]);
    exit;
}

// Map model key to real car name
$inventoryPath = __DIR__ . '/inventory.json';
$carName = ucfirst($modelKey);
if (file_exists($inventoryPath)) {
    $inventory = json_decode(file_get_contents($inventoryPath), true) ?: [];
    if (isset($inventory[$modelKey])) {
        $carName = $inventory[$modelKey]['name'];
    }
}

// 3. Store booking database entry
$bookingsPath = __DIR__ . '/bookings.json';
$bookings = [];

if (file_exists($bookingsPath)) {
    $bookings = json_decode(file_get_contents($bookingsPath), true) ?: [];
}

$newBooking = [
    'id' => uniqid('vv_'),
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'car' => $carName,
    'model_key' => $modelKey,
    'date' => $date,
    'submitted_at' => date('Y-m-d H:i:s')
];

$bookings[] = $newBooking;
file_put_contents($bookingsPath, json_encode($bookings, JSON_PRETTY_PRINT));

// 4. Return successful response
echo json_encode([
    'success' => true,
    'message' => 'Reservation confirmed.',
    'booking' => [
        'name' => $name,
        'email' => $email,
        'car' => $carName,
        'date' => date('l, F j, Y', $bookingTimestamp)
    ]
]);
exit;
