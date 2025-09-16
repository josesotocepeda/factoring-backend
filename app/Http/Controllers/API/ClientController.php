<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('search');
        $perPage = 10;

        $query = Client::query();
        if ($q) {
            $query->where('name','like','%'.$q.'%')->orWhere('tax_id','like','%'.$q.'%');
        }

        $clients = $query->orderBy('name')->paginate($perPage);

        return response()->json($clients);
    }

    public function invoices($id)
    {
        $client = Client::with(['invoices' => function($q) { $q->orderBy('due_date'); }])->findOrFail($id);
        return response()->json($client->invoices);
    }
}
