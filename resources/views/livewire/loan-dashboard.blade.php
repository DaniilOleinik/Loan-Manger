<section class="vh-100" style="background-color: #2779e2;">
    @if($loansCount > 0)
        <a href="{{ route('loan.dashboard.statistic') }}" class="float-end me-3 text-light pe-auto">Loan managing and statistic</a>
    @endif
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-white mb-4">Loan registration</h1>

                <div class="card" style="border-radius: 15px;">
                    <form wire:submit="save" class="card-body">

                        <div class="row align-items-center py-3">
                            <div class="col-md-9 ps-5">
                                <div class="input-group mb-3">
                                    <label for="customRange1" class="form-label">Loan amount</label>
                                    <input type="range" min="1" max="100000" wire:model.live="loanRange" class="form-range" id="customRange1">
                                </div>
                                <h4>Euro:
                                    <input type="number" min="1" max="100000" wire:model.live="loanRange" class="border-0 w-25" value="{{ $loanRange }}">
                                </h4>
                            </div>
                        </div>

                        <hr class="mx-n3">

                        <div class="row align-items-center py-3">
                            <div class="col-md-9 ps-5">
                                <div class="input-group mb-3">
                                    <label for="customRange1" class="form-label">Payment months</label>
                                    <input type="range" min="1" max="120" wire:model.live="monthRange" class="form-range" id="customRange1">
                                </div>
                                <h4>Months:
                                    <input type="number" min="1" max="120" wire:model.live="monthRange" class="border-0 w-25" value="{{ $monthRange }}">
                                </h4>
                            </div>
                        </div>

                        <hr class="mx-n3">

                        <div class="row align-items-center py-3">
                            <div class="col-md-9 ps-5">
                                <div class="input-group mb-3">
                                    <label for="customRange1" class="form-label">Year rate</label>
                                    <input disabled type="range" min="0" max="100" wire:model.live="yearRate" class="form-range" id="customRange1">
                                </div>
                                <h4>%:
                                    <input disabled type="number" min="0" max="100" wire:model.live="yearRate" class="border-0 w-25" value="{{ $yearRate }}">
                                </h4>
                            </div>
                        </div>

                        <hr class="mx-n3">

                        <div class="row align-items-center py-3">
                            <div class="col-md-9 ps-5">
                                <h4 wire:model.live="monthlyPayment">
                                    Monthly payment: {{ number_format($monthlyPayment, 4, ',', ' ') }} Euro
                                </h4>
                            </div>
                        </div>

                        <hr class="mx-n3">

                        <div class="px-5 py-4">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
