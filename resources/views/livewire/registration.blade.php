<section class="vh-100" style="background-color: #2779e2;">
    <a href="{{ route('login') }}" class="float-end me-3 text-light pe-auto">Login</a>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-white mb-4">Registration</h1>

                <div class="card" style="border-radius: 15px;">
                    <form wire:submit="save" class="card-body">

                        <div class="row align-items-center pt-4 pb-3">
                            <div class="col-md-3 ps-5">
                                <h6 class="mb-0">Full name</h6>
                            </div>
                            <div class="col-md-9 pe-5">
                                <input type="text" wire:model="name" class="form-control form-control-lg" />
                            </div>
                        </div>

                        <hr class="mx-n3">

                        <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">
                                <h6 class="mb-0">Email address</h6>
                            </div>
                            <div class="col-md-9 pe-5">
                                <input type="email" wire:model="email" class="form-control form-control-lg" placeholder="example@example.com" />
                            </div>
                        </div>

                        <hr class="mx-n3">

                        <div class="row align-items-center py-3">
                            <div class="col-md-3 ps-5">
                                <h6 class="mb-0">Password</h6>
                            </div>
                            <div class="col-md-9 pe-5">
                                <input wire:model="password" type="password" class="form-control form-control-lg"/>
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
