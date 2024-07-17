<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_id',
        'amount',
        'is_paid',
    ];

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class, 'id', 'loan_id');
    }
}
