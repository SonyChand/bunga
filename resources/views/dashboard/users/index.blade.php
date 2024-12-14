<x-dash.layout>
    @push('header')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    @endpush
    @slot('title')
        {{ $title }}
    @endslot


    <div class="mb-9">
        <div id="projectSummary">
            <div class="row g-3 justify-content-end align-items-end mb-4">
                <div class="col-md-12 mb-4">
                    <div class="p-6 m-20 bg-white rounded shadow" id="chart-container">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
            <div class="card shadow-none border my-4" data-component-card="data-component-card">
                <div class="card-header p-4 border-bottom bg-body">
                    <div class="row g-3 justify-content-between align-items-center">
                        <div class="col-12 col-md">
                            <h4 class="mb-0">{{ $title }}<span
                                    class="fw-normal text-body-tertiary ms-3"></span></h4>
                        </div>
                        <div class="col col-md-auto">
                            <nav class="nav justify-content-end doc-tab-nav align-items-center" role="tablist">

                                @can('user-create')
                                    <a class="btn btn-sm btn-primary mx-2" href="{{ route('users.create') }}">
                                        <i class="fa-solid fa-plus me-2"></i>Tambah
                                    </a>
                                @endcan
                                @can('user-download')
                                    <div class="btn-group">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-file-export me-2"></i>Export
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                                <li>
                                                    <form action="{{ route('users.export', 'pdf') }}" method="get"
                                                        id="exportPdfForm">
                                                        <button class="dropdown-item" type="submit">
                                                            Export PDF
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('users.export', 'excel') }}" method="get"
                                                        id="exportExcelForm">
                                                        <button class="dropdown-item" type="submit">
                                                            Export Excel
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item" onclick="window.print()">
                                                        Export Diagram
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endcan
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive-sm scrollbar d-print-none">
                        <table class="table table-bordered table-striped" id="yajra" width="100%">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('footer')
        <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
        <script src={{ asset('backend/js/dashboard/user.js') }}></script>
        {{ $chart->script() }}
    @endpush
</x-dash.layout>
