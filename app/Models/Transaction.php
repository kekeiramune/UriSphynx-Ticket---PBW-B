<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';

    protected $fillable = [
        'user_id',
        'id_concert',
        'id_price',
        'name',
        'payment_method',
        'total_price',
        'status',
        'payment_proof',
        'approved_at',
        'approved_by',
        'admin_notes'
    ];

    protected $casts = [
        'total_price' => 'integer',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the concert for this transaction.
     */
    public function concert(): BelongsTo
    {
        return $this->belongsTo(Concert::class, 'id_concert', 'id_concert');
    }

    /**
     * Get the concert price for this transaction.
     */
    public function concertPrice(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Concert_Price::class, 'id_price', 'id_price');
    }

    /**
     * Get the admin who approved this transaction.
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the tickets for this transaction.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'transaction_id', 'id_transaction');
    }
}
