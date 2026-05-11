<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Main Library',
                'building' => 'Building A',
                'location' => 'Campus Center',
                'capacity' => 500,
                'operational_hours' => '08:00 - 22:00',
                'description' => 'Our comprehensive library with extensive collections and study areas.',
            ],
            [
                'name' => 'Sports Complex',
                'building' => 'Building B',
                'location' => 'Sports Area',
                'capacity' => 1000,
                'operational_hours' => '06:00 - 21:00',
                'description' => 'Modern sports facilities including gym, swimming pool, and courts.',
            ],
            [
                'name' => 'IT Lab',
                'building' => 'Building C',
                'location' => 'Computer Center',
                'capacity' => 80,
                'operational_hours' => '09:00 - 18:00',
                'description' => 'State-of-the-art computer lab with latest technology.',
            ],
            [
                'name' => 'Cafeteria',
                'building' => 'Building D',
                'location' => 'Main Campus',
                'capacity' => 300,
                'operational_hours' => '10:00 - 20:00',
                'description' => 'Modern cafeteria serving various cuisines.',
            ],
            [
                'name' => 'Auditorium',
                'building' => 'Building E',
                'location' => 'Main Hall',
                'capacity' => 2000,
                'operational_hours' => '09:00 - 18:00',
                'description' => 'Large auditorium for seminars, conferences, and events.',
            ],
            [
                'name' => 'Science Lab',
                'building' => 'Building C',
                'location' => 'Science Wing',
                'capacity' => 60,
                'operational_hours' => '09:00 - 17:00',
                'description' => 'Advanced laboratory for physics, chemistry, and biology experiments.',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
