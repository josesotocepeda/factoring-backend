<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','number','issue_date','due_date','gross_amount','status'];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'gross_amount' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function factoringOperations(): HasMany
    {
        return $this->hasMany(FactoringOperation::class);
    }
}
