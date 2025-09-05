@extends('layouts.error')

@section('title', '403 Forbidden')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="maintenance-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card error-card">
                        <div class="card-body">
                            <div class="error-image-block">
                                <img class="img-fluid" src="{{ asset('assets/images/pages/Error404.png') }}" alt="img" />
                                <img class="img-fluid img-twocone" src="{{ asset('assets/images/pages/TwoCone.png') }}"
                                    alt="img" />
                            </div>
                            <div class="text-center">
                                <h1 class="mt-5"><b>Page Not Found</b></h1>
                                <p class="mt-2 mb-4 text-muted">
                                    The page you are looking was moved, removed,
                                    <br />
                                    renamed, or might never exist!
                                </p>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Go to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
