<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_principal',
        'monthly_payment',
        'annual_rate',
        'total_payment_number',
        'payment_number',
    ];

    public function loanPayment(): HasMany
    {
        return $this->hasMany(LoanPayment::class, 'loan_id', 'id');
    }
}
