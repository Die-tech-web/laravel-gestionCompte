<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Compte;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ComptesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample clients
        $clientUser1 = User::create([
            'name' => 'Client One',
            'email' => 'client1@example.com',
            'password' => Hash::make('password'),
        ]);
        $client1 = Client::create([
            'user_id' => $clientUser1->id,
            'phone' => '111-222-3333',
            'address' => '123 Client St',
        ]);

        $clientUser2 = User::create([
            'name' => 'Client Two',
            'email' => 'client2@example.com',
            'password' => Hash::make('password'),
        ]);
        $client2 = Client::create([
            'user_id' => $clientUser2->id,
            'phone' => '444-555-6666',
            'address' => '456 Customer Ave',
        ]);

        // Create accounts for client1
        Compte::create([
            'numeroCompte' => 'C00123456',
            'client_id' => $client1->id,
            'type' => 'epargne',
            'devise' => 'XOF',
            'dateCreation' => '2023-01-15',
            'statut' => 'actif',
            'derniereModification' => now(),
            'version' => 1,
        ]);

        Compte::create([
            'numeroCompte' => 'C00123457',
            'client_id' => $client1->id,
            'type' => 'cheque',
            'devise' => 'XOF',
            'dateCreation' => '2023-02-01',
            'statut' => 'actif',
            'derniereModification' => now(),
            'version' => 1,
        ]);

        // Create accounts for client2
        Compte::create([
            'numeroCompte' => 'C00123458',
            'client_id' => $client2->id,
            'type' => 'epargne',
            'devise' => 'XOF',
            'dateCreation' => '2023-03-10',
            'statut' => 'bloque',
            'derniereModification' => now(),
            'version' => 1,
        ]);

        Compte::create([
            'numeroCompte' => 'C00123459',
            'client_id' => $client2->id,
            'type' => 'cheque',
            'devise' => 'XOF',
            'dateCreation' => '2023-04-22',
            'statut' => 'ferme',
            'derniereModification' => now(),
            'version' => 1,
        ]);
    }
}
