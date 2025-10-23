<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Compte;
use App\Models\Transaction;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $compte1 = Compte::where('numeroCompte', 'C00123456')->first();
        $compte2 = Compte::where('numeroCompte', 'C00123457')->first();
        $compte3 = Compte::where('numeroCompte', 'C00123458')->first();
        $compte4 = Compte::where('numeroCompte', 'C00123459')->first();

        if ($compte1) {
            Transaction::create([
                'compte_id' => $compte1->id,
                'type' => 'depot',
                'montant' => 1000000,
                'date' => '2023-01-16',
                'description' => 'Dépôt initial',
            ]);
            Transaction::create([
                'compte_id' => $compte1->id,
                'type' => 'retrait',
                'montant' => 50000,
                'date' => '2023-01-20',
                'description' => 'Retrait DAB',
            ]);
        }

        if ($compte2) {
            Transaction::create([
                'compte_id' => $compte2->id,
                'type' => 'depot',
                'montant' => 500000,
                'date' => '2023-02-02',
                'description' => 'Dépôt chèque',
            ]);
            Transaction::create([
                'compte_id' => $compte2->id,
                'type' => 'retrait',
                'montant' => 100000,
                'date' => '2023-02-10',
                'description' => 'Paiement facture',
            ]);
        }

        if ($compte3) {
            Transaction::create([
                'compte_id' => $compte3->id,
                'type' => 'depot',
                'montant' => 200000,
                'date' => '2023-03-11',
                'description' => 'Dépôt salaire',
            ]);
        }

        if ($compte4) {
            Transaction::create([
                'compte_id' => $compte4->id,
                'type' => 'depot',
                'montant' => 300000,
                'date' => '2023-04-23',
                'description' => 'Dépôt virement',
            ]);
        }
    }
}
