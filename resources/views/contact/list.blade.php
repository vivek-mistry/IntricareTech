@forelse ($contacts as $contact)
<tr>
    <td>
        <!-- <x-backend.avatar-image imageurl="{{ $contact->image_url }}" errorimage="{{ $contact->error_image }}" class="w-100" /> -->
        <!-- {{ $contact->image_url  }} -->
    </td>
    <td class="w-100">
        <div class="d-flex gap-2 align-items-center ">
            <x-backend.avatar-image imageurl="{{ $contact->image_url }}" errorimage="{{ $contact->error_image }}" class="w-100" />
            {{ $contact->name }}
        </div>
    </td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->phone }}</td>
    <td>{{ $contact->gender }}</td>
    <td class="w-100">
        @if ($contact->status === 'active')
        <x-backend.badge type="primary" label="Active" class="active_inactie_blog" data-contact_id="{{ $contact->id }}" />
        @else
        <x-backend.badge type="danger" label="Merged" class="active_inactie_blog" data-contact_id="{{ $contact->id }}" />
        @endif
    </td>
    <td>
        @if ($contact->contact_custom_fields)
        @foreach ($contact->contact_custom_fields as $key => $value)
            @if(is_array($value))
            <span class="badge bg-primary">{{ $key }}: {{ implode(',', $value) }}</span><br />
            @else
            <span class="badge bg-primary">{{ $key }}: {{ $value }}</span><br />
            @endif
        @endforeach
        @endif
    </td>
    <td>
        <div class="d-flex gap-2">
            <x-backend.button ui="flat" colorType="primary" type="button" label="Edit" data-contact_id="{{ $contact->id }}" data-bs-toggle="modal" data-bs-target="#contactEditModal" />
            <x-backend.button ui="flat" colorType="danger" type="button" label="Delete" data-contact_id="{{ $contact->id }}" class="remove_contact" />
            @if ($contact->status === 'active')
            <x-backend.button ui="flat" colorType="pink" type="button" label="Merge" data-contact_id="{{ $contact->id }}" class="merge_contact" data-bs-toggle="modal" data-bs-target="#contactMergeModal" />
            @else
            <x-backend.button ui="flat" colorType="light" type="button" label="Merged" data-contact_id="{{ $contact->id }}" />
            @endif
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center">No contacts found</td>
</tr>
@endforelse