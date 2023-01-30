@extends('client.layout')

@section('title', __('Edit Parcel'))

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
                            <li class="breadcrumb-item active">{{ __('Edit Parcel') }}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ __('Edit Parcel') }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="formId" action="{{ route('client.parcels.update', $parcel->id) }}">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <span class="text-danger" id="address_from_error"></span>
                                    <div class="form-floating mb-3 col-sm-12">
                                        <input type="text" name="address_from" class="form-control" id="floatingFrom"
                                            placeholder="{{ __('Address From') }}" value="{{ $parcel->address_from }}">
                                        <label for="floatingFrom">{{ __('Address From') }} <span
                                                style="color:red">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <span class="text-danger" id="address_to_error"></span>
                                    <div class="form-floating mb-3 col-sm-12">
                                        <input type="text" name="address_to" class="form-control" id="floatingTo"
                                            placeholder="{{ __('Address To') }}" value="{{ $parcel->address_to }}">
                                        <label for="floatingTo">{{ __('Address To') }} <span
                                                style="color:red">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-info" id="saveButton">{{ __('Save') }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
@endsection

@section('scripts')
    <script>
        $(function() {

            let saveButton = true;

            function toggleSaveButton() {
                if (saveButton) {
                    saveButton = false;
                    $('#saveButton, #saveAndNewButton').attr('disabled', true);
                    $("#saveButton").html("{{ __('Save') }}" +
                        ' <i class="spinner-border spinner-border-sm"></i>');
                    $("#saveAndNewButton").html("{{ __('Save & New') }}" +
                        ' <i class="spinner-border spinner-border-sm"></i>');
                } else {
                    saveButton = true;
                    $('#saveButton, #saveAndNewButton').attr('disabled', false);
                    $("#saveButton").html("{{ __('Save') }}");
                    $("#saveAndNewButton").html("{{ __('Save & New') }}");
                }
            }

            $('#formId').submit(function(e) {
                e.preventDefault();
                $('span[id*="_error"]').html('');
                $('*input').removeClass('is-invalid');
                var form = $('#formId')[0];
                var data = new FormData(form);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: $('#formId').attr('action'),
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: toggleSaveButton(),
                    success: function(response) {
                        if (response.status) {
                            window.location.href = "{{ route('client.parcels.index') }}";
                        }
                    },
                    error: function(data) {
                        toggleSaveButton();
                        $.each(data.responseJSON.errors, function(name, message) {

                            let inputName = name;
                            let inputError = name + '_error';

                            $('input[name="' + inputName + '"]').addClass(
                                'is-invalid');

                            $('span[id="' + inputError + '"]').html(
                                `<small>${message}</small>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection
