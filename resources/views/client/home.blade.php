@extends('client.layout')

@section('title', __('Home'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('client.home') }}">{{ __('Home') }}</a>
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Home') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card widget-inline">
                                    <div class="card-body p-0">
                                        <div class="row g-0">
                                            <div class="col-sm-9 col-xl-4">
                                                <div class="card shadow-none m-0">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-checklist text-muted"
                                                            style="font-size: 24px;"></i>
                                                        <h3><span>{{ $pending }}</span></h3>
                                                        <p class="text-muted font-15 mb-0">{{ __('Pending') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-9 col-xl-4">
                                                <div class="card shadow-none m-0 border-start">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-swap text-muted" style="font-size: 24px;"></i>
                                                        <h3><span>{{ $picked }}</span></h3>
                                                        <p class="text-muted font-15 mb-0">{{ __('Picked') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-9 col-xl-4">
                                                <div class="card shadow-none m-0 border-start">
                                                    <div class="card-body text-center">
                                                        <i class="dripicons-thumbs-up text-muted"
                                                            style="font-size: 24px;"></i>
                                                        <h3><span>{{ $delivered }}</span></h3>
                                                        <p class="text-muted font-15 mb-0">{{ __('Delivered') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> <!-- end row -->
                                    </div>
                                </div> <!-- end card-box-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
@endsection
