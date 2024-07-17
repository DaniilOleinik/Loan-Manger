<?php
declare(strict_types=1);

namespace App\Jobs;

use App\Models\Loan;
use App\Models\LoanPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateMonthlyPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $user_id;
    private int $loan_id;
    private float $amount;

    public function __construct(int $user_id, int $loan_id, float $amount)
    {
        $this->user_id = $user_id;
        $this->loan_id = $loan_id;
        $this->amount = $amount;
    }

    public function handle(): void
    {
        try {
            DB::beginTransaction();

            LoanPayment::create([
                'user_id' => $this->user_id,
                'loan_id' => $this->loan_id,
                'amount' => $this->amount,
            ]);

            Loan::update([
                'next_payment_date' => now()->addMonths()->format('Y-m-d'),
            ]);

            DB::commit();
        } catch (Throwable) {
            DB::rollBack();
        }
    }
}
