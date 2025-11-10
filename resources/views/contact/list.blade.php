@forelse ($contacts as $contact)
    <tr>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->phone }}</td>
        <td>{{ $contact->gender }}</td>
        <td>
            <x-backend.button ui="flat" colorType="primary" type="button" label="Edit" />
            <x-backend.button ui="flat" colorType="danger" type="button" label="Delete" data-contact_id="{{ $contact->id }}" class="remove_contact" />
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">No contacts found</td>
    </tr>
@endforelse
