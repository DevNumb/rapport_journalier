<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Worker;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $workers = [
            [
                'id'    => 1,
                'name'  => 'Administrateur',
                'email' => 'admin@example.com',
                'password' => bcrypt('changeme'),
                'role'  => 'admin',
                'poste' => 'Directeur',
            ],
            [
                'id'    => 26,
                'name'  => 'Haifa Khlifi',
                'email' => 'Haifa.Khlifi@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur d\'études',
            ],
            [
                'id'    => 27,
                'name'  => 'Saida Zaidi',
                'email' => 'Saida.zaidi@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur d\'études', // Changed from null
            ],
            [
                'id'    => 28,
                'name'  => 'Amira Ben Abed',
                'email' => 'amira.benabed@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur d\'études',
            ],
            [
                'id'    => 25,
                'name'  => 'Saoussen Aguel',
                'email' => 'saoussen.aguel@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur d\'études',
            ],
            [
                'id'    => 8,
                'name'  => 'Sofien Eleuch',
                'email' => 'sofien.eleuch@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'Ingénieur environnement responsable agence Sfax',
            ],
            [
                'id'    => 9,
                'name'  => 'Abderrahmen ben abdallah',
                'email' => 'a.benabdallah@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'DAF',
            ],
            [
                'id'    => 22,
                'name'  => 'Moussa Maarouf',
                'email' => 'moussa.maarouf@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'Directeur Etudes',
            ],
            [
                'id'    => 21,
                'name'  => 'ala haboubi',
                'email' => 'ala.haboubi@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'Ing GC',
            ],
            [
                'id'    => 23,
                'name'  => 'ibtissem Ben mansour',
                'email' => 'ibtissem.benmansour@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'chargée des AO',
            ],
            [
                'id'    => 24,
                'name'  => 'Houssem Mekki',
                'email' => 'houssem.mekki@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur d\'études', // Changed from null
            ],
            [
                'id'    => 12,
                'name'  => 'Tarek Abdallah',
                'email' => 'tarek.abdallah@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'Ingénieur Géoressources et environnement',
            ],
            [
                'id'    => 14,
                'name'  => 'Fethi Bouzayani',
                'email' => 'Fethi.bouzayani@gerep-environnement.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur SIG et Environnement',
            ],
            [
                'id'    => 29,
                'name'  => 'useree',
                'email' => 'userzz@gmail.com',
                'password' => bcrypt('changeme'),
                'role'  => 'worker',
                'poste' => 'ingénieur d\'études',
            ],
        ];

        foreach ($workers as $workerData) {
            Worker::create($workerData);
        }
    }
}
