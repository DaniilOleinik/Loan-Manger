<?php
declare(strict_types=1);

namespace Tests\Feature\Livewire\LoanDashboardStatistic;

use App\Livewire\LoanDashboardStatistic;
use App\Models\Loan;
use App\Models\LoanPayment;
use App\Models\User;
use App\Repositories\LoanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PaymentCreationTest extends TestCase
{
    Use RefreshDatabase, WithFaker;

    public function test_payment_creation()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user);

        $loans[] = Loan::factory()->create();

        $loanPayments = [];

        foreach ($loans as $loan) {
           $loanPayments[] = LoanPayment::factory()->create([
                'user_id' => $user->id,
                'loan_id' => $loan->id,
                'amount' => rand(1, 100000) / 10,
                'is_paid' => false,
            ]);
        }

        $mockRepository = $this->mock(LoanRepository::class);
        $mockRepository->shouldReceive('getLoansWithPaymentsByUserId')
            ->with($user->id)
            ->andReturn($loans);

        Livewire::test(LoanDashboardStatistic::class)
            ->assertSee('Payments')
            ->assertSee('Pay')
            ->call('save', $loans[0]->id, $loanPayments[0]->id)
            ->assertSee('paid');
    }
}
