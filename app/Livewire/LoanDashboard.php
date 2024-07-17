<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Jobs\CreateMonthlyPaymentJob;
use App\Models\Loan;
use App\Services\CalculatorService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoanDashboard extends Component
{
    public $loansCount;
    public $loanRange = 1;
    public $monthRange = 1;
    public $yearRate = 5;
    public $monthlyPayment;

    public function save()
    {
        $loan = Loan::create([
            'user_id' => Auth::user()->id,
            'loan_principal' => $this->loanRange,
            'monthly_payment' => $this->monthlyPayment,
            'annual_rate' => $this->yearRate,
            'total_payment_number' => $this->monthRange,
        ]);

        dispatch(new CreateMonthlyPaymentJob($loan->user_id, $loan->id, $loan->monthly_payment));

        return redirect(route('loan.dashboard.statistic'));
    }

    public function render(CalculatorService $calculatorService)
    {
        $this->loansCount = Loan::where('user_id', Auth::id())->count();

        $this->monthlyPayment = $calculatorService->calculateMonthlyPayment(
            (float) $this->yearRate, (float) $this->loanRange, (int) $this->monthRange
        );

        return view('livewire.loan-dashboard')->extends('layouts.app');
    }
}
