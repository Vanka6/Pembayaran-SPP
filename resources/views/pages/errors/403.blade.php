@extends('layouts.error')

@section('title', '403 Forbidden')

@section('content')
    <div class="maintenance-block">
        <div class="container">
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card construction-card">
                        <div class="card-body">
                            <div class="construction-image-block">
                                <div class="row justify-content-center">
                                    <div class="col-10">
                                        <img class="img-fluid" src="{{ asset('assets/images/pages/Error403.png') }}"
                                            alt="img" />
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h1 class="mt-4"><b>Under Construction</b></h1>
                                <p class="mt-4 text-muted">
                                    Hey! Please check out this site later. We are doing
                                    <br />
                                    some maintenance on it right now.
                                </p>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">Back To Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
    </div>
@endsection
