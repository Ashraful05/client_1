<h1>Agents</h1>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('candidate.create') }}" class="btn btn-primary">Create New Agent</a>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($agents as $agent)
        <tr>
            <td>{{ $agent->id }}</td>
            <td>{{ $agent->full_name }}</td>
            <td>{{ $agent->email }}</td>
            <td>
                <a href="{{ route('agents.show', $agent) }}" class="btn btn-info">Show</a>
                <a href="{{ route('agents.edit', $agent) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('agents.destroy', $agent) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this agent?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
