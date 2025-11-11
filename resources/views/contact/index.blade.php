<x-backend.layout>
    
    @section('content')
        <x-backend.breadcrumb title="Contact" :breadcrumbs="[['label' => 'Contact']]" />
        <div class="row ">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-between justify-content-between mb-2">
                            <div>
                                <x-backend.search id="contact_input_search" />
                            </div>
                            <div>
                                <x-backend.button ui="flat" colorType="primary" type="button" label="Add Contact"
                                    data-bs-toggle="modal" data-bs-target="#contactCreateModal" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="contact_datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>
                                        Custom Fields
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="contact_datatable_body">
                                
                            </tbody>
                        </table>
                        </div>

                        <div id="pagination">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <x-backend.modal id="contactCreateModal" title="Add Contact" form="contactStoreForm" action="{{ route('contact.store') }}" method="POST" scrollable="false" size="modal-lg">
            @include('contact.form')
        </x-backend.modal>

        <x-backend.modal id="contactEditModal" title="Edit Contact" form="contactEditForm" action="{{ route('contact.update', ['contact' => ':id']) }}" method="POST" scrollable="false" size="modal-lg">
            @include('contact.form')
        </x-backend.modal>


    @endsection

    @section('scripts')
        <script>
            var ROUTE_CONTACT_LIST = "{{ route('contact.ajax.list') }}";
            var ROUTE_CONTACT_DELETE = "{{ route('contact.destroy', ['contact' => ':id']) }}";
            var ROUTE_CONTACT_EDIT = "{{ route('contact.edit', ['contact' => ':id']) }}";
            var ROUTE_CONTACT_UPDATE = "{{ route('contact.update', ['contact' => ':id']) }}";
        </script>

        @vite(['resources/js/contact/index.js', 'resources/js/contact/add-edit.js'])
    @endsection

</x-backend.layout>