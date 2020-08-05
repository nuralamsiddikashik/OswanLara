<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\ProductCategory;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call( UserSeeder::class );
        factory( ProductCategory::class, 5 )->create();

    }
}
