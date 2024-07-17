<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Models\Loan;
use App\Models\LoanPayment;
use App\Repositories\LoanRepository;
use App\Services\LoanService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Throwable;

class LoanDashboardStatistic extends Component
{
    public $loans;

    public function save(LoanService $loanService, int $loanId, int $loanPaymentId): void
    {
        try {
            DB::beginTransaction();

            LoanPayment::where('id', $loanPaymentId)
                ->update([
                    'is_paid' => true,
                ]);

            Loan::where('id', $loanId)
                ->update([
                    'payment_number' => +1
                ]);

            DB::commit();
        } catch (Throwable) {
            DB::rollBack();
        }

        $loanService->closeFullyPaidLoan($loanId);
    }

    public function render(LoanRepository $loanRepository)
    {
        $this->loans = $loanRepository->getLoansWithPaymentsByUserId(Auth::id());

        return view('livewire.loan-dashboard-statistic')->extends('layouts.app');
    }
}
