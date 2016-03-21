<?php

return [
    'requirements' => [
        'slug'        => 'requirements',
        'title'       => 'Requirements',
        'breadcrumb'  => '<i class="fa fa-server"></i>',
        'description' => 'Check the server configuration',
        'view'        => [
            'php_version'   => 'PHP version is at least :ver',
            'php_extension' => 'PHP extension enabled: :name',
        ],
    ],

    'folders' => [
        'slug'        => 'folders',
        'title'       => 'Folder permissions',
        'breadcrumb'  => '<i class="fa fa-folder"></i>',
        'description' => 'Check application folder permissions',
        'view'        => [
            'granted' => 'Folder <code class="text-success">:path</code> has permission <code class="text-success">:perm</code>',
            'missing' => 'Folder <code class="text-danger">:path</code> has permission <code class="text-danger">:perm_actual</code> instead of <code class="text-danger">:perm</code>',
        ],
    ],

    'env' => [
        'slug'        => 'env',
        'title'       => 'Env File',
        'breadcrumb'  => '<i class="fa fa-file-o"></i>',
        'description' => 'Main server configuration',
        'errors'      => [
            'cannot_write_file'  => 'Failed to write the .env file. Please check that you have the permission',
            'cannot_backup_file' => 'Failed to backup the current .env file, reverting to the sample file',
        ],
        'view'        => [
            'help_text' => 'Creates the <code>.env</code> file required to configure database, mailer, etc. If you have a <code>.env.example</code> file, it will be used as a template',
        ],
    ],

    'database' => [
        'slug'        => 'database',
        'title'       => 'Database',
        'breadcrumb'  => '<i class="fa fa-database"></i>',
        'description' => 'Setup tables and initial data',
        'view'        => [
            'refresh_db'     => 'Replace the database schema with <code>artisan migrate:refresh</code> <em>(else, simply update it with <code>artisan migrate</code>)</em>',
            'enable_seeding' => 'Seed the database using the <code>artisan db:seed</code> command',
        ],
    ],

    'final' => [
        'slug'        => 'congratulations',
        'title'       => 'Congratulations',
        'breadcrumb'  => '<i class="fa fa-child"></i>',
        'description' => 'Setup is over',
        'view'        => [
            'ready_to_go' => 'The application has been configured properly. You should now be able to use it. Enjoy!',
        ],
    ],
];