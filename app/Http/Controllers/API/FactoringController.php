<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CedeFactoringRequest;
use App\Http\Requests\MarkPaidRequest;
use App\Models\FactoringOperation;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactoringController extends Controller
{
    public function cede(CedeFactoringRequest $request)
    {
        $data = $request->validated();

        return DB::transaction(function() use ($data) {
            $invoice = Invoice::lockForUpdate()->findOrFail($data['invoice_id']);

            if ($invoice->status !== 'pending') {
                return response()->json(['message' => 'Invoice must be pending to cede'], 422);
            }

            $advance_amount = round($invoice->gross_amount * ($data['advance_rate'] / 100), 2);
            $fee_amount = round($invoice->gross_amount * ($data['fee_rate'] / 100), 2);
            $settlement_amount = round($advance_amount - $fee_amount, 2);

            $op = FactoringOperation::create([
                'invoice_id' => $invoice->id,
                'advance_rate' => $data['advance_rate'],
                'fee_rate' => $data['fee_rate'],
                'advance_amount' => $advance_amount,
                'fee_amount' => $fee_amount,
                'settlement_amount' => $settlement_amount,
            ]);

            $invoice->status = 'ceded';
            $invoice->save();

            return response()->json([
                'operation' => $op,
                'invoice' => $invoice,
            ], 201);
        });
    }

    public function markPaid(MarkPaidRequest $request)
    {
        $data = $request->validated();
        $invoice = Invoice::findOrFail($data['invoice_id']);

        if ($invoice->status === 'paid') {
            return response()->json(['message' => 'Already paid'], 422);
        }

        $invoice->status = 'paid';
        $invoice->save();

        return response()->json(['invoice' => $invoice]);
    }
}
