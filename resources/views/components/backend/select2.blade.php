@props([
    'name' => 'select2',
    'id' => null,
    'placeholder' => 'Select an option',
    'url' => '', // AJAX URL for data loading
    'minimumInputLength' => 2, // Minimum characters to trigger search
    'allowClear' => true,
    'selected' => null, // Pre-selected values
    'multiple' => false,
])

<select 
    name="{{ $name }}" 
    id="{{ $id ?? $name }}" 
    class="form-select select2-ajax"
    data-ajax-url="{{ $url }}"
    data-ajax--cache="true"
    data-placeholder="{{ $placeholder }}"
    data-minimum-input-length="{{ $minimumInputLength }}"
    @if($allowClear) data-allow-clear="true" @endif
    @if($multiple) multiple="multiple" @endif
>
    @if($selected)
        <!-- Options will be added via JavaScript -->
    @endif
</select>