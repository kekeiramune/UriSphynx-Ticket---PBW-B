<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'id_ticket';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'id_concert',
        'id_price',
        'ticket_code',
        'qr_code_path',
        'status',
        'used_at'
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    /**
     * Get the transaction that owns the ticket.
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id_transaction');
    }

    /**
     * Get the user that owns the ticket.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the concert for this ticket.
     */
    public function concert(): BelongsTo
    {
        return $this->belongsTo(Concert::class, 'id_concert', 'id_concert');
    }

    /**
     * Get the concert price for this ticket.
     */
    public function concertPrice(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Concert_Price::class, 'id_price', 'id_price');
    }
}
