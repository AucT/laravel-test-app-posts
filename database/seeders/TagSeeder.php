<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'movies',
            ],
            [
                'id' => 2,
                'name' => 'games',
            ],
            [
                'id' => 3,
                'name' => 'netflix',
            ],
        ];

        foreach ($data as $item) {
            Tag::query()->updateOrCreate(
                [
                    'id' => $item['id'],
                ],
                $item
            );
        }
    }
}
