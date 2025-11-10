<div class="mb-3">
    <label for="name" class="form-label">Category <span class="text-danger">*</span></label>
    <select name="category_id" class="form-control">
        <option value="">Select Category</option>
        @foreach ($categories as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
</div>