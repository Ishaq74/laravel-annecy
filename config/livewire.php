<?php

return [
    'component_layout' => 'layouts::app',
    'component_placeholder' => 'livewire.placeholder',
    'smart_wire_keys' => true,
    'component_locations' => [
        resource_path('views/components'),
        resource_path('views/livewire'),
    ],
    'component_namespaces' => [
        'layouts' => resource_path('views/components/layouts'),
        'pages' => resource_path('views/pages'),
    ],
    'make_command' => [
        'type' => 'sfc',
        'emoji' => true,
    ],
    'csp_safe' => false,
];
