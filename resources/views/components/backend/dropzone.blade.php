@props([
    'id' => 'my-dropzone',
    'name' => 'file',
    'maxFiles' => 1,
    'accepted' => '.jpg,.jpeg,.png',
    'label' => 'Drop files here or click to upload',
])

<div
    id="{{ $id }}"
    class="dropzone border-2 border-dashed rounded-md p-4 text-center custom-dropzone"
    data-name="{{ $name }}"
    data-max-files="{{ $maxFiles }}"
    data-accepted-files="{{ $accepted }}"
    data-label="{{ $label }}"
>
    <div class="dz-message text-gray-500">
        {{ $label }}
    </div>
</div>
