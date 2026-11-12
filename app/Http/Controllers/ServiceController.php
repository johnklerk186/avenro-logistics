<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = [
            [
                'id' => 'air-freight',
                'title' => 'Air Freight',
                'image' => 'air-freight.jpg',
                'description' => 'Door-to-door pickup and delivery of documents and non-documents worldwide within 1-5 days.',
                'features' => [
                    'Express delivery options',
                    'Temperature-controlled cargo',
                    'Customs clearance service',
                    'Insurance coverage',
                    'Priority handling'
                ],
                'benefits' => [
                    'Fastest delivery times',
                    'Global reach',
                    'Secure handling'
                ],
                'details' => 'Our air freight service offers the fastest and most reliable way to transport your goods across the globe. With our extensive network of carriers and partners, we ensure your shipments reach their destination on time and in perfect condition.'
            ],
            [
                'id' => 'ground-freight',
                'title' => 'Ground Freight',
                'image' => 'road-transport.jpg',
                'description' => 'Fleet of GPS-equipped vehicles for all transport needs, including oversize loads.',
                'features' => [
                    'Full truckload service',
                    'Less than truckload',
                    'Specialized equipment',
                    'Cross-border shipping',
                    'Local delivery'
                ],
                'benefits' => [
                    'Cost-effective',
                    'Flexible scheduling',
                    'Door-to-door service'
                ],
                'details' => 'Our ground freight services provide reliable and cost-effective transportation solutions across the continent. Whether you need full truckload or less than truckload services, we have the right solution for your needs.'
            ],
            [
                'id' => 'sea-freight',
                'title' => 'Sea Freight',
                'image' => 'sea-freight.jpg',
                'description' => 'Global container shipping and bulk carrier services with worldwide port coverage.',
                'features' => [
                    'FCL & LCL shipping',
                    'Port-to-port service',
                    'Container tracking',
                    'Cargo insurance',
                    'Documentation support'
                ],
                'benefits' => [
                    'Most economical',
                    'Large capacity',
                    'Eco-friendly'
                ],
                'details' => 'Our sea freight services offer the most economical solution for large volume shipments. We handle both FCL and LCL shipments, providing end-to-end visibility and comprehensive documentation support.'
            ],
            [
                'id' => 'warehousing',
                'title' => 'Warehousing',
                'image' => 'warehouse.jpg',
                'description' => 'State-of-the-art storage facilities with advanced inventory management systems.',
                'features' => [
                    'Climate-controlled storage',
                    'Inventory management',
                    'Pick and pack service',
                    'Cross-docking',
                    'Quality control'
                ],
                'benefits' => [
                    'Secure facilities',
                    'Real-time inventory',
                    'Flexible space'
                ],
                'details' => 'Our warehousing solutions provide secure and efficient storage for your goods. With state-of-the-art facilities and advanced inventory management systems, we ensure your products are stored safely and handled professionally.'
            ],
            [
                'id' => 'pet-relocation',
                'title' => 'Pet Relocation',
                'image' => 'pet-relocation.jpg',
                'description' => 'Safe and comfortable pet transportation services for domestic and international moves.',
                'features' => [
                    'Door-to-door pet transport',
                    'Veterinary coordination',
                    'Custom travel crates',
                    'Pet documentation assistance',
                    'Climate-controlled vehicles'
                ],
                'benefits' => [
                    'Stress-free travel',
                    'Expert pet handlers',
                    'Full compliance'
                ],
                'details' => 'Our pet relocation services ensure your beloved pets travel safely and comfortably. We handle all aspects of pet transportation, from documentation and veterinary requirements to comfortable travel arrangements and door-to-door delivery.'
            ]
        ];

        return view('services.index', compact('services'));
    }
}