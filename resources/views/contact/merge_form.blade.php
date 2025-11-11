<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="master_contact" class="form-label">Master Contact <span class="text-danger">*</span></label>
            <select class="form-control" name="master_contact" id="master_contact">
                <option value="">Choose Master Contact</option>
            </select>
        </div>

    </div>
</div>

@section('modalFooter')
    <x-backend.button ui="flat" colorType="secondary" type="button" label="Close" data-bs-dismiss="modal" />
    <x-backend.button ui="flat" colorType="primary" type="submit" label="Save changes" />
@endsection