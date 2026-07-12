<?php

return [
    'active_year' => env('PARTI_ACTIVE_YEAR', 2026),
    'max_upload_size_mb' => env('MAX_UPLOAD_SIZE_MB', 10),
    'allowed_file_types' => ['pdf', 'docx'],
    'allowed_mimes' => [
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ],
    'gform_domains' => ['docs.google.com/forms', 'forms.gle'],
];
