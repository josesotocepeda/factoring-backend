<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FactoringOperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id','advance_rate','fee_rate','advance_amount','fee_amount','settlement_amount'
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
