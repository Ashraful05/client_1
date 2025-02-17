<form action="{{ route('hospitals.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea name="address" id="address" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="website">Website</label>
        <input type="url" name="website" id="website" class="form-control">
    </div>

    <div class="form-group">
        <label for="working_hours">Working Hours</label>
        <textarea name="working_hours" id="working_hours" class="form-control"></textarea>
    </div>


    <button type="submit" class="btn btn-primary">Create</button>
</form>
