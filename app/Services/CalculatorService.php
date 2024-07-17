<?php
declare(strict_types=1);

namespace App\Services;

class CalculatorService
{
    public function calculateMonthlyPayment(float $yearRate, float $loanRange, int $monthRange): float
    {
        $monthlyRate = $yearRate / 12;

        return $loanRange * (($monthlyRate * pow((1 + $monthlyRate), $monthRange))
                / (pow((1 + $monthlyRate), $monthRange) - 1));
    }
}
