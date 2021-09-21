<?php

use App\Feeder;
use App\FtmOa;
use App\Olt;
use App\PanelFtmOa;
use App\SlotOlt;
use App\Sto;
use App\User;
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
        $user = User::create([
            'name' => 'Krisman Pratama',
            'email' => 'krismanpratama@gmail.com',
            'password' => bcrypt('zzzzzzzz'),
            'role' => 1
        ]);

        Sto::create([
            'nama_sto' => 'JMB',
            'alamat' => 'Telanaipura'
        ]);

        Sto::create([
            'nama_sto' => 'MND',
            'alamat' => 'Mendalo'
        ]);

        Olt::create([
            'hostname' => 'GPON01-D1-JMB-3',
            'ip' => '172.29.120.142',
            'sto_id' => 1,
            'merk' => 'ZTE',
            'type' => 'C300',
            'no_frame' => 2,
            'jumlah_slot' => 20
        ]);

        for ($i=1; $i <= 20; $i++) {
            SlotOlt::create([
                'olt_id' => 1,
                'no_slot' => $i
            ]);
        }

        Olt::create([
            'hostname' => 'GPON00-D1-MND-3',
            'ip' => '172.29.102.154',
            'sto_id' => 2,
            'merk' => 'ZTE',
            'type' => 'C300',
            'no_frame' => 1,
            'jumlah_slot' => 20
        ]);

        for ($i=1; $i <= 20; $i++) {
            SlotOlt::create([
                'olt_id' => 2,
                'no_slot' => $i
            ]);
        }

        FtmOa::create([
            'sto_id'=>1,
            'nama_ftm' => 'FTM-OA-JMB-1',
            'no_rak' => 5,
        ]);

        for ($i=1; $i <= 7 ; $i++) {
            PanelFtmOa::create([
                'ftm_oa_id' => 1,
                'no_panel' => $i,
            ]);
        }

        FtmOa::create([
            'sto_id'=>1,
            'nama_ftm' => 'FTM-OA-JMB-2',
            'no_rak' => 6,
        ]);

        for ($i=1; $i <= 7 ; $i++) {
            PanelFtmOa::create([
                'ftm_oa_id' => 2,
                'no_panel' => $i,
            ]);
        }

        FtmOa::create([
            'sto_id'=>2,
            'nama_ftm' => 'FTM-OA-MND-1',
            'no_rak' => 1,
        ]);

        for ($i=1; $i <= 7 ; $i++) {
            PanelFtmOa::create([
                'ftm_oa_id' => 3,
                'no_panel' => $i,
            ]);
        }

        FtmOa::create([
            'sto_id'=>2,
            'nama_ftm' => 'FTM-OA-MND-2',
            'no_rak' => 2,
        ]);

        for ($i=1; $i <= 7 ; $i++) {
            PanelFtmOa::create([
                'ftm_oa_id' => 4,
                'no_panel' => $i,
            ]);
        }

        // Feeder::create([
        //     'sto_id' => $sto->id,
        //     'nama_feeder' => 'FE-MND-01',
        //     'kapasitas' => 288
        // ]);

    }
}
