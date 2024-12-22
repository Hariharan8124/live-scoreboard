<?php
// Get the raw POST data
$data = file_get_contents("php://input");

// Decode the JSON data
$scoreData = json_decode($data, true);

// Check if rank, schoolName, participant, and points are present
if (!isset($scoreData['rank'], $scoreData['schoolName'], $scoreData['participant'], $scoreData['points'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Read the existing scores from the JSON file
$scoresFile = 'scores.json';
if (file_exists($scoresFile)) {
    $scores = json_decode(file_get_contents($scoresFile), true);
} else {
    $scores = [];
}

// Append the new score with the rank
$scores[] = $scoreData;

// Save the updated scores back to the JSON file
file_put_contents($scoresFile, json_encode($scores, JSON_PRETTY_PRINT));

// Respond with a success message
echo json_encode(['status' => 'success']);
?>
