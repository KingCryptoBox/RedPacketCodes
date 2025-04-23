<?php
header('Content-Type: application/json');

// Path to your codes file in the root directory
$codesFile = $_SERVER['DOCUMENT_ROOT'] . '/binance_codes.json';

// Check if file exists, if not create with sample data
if (!file_exists($codesFile)) {
    $initialCodes = [
        ["code" => "BPRP2023XYZ123", "value" => "$5-20", "expires" => "2023-12-31", "claims" => 142],
        ["code" => "BINANCEGIFT50", "value" => "$3-15", "expires" => "2023-12-25", "claims" => 89],
        ["code" => "REDPACKET888", "value" => "$10-50", "expires" => "2023-12-20", "claims" => 210]
    ];
    file_put_contents($codesFile, json_encode($initialCodes));
}

// Read and return codes
$codes = json_decode(file_get_contents($codesFile), true);
echo json_encode($codes);
?>