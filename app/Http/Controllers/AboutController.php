<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $companyInfo = [
            'founded' => '2010',
            'employees' => '500+',
            'countries' => '200+',
            'offices' => '50+'
        ];

        $team = [
            [
                'name' => 'John Anderson',
                'position' => 'Chief Executive Officer',
                'image' => 'ceo.jpg',
                'description' => 'With over 20 years of experience in logistics and supply chain management, John leads our company with a vision for innovation and excellence.'
            ],
            [
                'name' => 'Sarah Williams',
                'position' => 'Chief Operations Officer',
                'image' => 'coo.jpg',
                'description' => 'Sarah brings 15 years of operational expertise, ensuring our services maintain the highest standards of efficiency and reliability.'
            ],
            [
                'name' => 'Michael Chen',
                'position' => 'Chief Technology Officer',
                'image' => 'cto.jpg',
                'description' => 'Michael drives our digital transformation initiatives, implementing cutting-edge technology solutions for enhanced service delivery.'
            ],
            [
                'name' => 'Emily Rodriguez',
                'position' => 'Global Logistics Director',
                'image' => 'logistics-director.jpg',
                'description' => 'Emily oversees our worldwide logistics operations, optimizing routes and ensuring seamless international shipping solutions.'
            ]
        ];

        $milestones = [
            [
                'year' => '2010',
                'title' => 'Company Founded',
                'description' => 'Started operations with a small team of 10 dedicated professionals.'
            ],
            [
                'year' => '2013',
                'title' => 'International Expansion',
                'description' => 'Expanded services to cover major international routes and opened first overseas office.'
            ],
            [
                'year' => '2015',
                'title' => 'Digital Revolution',
                'description' => 'Launched our proprietary tracking system and mobile app for real-time shipment monitoring.'
            ],
            [
                'year' => '2018',
                'title' => 'Sustainability Initiative',
                'description' => 'Implemented eco-friendly practices and invested in green transportation solutions.'
            ],
            [
                'year' => '2020',
                'title' => 'Global Recognition',
                'description' => 'Received multiple industry awards for excellence in logistics services.'
            ],
            [
                'year' => '2022',
                'title' => 'Innovation Hub',
                'description' => 'Established our Innovation Center for developing future logistics solutions.'
            ]
        ];

        $values = [
            [
                'title' => 'Excellence',
                'icon' => 'fa-award',
                'description' => 'We strive for excellence in every aspect of our service delivery.'
            ],
            [
                'title' => 'Integrity',
                'icon' => 'fa-shield-alt',
                'description' => 'We conduct our business with the highest standards of integrity and transparency.'
            ],
            [
                'title' => 'Innovation',
                'icon' => 'fa-lightbulb',
                'description' => 'We continuously innovate to provide better solutions for our clients.'
            ],
            [
                'title' => 'Sustainability',
                'icon' => 'fa-leaf',
                'description' => 'We are committed to environmentally responsible logistics practices.'
            ]
        ];

        return view('about.index', compact('companyInfo', 'team', 'milestones', 'values'));
    }
} 