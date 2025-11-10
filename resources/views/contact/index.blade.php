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
                        <table id="contact_datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="contact_datatable_body">
                                
                            </tbody>
                        </table>

                        <div id="pagination">

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <x-backend.modal id="contactCreateModal" title="Add Contact" form="contactStoreForm" action="{{ route('contact.store') }}" method="POST" scrollable="false" size="modal-lg">
            @include('contact.form')
        </x-backend.modal>


    @endsection

    @section('scripts')
        <script>
            var ROUTE_CONTACT_LIST = "{{ route('contact.ajax.list') }}";
        </script>

        @vite(['resources/js/contact/index.js', 'resources/js/contact/add-edit.js'])
    @endsection

</x-backend.layout>