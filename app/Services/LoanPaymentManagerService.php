<?php
declare(strict_types=1);

namespace App\Services;

use App\Jobs\CreateMonthlyPaymentJob;
use App\Models\Loan;

class LoanPaymentManagerService
{
    public function checkWhetherNewPaymentNeedsCreation(): void
    {
        $loans = Loan::where('next_payment_date', now()->format('Y-m-d'))
            ->whereNull('deleted_at')
            ->get();

        foreach ($loans as $loan) {
            dispatch(new CreateMonthlyPaymentJob($loan->user_id, $loan->id, $loan->amount));
        }
    }
}
