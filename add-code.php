<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method not allowed']));
}

// Validate input
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['code']) || !isset($data['value']) || !isset($data['expires'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Missing required fields']));
}

// Path to your codes file in the root directory
$codesFile = $_SERVER['DOCUMENT_ROOT'] . '/binance_codes.json';

// Read existing codes
$codes = [];
if (file_exists($codesFile)) {
    $codes = json_decode(file_get_contents($codesFile), true);
}

// Add new code
$newCode = [
    'code' => $data['code'],
    'value' => $data['value'],
    'expires' => $data['expires'],
    'claims' => 0
];

$codes[] = $newCode;

// Save back to file
file_put_contents($codesFile, json_encode($codes));

echo json_encode(['success' => true, 'code' => $newCode]);
?>