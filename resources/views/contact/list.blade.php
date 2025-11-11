@forelse ($contacts as $contact)
    <tr>
        <td>
            <x-backend.avatar-image imageurl="{{ $contact->image_url }}" errorimage="{{ $contact->error_image }}" />
            <!-- {{ $contact->image_url  }} -->
        </td>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->phone }}</td>
        <td>{{ $contact->gender }}</td>
        <td>
            @if ($contact->status === 'active')
                <x-backend.badge type="primary" label="Active" class="active_inactie_blog" data-contact_id="{{ $contact->id }}" />
            @else
                <x-backend.badge type="danger" label="Merged" class="active_inactie_blog" data-contact_id="{{ $contact->id }}" />
            @endif
        </td>
        <td>
            <x-backend.button ui="flat" colorType="primary" type="button" label="Edit" data-contact_id="{{ $contact->id }}" data-bs-toggle="modal" data-bs-target="#contactEditModal" />
            <x-backend.button ui="flat" colorType="danger" type="button" label="Delete" data-contact_id="{{ $contact->id }}" class="remove_contact" />
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No contacts found</td>
    </tr>
@endforelse