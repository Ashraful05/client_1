@extends('admin.master')

@section('main_content')

    <div class="card radius-10">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Edit Hospital</h5>
                </div>
                <div class="font-22 ms-auto">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                    <a href="{{ route('hospital.index') }}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>
            </div>
            <hr>

            <form action="{{ route('hospital.update', $hospital) }}" method="POST">
                @csrf
                @method('PUT')  {{-- Important for updates --}}

                <div class="form-group mb-1">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $hospital->name }}" required>
                </div>

                <div class="form-group mb-1">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" class="form-control" required>{{ $hospital->address }}</textarea>
                </div>

                <div class="form-group mb-1">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $hospital->phone }}">
                </div>

                <div class="form-group mb-1">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $hospital->email }}">
                </div>

                <div class="form-group mb-1">
                    <label for="website">Website:</label>
                    <input type="url" name="website" id="website" class="form-control" value="{{ $hospital->website }}">
                </div>

                <div class="form-group mb-1">
                    <label><b>Working Hours:</b></label>
                    <div id="working-hours-container">
                        @if ($hospital->workingHours->isNotEmpty())
                            @foreach ($hospital->workingHours as $hours)
                                <div class="working-hour-row">
                                    <select name="working_hours[{{ $loop->index }}][day]" class="mt-2">
                                        <option value="monday" {{ $hours->day == 'monday' ? 'selected' : '' }}>Monday</option>
                                        <option value="tuesday" {{ $hours->day == 'tuesday' ? 'selected' : '' }}>Tuesday</option>
                                        <option value="wednesday" {{ $hours->day == 'wednesday' ? 'selected' : '' }}>Wednesday</option>
                                        <option value="thursday" {{ $hours->day == 'thursday' ? 'selected' : '' }}>Thursday</option>
                                        <option value="friday" {{ $hours->day == 'friday' ? 'selected' : '' }}>Friday</option>
                                        <option value="saturday" {{ $hours->day == 'saturday' ? 'selected' : '' }}>Saturday</option>
                                        <option value="sunday" {{ $hours->day == 'sunday' ? 'selected' : '' }}>Sunday</option>
                                    </select>
                                    <input type="time" name="working_hours[{{ $loop->index }}][start_time]"  value="{{ $hours->start_time }}">
                                    <input type="time" name="working_hours[{{ $loop->index }}][end_time]"  value="{{ $hours->end_time }}">
                                    <button type="button" class="btn btn-danger btn-sm remove-working-hour">Remove</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" id="add-working-hour" class="btn btn-success btn-sm">Add Working Hour</button>
                </div>


                <button type="submit" class="btn btn-primary float-end">Update</button>
            </form>
        </div>
    </div>

    <script>
        const container = document.getElementById('working-hours-container');
        const addBtn = document.getElementById('add-working-hour');

        addBtn.addEventListener('click', () => {
            const newRow = document.createElement('div');
            newRow.classList.add('working-hour-row');
            newRow.innerHTML = `
            <select name="working_hours[][day]" class="mt-1">
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                </select>
            <input type="time" name="working_hours[][start_time]" >
            <input type="time" name="working_hours[][end_time]" >
            <button type="button" class="btn btn-danger btn-sm remove-working-hour">Remove</button>
        `;
            container.appendChild(newRow);

            // Add remove event listener to the new row's remove button
            newRow.querySelector('.remove-working-hour').addEventListener('click', () => {
                container.removeChild(newRow);
            });

        });

        container.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-working-hour')) {
                container.removeChild(event.target.parentNode);
            }
        });
    </script>

@endsection
