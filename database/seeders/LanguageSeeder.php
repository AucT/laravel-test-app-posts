<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\UserColor;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'locale' => 'Українська',
                'prefix' => 'uk',
            ],
            [
                'id' => 2,
                'locale' => 'English',
                'prefix' => 'en',
            ],
        ];

        foreach ($data as $item) {
            Language::query()->updateOrCreate(
                [
                    'id' => $item['id'],
                ],
                $item
            );
        }
    }
}
