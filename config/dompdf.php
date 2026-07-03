<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */
    'show_warnings' => false,
    'public_path' => null,
    'convert_entities' => true,

    'options' => [
        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),

        'allowed_protocols' => [
            'data://' => ['rules' => []],
            'file://' => ['rules' => []],
            'http://' => ['rules' => []],
            'https://' => ['rules' => []],
        ],

        'artifactPathValidation' => null,
        'log_output_file' => null,
        'enable_font_subsetting' => false,

        // --- PENGATURAN BACKEND UTAMA ---
        // Kita isi kedua jenis penulisan key agar versi laravel-dompdf mana pun pasti terkunci ke CPDF
        // 'pdf_backend' => 'GD',
        'pdf_backend' => 'GD',
        'pdfBackend' => 'GD',

        'default_media_type' => 'screen',
        'default_paper_size' => 'a4',
        'default_paper_orientation' => 'portrait',
        'default_font' => 'serif',
        'dpi' => 96,

        'enable_php' => false,
        'enable_javascript' => true,

        // --- AKSES REMOTE DAN PARSER ---
        'enable_remote' => true,
        'isRemoteEnabled' => true, // Tambahan pengunci akses remote gambar
        'enable_html5_parser' => true,
        'isHtml5ParserEnabled' => true,

        'allowed_remote_hosts' => null,
        'font_height_ratio' => 1.1,
    ],
    'defines' => [
        "DOMPDF_ENABLE_REMOTE" => true,
    ],

];
