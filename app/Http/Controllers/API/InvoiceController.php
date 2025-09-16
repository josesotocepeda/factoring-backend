<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();
        $invoice = Invoice::create($data);
        return response()->json($invoice, 201);
    }
}
