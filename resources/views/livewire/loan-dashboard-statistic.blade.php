<section class="vh-auto" style="background-color: #2779e2;">
    <a href="{{ route('loan.dashboard') }}" class="float-end me-3 text-light pe-auto">Loan dashboard</a>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            @foreach($loans as $loan)
                <div class="border border-1 w-75 m-5">
                    <h3 class="float-end m-3 text-white ">
                        Loan Nr: {{ $loan->id }}
                    </h3>
                    <div class="col-xl-9 w-100 p-3">
                        <h1 class="text-white mb-4">Payments</h1>
                            @foreach($loan->loanPayment as $loanPayment)
                            @if($loanPayment->is_paid)
                                <div class="card bg-secondary" style="border-radius: 15px;">
                                <form class="card-body">
                                    <div class="row align-items-center py-3">
                                        <div class="col-md-9 ps-5">
                                            <h6 class="mb-0">
                                                Payment from {{ $loanPayment->created_at }}
                                                until {{ $loanPayment->created_at->addDays(30) }}
                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row align-items-center py-3">
                                        <div class="col-md-9 ps-5">
                                            <h6 class="mb-0">
                                                {{ $loanPayment->amount }} Euro
                                            </h6>
                                        </div>
                                    </div>

                                    <hr class="mx-n3">

                                    <div class="px-5 py-4">
                                        <span>Paid</span>
                                    </div>
                                </form>
                                </form>
                                </div>
                            @else
                                <div class="card" style="border-radius: 15px;">
                                <form wire:submit="save({{ $loan->id }}, {{ $loanPayment->id }})" class="card-body">
                                    <div class="row align-items-center py-3">
                                        <div class="col-md-9 ps-5">
                                            <h6 class="mb-0">
                                                Payment from {{ $loanPayment->created_at }}
                                                until {{ $loanPayment->created_at->addDays(30) }}

                                            </h6>
                                        </div>
                                    </div>

                                    <div class="row align-items-center py-3">
                                        <div class="col-md-9 ps-5">
                                            <h6 class="mb-0">
                                                {{ $loanPayment->amount }} Euro
                                            </h6>
                                        </div>
                                    </div>

                                    <hr class="mx-n3">

                                    <div class="px-5 py-4">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Pay</button>
                                    </div>
                                </form>
                                </div>
                            @endif
                            @endforeach
                    </div>

                    <div class="col-xl-9 w-100 p-3">
                        <h1 class="text-white mb-4">Loan statistic</h1>

                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">
                                <div class="row align-items-center py-3">
                                    <div class="d-flex ps-5 pe-5 align-items-center justify-content-between flex-row w-100">
                                        <h6>
                                            {{ (int) $loan->payment_number }} / {{ $loan->total_payment_number }} paid
                                        </h6>
                                        @if($loan->deleted_at)
                                            <h6 class="text-danger">
                                                Loan is closed
                                            </h6>
                                        @endif
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-3">
                                    <div class="col-md-9 ps-5">
                                        <h6>
                                            {{ $loan->total_payment_number * $loan->monthly_payment - $loan->payment_number * $loan->monthly_payment }} Euro
                                            remaining to pay
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
