<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $contact->name ?? old('name') }}"
                placeholder="Enter brand name">
        </div>

    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" value="{{ $contact->email ?? old('email') }}"
                placeholder="Enter brand email">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="phone" value="{{ $contact->phone ?? old('phone') }}"
                placeholder="Enter brand phone">
        </div>

    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="profile_image" class="form-label">Profile Image</label>
            <input type="file" class="form-control" name="profile_image">
        </div>


    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="document_file" class="form-label">Document File</label>
            <input type="file" class="form-control" name="document_file">
        </div>
    </div>

</div>


<div class="mb-3">
    <label for="contact_custom_fields" class="form-label">Contact Custom Fields</label>
    <input type="text" class="form-control" name="contact_custom_fields">
</div>


@section('modalFooter')
    <x-backend.button ui="flat" colorType="secondary" type="button" label="Close" data-bs-dismiss="modal" />
    <x-backend.button ui="flat" colorType="primary" type="submit" label="Save changes" />
@endsection
