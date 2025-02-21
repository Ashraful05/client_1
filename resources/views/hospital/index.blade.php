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
                <div class="d-flex mb-3">
                    <h5 class="mb-0">Hospital Details</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                    <a href="{{ route('hospital.create') }}" class="btn btn-primary btn-sm float-end">Create New Hospital</a>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    @if($hospitals)
                        <thead class="table-light">
                        <tr>
                            <th>Sl.</th>
                            <th>Hospital Name</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Website</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($hospitals  as $key => $hospital)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $hospital->name }}</td>
                                <td>{{ $hospital->address }}</td>
                                <td>{{ $hospital->phone }}</td>
                                <td>{{ $hospital->website }}</td>
                                <td>{{ $hospital->email }}</td>
                                <td>
                                    <a href="{{ route('hospital.show', $hospital) }}" class="btn btn-info">Show</a>
                                    <a href="{{ route('hospital.edit', $hospital) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('hospital.destroy', $hospital) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this agent?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <div class="alert alert-primary" role="alert">
                                Sorry, There was not found any Hospital available right now!
                            </div>
                        @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
