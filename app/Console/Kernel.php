<?php
declare(strict_types=1);

namespace App\Console;

use App\Services\LoanPaymentManagerService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function (LoanPaymentManagerService $loanPaymentManagerService) {
            $loanPaymentManagerService->checkWhetherNewPaymentNeedsCreation();
        })->daily()->at('07:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
