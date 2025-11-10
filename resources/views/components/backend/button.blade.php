@php
    $classes = [
        'outline'   => [
            'primary'   => 'btn btn-outline-primary',
            'secondary' => 'btn btn-outline-secondary',
            'danger'    => 'btn btn-outline-danger',
            'success'   => 'btn btn-outline-success',
            'warning'   => 'btn btn-outline-warning',
            'light'     => 'btn btn-outline-light',
            'dark'      => 'btn btn-outline-dark',
            'purple'    => 'btn btn-outline-purple',
            'pink'      => 'btn btn-outline-pink',
            'info'      => 'btn btn-outline-info',
        ],
        'flat' => [ 
            'primary'   => 'btn btn-primary',
            'secondary' => 'btn btn-secondary',
            'danger'    => 'btn btn-danger',
            'success'   => 'btn btn-success',
            'warning'   => 'btn btn-warning',
            'light'     => 'btn btn-light',
            'dark'      => 'btn btn-dark',
            'purple'    => 'btn btn-purple',
            'pink'      => 'btn btn-pink',
            'info'      => 'btn btn-info',
        ]
    ];

    // Get the base classes based on the type
    $typeClasses = $classes[$ui][$colorType] ?? $classes['outline']['primary'];

    // Concatenate with user-provided class
    $finalClasses = $typeClasses . ' ' . $class;

    if($uiType === 'rounded'){
        $finalClasses .= ' rounded-pill';
    }
@endphp

<button class="{{ $finalClasses }}" {{ $attributes }}>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $label }}
</button>
