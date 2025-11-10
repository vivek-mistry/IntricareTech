@php
    $classes = [
        'primary'   => 'badge bg-primary',
        'secondary' => 'badge bg-secondary text-light',
        'danger'    => 'badge bg-danger',
        'success'   => 'badge bg-success',
        'warning'   => 'badge bg-warning',
        'light'     => 'badge bg-light text-dark',
        'dark'      => 'badge bg-dark text-light',
        'purple'    => 'badge bg-purple',
        'pink'      => 'badge bg-pink',
        'info'      => 'badge bg-info',
    ];

    // Get the base classes based on the type
    $typeClasses = $classes[$type] ?? $classes['info'];

    // Concatenate with user-provided class
    $finalClasses = $typeClasses . ' ' . $class;
@endphp

<span class="{{ $finalClasses }}" {{ $attributes }}>
    {{ $label }}
</span>
