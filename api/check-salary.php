<?php // --- api/check-salary.php ---

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}

// --- YOUR SECRET CONFIGURATION ---
$salaryMinimum = 72000;
$salaryPreferred = 80000; // The new preferred minimum.

// Get the data from the form submission.
$low = isset($_POST['low']) ? (float)$_POST['low'] : 0;
$high = isset($_POST['high']) ? (float)$_POST['high'] : 0;
$type = isset($_POST['type']) ? $_POST['type'] : 'yearly';

// --- VALIDATION ---
if ($low <= 0) {
    echo json_encode(['status' => 'error', 'title' => 'Invalid Input', 'message' => 'Please enter a valid number for the salary range.']);
    exit();
}
if ($high < $low) {
    $high = $low;
}

// --- LOGIC ---
// Normalize hourly rates to a yearly salary for comparison.
$yearlyLow = ($type === 'hourly') ? $low * 40 * 52 : $low;
$yearlyHigh = ($type === 'hourly') ? $high * 40 * 52 : $high;

$response = [];

// --- REVISED LOGIC WITH THREE TIERS ---
if ($yearlyLow >= $salaryPreferred) {
    // CASE 1: The offer meets or exceeds the PREFERRED salary.
    $response['status'] = 'success';
    $response['title'] = 'Excellent Starting Point!';
    $response['message'] = 'Thank you! A salary range starting at $' . number_format($yearlyLow) . ' aligns well with my expectations for this role. I look forward to discussing this further.';

} elseif ($yearlyLow >= $salaryMinimum) {
    // CASE 2: The offer meets the MINIMUM, but not the preferred salary.
    $response['status'] = 'success'; // Still a success, but with a more moderate message.
    $response['title'] = 'A Good Starting Point';
    $response['message'] = 'Thank you. A salary range starting at $' . number_format($yearlyLow) . ' meets the minimum requirements. This is a good basis for a conversation about the full compensation package.';

} else {
    // CASE 3: The offer is BELOW the minimum.
    $response['status'] = 'danger';
    $response['title'] = 'Thank You, But...';
    $response['message'] = 'Sorry, a salary range starting at $' . number_format($yearlyLow) . ' is below the minimum threshold for consideration.';
}

// --- SEND RESPONSE ---
echo json_encode($response);

exit();
?>