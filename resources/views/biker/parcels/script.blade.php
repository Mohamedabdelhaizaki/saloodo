@section('hearder-scripts')
    <!-- third party css -->
    <link href="{{ asset('css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('scripts')
    <!-- third party js -->
    @include('biker.partial.datatables-imports')

    <script>
        $(document).ready(function() {
            var parcelId, status;
            var table = $("#parcelsTable").DataTable({
                columnDefs: [{
                    "targets": 0, // first column only center
                    "className": "text-center",
                }],
                autoWidth: false,
                serverSide: true,
                processing: true,
                lengthChange: true,
                dom: 'lfrtip',
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, 'All']
                ],
                ajax: {
                    url: "{{ route('biker.toDoList.index') }}"
                },
                columns: [{
                        data: function(data, type, full, meta) {
                            return meta.row + 1;
                        },
                        name: 'id',
                        searchable: false
                    },
                    {
                        data: "address_from",
                        name: 'address_from'
                    },
                    {
                        data: "address_to",
                        name: 'address_to'
                    },
                    {
                        data: function(data) {
                            switch (data.status) {
                                case 0:
                                    return `<span class='badge bg-warning rounded-pill'>{{ __('New') }}</span>`;
                                    break;

                                case 1:
                                    return `<span class='badge bg-info rounded-pill'>{{ __('Picked') }}</span>`;
                                    break;

                                case 2:
                                    return `<span class='badge bg-success rounded-pill'>{{ __('Finished') }}</span>`;
                                    break;

                                default:
                                    return `<span class='badge bg-warning rounded-pill'>{{ __('New') }}</span>`;
                                    break;
                            }

                        },
                        name: 'status'
                    },
                    {
                        data: "created_at",
                        name: 'created_at'
                    },

                    {
                        class: "text-center",
                        data: function(data) {
                            let showRoute = '';
                            switch (data.status) {
                                case 0:
                                    showRoute =
                                        `<button type="button" class="btn btn-primary" id="pickParcel" data-id="${data.id}" title="{{ __('Pick') }}">{{ __('Pick') }}</button>`;
                                    break;

                                case 1:
                                    showRoute =
                                        `<button type="button" class="btn btn-success" id="deliverParcel" data-id="${data.id}" title="{{ __('delivered') }}">{{ __('delivered') }}</button>`;
                                    break;

                            }
                            return `<a
                            href="${data.show_route}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="{{ __('Show') }}"
                            ><i class="mdi mdi-18px mdi-eye me-2 text-muted vertical-middle"></i>
                            </a>` + showRoute;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            table.on('draw', function() {
                var tooltipTriggerList = [].slice.call(
                    document.querySelectorAll('[data-bs-toggle="tooltip"]')
                );
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            $(document).on("click", "#pickParcel", function() {
                parcelId = $(this).attr('data-id');
                status = 1;
                updateParcelStatus();
            });

            $(document).on("click", "#deliverParcel", function() {
                parcelId = $(this).attr('data-id');
                status = 2;
                updateParcelStatus();
            });

            function updateParcelStatus() {
                let url = '{{ route('biker.toDoList.updateParcelStatus', ':id') }}';
                url = url.replace(':id', parcelId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    }
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'status': status
                    },
                    success: function(response) {
                        if (response.status) {
                            $.NotificationApp.send("", response.message, "top-right", "rgba(0,0,0,0.2)",
                                response.messageStatus);
                            table.draw();
                        }
                    },
                    error: function(data) {}
                });
            }


        });
    </script>
@endsection
