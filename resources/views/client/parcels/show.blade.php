@extends('client.layout')

@section('title', __('Show Parcel'))

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
                            <li class="breadcrumb-item"><a href="{{ route('client.parcels.index') }}">{{ __('Parcels') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Show Parcel') }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Show Parcel') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <span class="text-danger" id="from_error"></span>
                                <div class="form-floating mb-3 col-sm-12">
                                    <input type="text" name="from" class="form-control" id="floatingFrom"
                                        placeholder="{{ __('Address From') }}" value="{{ $parcel->address_from }}" disabled>
                                    <label for="floatingFrom">{{ __('Address From') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <span class="text-danger" id="to_error"></span>
                                <div class="form-floating mb-3 col-sm-12">
                                    <input type="text" name="to" class="form-control" id="floatingTo"
                                        placeholder="{{ __('Address To') }}" value="{{ $parcel->address_to }}" disabled>
                                    <label for="floatingTo">{{ __('Address To') }}</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <span class="text-danger" id="value_error"></span>
                                <div class="form-floating mb-3 col-sm-12">
                                    <input type="text" name="value" class="form-control" id="floatingStatus"
                                        placeholder="{{ __('Status') }}"
                                        value="@switch($parcel->status)
                                        @case(0){{ __('Pending') }}@break
                                        @case(1){{ __('Picked') }}@break
                                        @case(2){{ __('Delivered') }}@break
                                        @default{{ __('Pending') }}@endswitch"
                                        disabled>
                                    <label for="floatingStatus">{{ __('Status') }}</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <span class="text-danger" id="value_error"></span>
                                <div class="form-floating mb-3 col-sm-12">
                                    <input type="text" name="value" class="form-control" id="floatingCreationDate"
                                        placeholder="{{ __('Creation Date') }}" value="{{ $parcel->created_at }}"
                                        disabled>
                                    <label for="floatingCreationDate">{{ __('Creation Date') }}</label>
                                </div>
                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <span class="text-danger" id="value_error"></span>
                                <div class="form-floating mb-3 col-sm-12">
                                    <input type="text" name="value" class="form-control" id="pickedDate"
                                        placeholder="{{ __('Picked Date') }}" value="{{ $parcel->picked_at }}" disabled>
                                    <label for="pickedDate">{{ __('Picked Date') }}</label>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <span class="text-danger" id="value_error"></span>
                                <div class="form-floating mb-3 col-sm-12">
                                    <input type="text" name="value" class="form-control" id="deliveredDate"
                                        placeholder="{{ __('delivered Date') }}" value="{{ $parcel->delivered_at }}"
                                        disabled>
                                    <label for="deliveredDate">{{ __('delivered Date') }}</label>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- container -->
    @endsection
