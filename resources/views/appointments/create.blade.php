<form action="{{ route('appointments.store') }}" method="POST">
    @csrf

    {{-- ... other form fields ... --}}

    <div class="form-group">
        <label for="candidate_id">Candidate</label>
        <select name="candidate_id" id="candidate_id" class="form-control" required>
            @foreach ($candidates as $candidate)
                <option value="{{ $candidate->id }}">{{ $candidate->first_name }} {{ $candidate->last_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="agent_id">Agent</label>
        <select name="agent_id" id="agent_id" class="form-control" required>
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->full_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="payment_id">Payment</label>
        <select name="payment_id" id="payment_id" class="form-control" required>
            @foreach ($payments as $payment)
                <option value="{{ $payment->id }}">{{ $payment->transaction_id }} (Amount: {{ $payment->amount }})</option>
            @endforeach
        </select>
    </div>

    {{-- ... rest of your form ... --}}

    <button type="submit" class="btn btn-primary">Create</button>
</form>
