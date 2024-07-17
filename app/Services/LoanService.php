<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Loan;

class LoanService
{
    public function closeFullyPaidLoan(int $loanId): void
    {
        $loan = Loan::find($loanId);

        if ($loan->total_payment_number == $loan->payment_number) {
            $loan->delete();
        }
    }
}
