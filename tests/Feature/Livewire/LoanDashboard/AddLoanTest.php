<?php
declare(strict_types=1);

namespace Tests\Feature\Livewire\LoanDashboard;

use App\Jobs\CreateMonthlyPaymentJob;
use App\Livewire\LoanDashboard;
use App\Models\User;
use App\Services\CalculatorService;
use Database\Factories\LoanFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;
use Tests\TestCase;

class AddLoanTest extends TestCase
{
    Use RefreshDatabase, WithFaker;

    public function test_view_loan_can_be_added()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user);

        Queue::fake();

        Livewire::test(LoanDashboard::class, ['loan' => LoanFactory::new()->create()])
            ->assertSee('Loan amount')
            ->set('loanRange', 10000)
            ->assertSee('Payment month')
            ->set('monthRange', 12)
            ->assertSee('Year rate')
            ->set('yearRate', 5)
            ->assertDontSee("%: " . 5)
            ->assertSee(
                sprintf(
                    'Monthly payment: %s Euro',
                    number_format(
                        (new CalculatorService())->calculateMonthlyPayment(5, 10000, 12),
                        4,
                        ',',
                        ' '
                    )
                )
            )
            ->call('save')
            ->assertRedirect('/loan/dashboard/statistic');

        Queue::assertPushed(CreateMonthlyPaymentJob::class);
    }
}
