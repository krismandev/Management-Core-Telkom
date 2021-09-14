<?php

use App\Feeder;
use App\Sto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $sto = Sto::create([
            'nama_sto' => 'MND',
            'alamat' => 'Mendalo'
        ]);

        Feeder::create([
            'sto_id' => $sto->id,
            'nama_feeder' => 'FE-MND-01',
            'kapasitas' => 288
        ]);

    }
}
