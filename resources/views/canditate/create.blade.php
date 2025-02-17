<form action="{{ route('candidates.store') }}" method="POST">
    @csrf

    {{-- ... other form fields ... --}}

    <div class="form-group">
        <label for="agent_id">Agent</label>
        <select name="agent_id" id="agent_id" class="form-control">
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->full_name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
