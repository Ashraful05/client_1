@extends('admin.master')
@section('main_content')


    <div class="card radius-10">
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
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="d-flex mb-1">
                    <h5 class="mb-0">Create New Hospital</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    <a href="{{ route('hospital.index') }}" class="btn btn-primary btn-sm float-end">Back</a>
                </div>
            </div>
            <hr>
            <div class="">
                <form action="{{ route('hospital.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-1">
                        <label class="form-label" for="name"><b>Hospital Name: </b></label>
                        <input placeholder="Enter Hospital Name" type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label" for="address"><b>Address: </b></label>
                        <textarea placeholder="Enter Hospital Address" name="address" id="address" class="form-control" required></textarea>
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label" for="phone"><b>Phone: </b></label>
                        <input placeholder="Contact Number" type="text" name="phone" id="phone" class="form-control">
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label" for="email"><b>Email: </b></label>
                        <input placeholder="Enter Hospital Email" type="email" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group mb-1">
                        <label class="form-label" for="website"><b>Website: </b></label>
                        <input placeholder="Enter Hospital Website" type="url" name="website" id="website" class="form-control">
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" for="working_hours"><b>Working Hours (Create Working Day Only): </b></label>
                        <!--  -->
                        <div id="working-hours-container" >
                            @if (old('working_hours'))
                                @foreach (old('working_hours') as $key => $hours)
                                    <div class="working-hour-entry mb-2 border rounded p-2">
                                        <select  name="working_hours[{{ $key }}][day]" class="mr-2">
                                            <option  value="saturday" @if($hours['day'] == 'saturday') selected @endif>Saturday</option>
                                            <option  value="sunday" @if($hours['day'] == 'sunday') selected @endif>Sunday</option>
                                            <option  value="monday" @if($hours['day'] == 'monday') selected @endif>Monday</option>
                                            <option  value="tuesday" @if($hours['day'] == 'tuesday') selected @endif>Tuesday</option>
                                            <option  value="wednesday" @if($hours['day'] == 'wednesday') selected @endif>Wednesday</option>
                                            <option  value="thursday" @if($hours['day'] == 'thursday') selected @endif>Thursday</option>
                                            <option  value="friday" @if($hours['day'] == 'friday') selected @endif>Friday</option>
                                        </select>
                                        <input  type="time" name="working_hours[{{ $key }}][start_time]" value="{{ $hours['start_time'] }}" required class="mr-2">
                                        <input  type="time" name="working_hours[{{ $key }}][end_time]" value="{{ $hours['end_time'] }}" required>
                                        <button type="button" class="remove-working-hour btn btn-danger btn-sm text-white p-1 rounded">Remove</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="working-hour-entry mb-2 border rounded p-2">
                                    <select  name="working_hours[0][day]" class="mr-2">
                                        <option  value="saturday">Saturday</option>
                                        <option  value="sunday">Sunday</option>
                                        <option  value="monday">Monday</option>
                                        <option  value="tuesday">Tuesday</option>
                                        <option  value="wednesday">Wednesday</option>
                                        <option  value="thursday">Thursday</option>
                                        <option  value="friday">Friday</option>
                                    </select>
                                    <input  type="time" name="working_hours[0][start_time]" required class="mr-2">
                                    <input  type="time" name="working_hours[0][end_time]" required>
                                    <button type="button" class="remove-working-hour btn btn-danger btn-sm text-white p-1 rounded">Remove</button>
                                </div>
                            @endif
                        </div>
                        <button type="button" id="add-working-hour" class="btn btn-success btn-sm text-white p-2 rounded mt-2">Add Working Hour</button>


                        <!--  -->
                    </div>


                    <button type="submit" class="btn btn-primary float-end">Create</button>
                </form>
            </div>
        </div>
    </div>



    <script>
        const addWorkingHourButton = document.getElementById('add-working-hour');
        const workingHoursContainer = document.getElementById('working-hours-container');
        let counter = workingHoursContainer.querySelectorAll('.working-hour-entry').length; // Start from the current number of entries

        addWorkingHourButton.addEventListener('click', () => {
            const newEntry = document.createElement('div');
            newEntry.classList.add('working-hour-entry', 'mb-2', 'border', 'rounded', 'p-2');
            newEntry.innerHTML = `
            <select name="working_hours[${counter}][day]" class="mr-2">
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
            </select>
            <input type="time" name="working_hours[${counter}][start_time]" required class="mr-2">
            <input type="time" name="working_hours[${counter}][end_time]" required>
            <button type="button" class="remove-working-hour btn btn-danger btn-sm text-white p-1 rounded">Remove</button>
        `;
            workingHoursContainer.appendChild(newEntry);
            counter++;

            // Add remove functionality to the new button
            newEntry.querySelector('.remove-working-hour').addEventListener('click', () => {
                workingHoursContainer.removeChild(newEntry);
            });
        });

        workingHoursContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-working-hour')) {
                workingHoursContainer.removeChild(event.target.parentNode);
            }
        });
    </script>

@endsection





