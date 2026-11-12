<?php

$partnerLogos = [
    'dhl.svg' => 'https://raw.githubusercontent.com/simple-icons/simple-icons/develop/icons/dhl.svg',
    'fedex.svg' => 'https://raw.githubusercontent.com/simple-icons/simple-icons/develop/icons/fedex.svg',
    'ups.svg' => 'https://raw.githubusercontent.com/simple-icons/simple-icons/develop/icons/ups.svg',
    'usps.svg' => 'https://raw.githubusercontent.com/simple-icons/simple-icons/develop/icons/usps.svg'
];

// Create partners directory if it doesn't exist
$directory = __DIR__ . '/public/assets/images/partners';
if (!file_exists($directory)) {
    mkdir($directory, 0755, true);
}

// Download images
$context = stream_context_create([
    'http' => [
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
    ]
]);

foreach ($partnerLogos as $filename => $url) {
    $imageContent = file_get_contents($url, false, $context);
    if ($imageContent !== false) {
        $outputPath = $directory . '/' . $filename;
        file_put_contents($outputPath, $imageContent);
        echo "Downloaded: $filename\n";
    } else {
        echo "Failed to download: $filename\n";
    }
}

echo "Partner logos download complete!\n"; 