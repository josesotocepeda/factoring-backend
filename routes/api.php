<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\FactoringController;

Route::middleware('api_key')->group(function() {
  Route::get('clients', [ClientController::class,'index']);
  Route::get('clients/{id}/invoices', [ClientController::class,'invoices']);

  Route::post('invoices', [InvoiceController::class,'store']);

  Route::post('factoring/cede', [FactoringController::class,'cede']);
  Route::post('factoring/mark-paid', [FactoringController::class,'markPaid']);
});

/*
  - GET /api/clients?search=&page=
  - GET /api/clients/{id}/invoices
  - POST /api/invoices
  - POST /api/factoring/cede
  - POST /api/factoring/mark-paid
*/
