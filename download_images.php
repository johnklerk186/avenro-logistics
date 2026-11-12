<?php

$images = [
    'hero-bg.jpg' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
    'air-freight.jpg' => 'https://images.unsplash.com/photo-1570710891163-6d3b5c47248b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'sea-freight.jpg' => 'https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'road-transport.jpg' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'warehouse.jpg' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'food-beverage.jpg' => 'https://images.unsplash.com/photo-1577106263724-2c8e03bfe9cf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'chemical.jpg' => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'energy.jpg' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'consumer-goods.jpg' => 'https://images.unsplash.com/photo-1472851294608-062f824d29cc?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    'retail.jpg' => 'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
    // Profile images for testimonials
    'profile1.jpg' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
    'profile2.jpg' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
    'profile3.jpg' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=80',
    // Testimonial profile images
    'client1.jpg' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80',
    'client2.jpg' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80',
    'client3.jpg' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80',
    'client4.jpg' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=80'
];

// Create directories if they don't exist
$directories = [
    __DIR__ . '/public/assets/images/',
    __DIR__ . '/public/sample-images/'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Download images to both directories
foreach ($images as $filename => $url) {
    $imageContent = file_get_contents($url);
    if ($imageContent !== false) {
        // Save to assets/images
        file_put_contents(__DIR__ . '/public/assets/images/' . $filename, $imageContent);
        // Save testimonial images to sample-images
        if (strpos($filename, 'client') === 0) {
            file_put_contents(__DIR__ . '/public/sample-images/' . $filename, $imageContent);
        }
        echo "Downloaded: $filename\n";
    } else {
        echo "Failed to download: $filename\n";
    }
}

echo "Image download complete!\n"; 