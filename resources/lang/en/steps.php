<?php

return [
    'env' => [
        'slug'        => 'env',
        'title'       => 'Env File',
        'breadcrumb'  => '<i class="fa fa-file-o"></i>',
        'description' => 'Creates the <code>.env</code> file required to configure database, mailer, etc. If you have a <code>.env.example</code> file, it will be used as a template',
        'errors'      => [
            'cannot_write_file'  => 'Failed to write the .env file. Please check that you have the permission',
            'cannot_backup_file' => 'Failed to backup the current .env file, reverting to the sample file',
        ],
    ],

    'database' => [
        'slug'        => 'database',
        'title'       => 'Database',
        'breadcrumb'  => '<i class="fa fa-database"></i>',
        'description' => 'Initialize the database tables and optionally seeds them with data',
        'view'        => [
            'enable_seeding' => 'Seed the database using the <code>artisan db:seed</code> command',
        ],
    ],
];