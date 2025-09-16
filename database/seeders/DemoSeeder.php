<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // --- Insertar algunos clientes ---
        $clients = [];
        for ($i = 1; $i <= 5; $i++) {
            $clients[] = [
                'name'       => "Cliente $i",
                'tax_id'     => rand(10000000, 99999999),
                'email'      => "cliente$i@example.com",
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('clients')->insert($clients);

        // --- Insertar facturas ---
        $invoices = [];
        foreach (DB::table('clients')->pluck('id') as $clientId) {
            for ($j = 1; $j <= 3; $j++) {
                $issueDate = Carbon::now()->subDays(rand(1, 60));
                $dueDate   = (clone $issueDate)->addDays(rand(15, 45));
                $gross     = rand(1000, 5000);

                $invoices[] = [
                    'client_id'   => $clientId,
                    'number'      => strtoupper(Str::random(8)),
                    'issue_date'  => $issueDate,
                    'due_date'    => $dueDate,
                    'gross_amount'=> $gross,
                    'status'      => collect(['pending','ceded','paid'])->random(),
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }
        DB::table('invoices')->insert($invoices);

        // --- Insertar operaciones de factoring ---
        $factoring = [];
        foreach (DB::table('invoices')->pluck('id') as $invoiceId) {
            // Solo algunas facturas tendrán factoring
            if (rand(0, 1)) {
                $advanceRate = rand(60, 90); // porcentaje
                $feeRate     = rand(2, 10);  // porcentaje
                $invoice     = DB::table('invoices')->where('id', $invoiceId)->first();

                $advanceAmount   = $invoice->gross_amount * ($advanceRate / 100);
                $feeAmount       = $invoice->gross_amount * ($feeRate / 100);
                $settlementAmount= $advanceAmount - $feeAmount;

                $factoring[] = [
                    'invoice_id'        => $invoiceId,
                    'advance_rate'      => $advanceRate,
                    'fee_rate'          => $feeRate,
                    'advance_amount'    => $advanceAmount,
                    'fee_amount'        => $feeAmount,
                    'settlement_amount' => $settlementAmount,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ];
            }
        }
        DB::table('factoring_operations')->insert($factoring);
    }
}
