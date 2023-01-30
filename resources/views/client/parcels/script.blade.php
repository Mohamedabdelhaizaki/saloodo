@section('hearder-scripts')
    <!-- third party css -->
    <link href="{{ asset('css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('scripts')
    <!-- third party js -->
    @include('client.partial.datatables-imports')

    <script>
        $(function() {

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
                    url: "{{ route('client.parcels.index') }}"
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
                                    return `<span class='badge bg-warning rounded-pill'>{{ __('Pending') }}</span>`;
                                    break;

                                case 1:
                                    return `<span class='badge bg-info rounded-pill'>{{ __('Picked') }}</span>`;
                                    break;

                                case 2:
                                    return `<span class='badge bg-success rounded-pill'>{{ __('Delivered') }}</span>`;
                                    break;

                                default:
                                    return `<span class='badge bg-warning rounded-pill'>{{ __('Pending') }}</span>`;
                                    break;
                            }

                        },
                        name: 'status'
                    },
                    {
                        data: "picked_at",
                        name: 'picked_at'
                    },
                    {
                        data: "delivered_at",
                        name: 'delivered_at'
                    },
                    {
                        data: "created_at",
                        name: 'created_at'
                    },

                    {
                        class: "text-center",
                        data: function(data) {
                            let showRoute = '';
                            if (data.status == 0) {
                                showRoute =
                                    `<a href="${data.edit_route}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="{{ __('Edit') }}"
                                ><i class="mdi mdi-18px mdi-square-edit-outline me-2 text-muted vertical-middle"></i></a>`
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
        });
    </script>
@endsection
