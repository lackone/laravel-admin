<div class="row">
    <div class="col-lg-12">
        @if(session('message'))
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-circle me-2"></i>
                <div>
                    {{ session('message') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-alert me-2"></i>
                    <div>
                        {{ $error }}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif

        @if(session('warning'))
            <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                <i class="mdi mdi-alert-circle me-2"></i>
                <div>
                    {{ session('warning') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
