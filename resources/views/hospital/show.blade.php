@extends('admin.master')

@section('main_content')

    <div class="card radius-10" id="printableCard">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Hospital Details</h5>
                </div>
                <div class="font-22 ms-auto no-print">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                    <a href="{{ route('hospital.index') }}" class="btn btn-primary btn-sm float-end no-printt">Back</a>
                </div>
            </div>
            <hr>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-1">
                        <label class="form-label"><b>Hospital Name:</b></label>
                        <p>{{ $hospital->name }}</p>
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label"><b>Address:</b></label>
                        <p>{{ $hospital->address }}</p>
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label"><b>Phone:</b></label>
                        <p>{{ $hospital->phone ?? 'N/A' }}</p>
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label"><b>Email:</b></label>
                        <p>{{ $hospital->email ?? 'N/A' }}</p>
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label"><b>Website:</b></label>
                        <p>{{ $hospital->website ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-1">
                        <label class="form-label"><b>Working Hours:</b></label>
                        @if ($hospital->workingHours->isNotEmpty())
                            <ol class="list-group list-group-numbered">
                                @foreach ($hospital->workingHours as $hours)
                                    <li class="list-group-item">
                                        <b>{{ ucfirst($hours->day) }}</b>: {{date("g:i A", strtotime($hours->start_time))}} - {{date("g:i A", strtotime($hours->end_time))}}
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p>Not set</p>
                        @endif
                    </div>
                </div>
                <button onclick="printCard()" class="btn btn-primary btn-sm no-print">Print</button>  {{-- Print button --}}
            </div>
        </div>
    </div>

    <script>
        function printCard() {
            var printContents = document.getElementById('printableCard').innerHTML; // Get card content
            var originalContents = document.body.innerHTML; // Store original content

            document.body.innerHTML = printContents; // Replace body content with card content

            window.print(); // Print the page

            document.body.innerHTML = originalContents; // Restore original content
        }
    </script>
    <style>
        @media print {
            body {
                margin: 0; /* Remove default body margins */
                font-size: 12pt;
            }

            #printableArea { /* Target the printable area */
                border: 1px solid #ccc; /* Example: add a border for printing */
                padding: 20px;
            }

            .no-print {
                display: none;
            }

        }
    </style>

@endsection
