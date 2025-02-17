<form action="{{ route('payments.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="agent_id">Agent</label>
        <select name="agent_id" id="agent_id" class="form-control" required>
            @foreach ($agents as $agent)
                <option value="{{ $agent->id }}">{{ $agent->full_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="candidate_id">Candidate</label>
        <select name="candidate_id" id="candidate_id" class="form-control" required>
            @foreach ($candidates as $candidate)
                <option value="{{ $candidate->id }}">{{ $candidate->first_name }} {{ $candidate->last_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="transaction_id">Transaction ID</label>
        <input type="text" name="transaction_id" id="transaction_id" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="payment_status">Payment Status</label>
        <select name="payment_status" id="payment_status" class="form-control" required>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
            <option value="failed">Failed</option>
            <option value="refunded">Refunded</option>
        </select>
    </div>

    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="0" required>
    </div>

    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" id="date" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
