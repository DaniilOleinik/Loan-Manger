<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Loan;

class LoanRepository
{
    public function getLoansWithPaymentsByUserId(int $userId): array
    {
        return Loan::where('user_id', $userId)->with('loanPayment')->orderBy('created_at', 'desc')->get()->all();
    }
}
