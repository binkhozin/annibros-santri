<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sample Page
    |--------------------------------------------------------------------------
    */
    // 'page' => [
    //     'title' => 'Page Title',
    //     'heading' => 'Page Heading',
    //     'subheading' => 'Page Subheading',
    //     'navigationLabel' => 'Page Navigation Label',
    //     'section' => [],
    //     'fields' => []
    // ],

    /*
    |--------------------------------------------------------------------------
    | General Settings
    |--------------------------------------------------------------------------
    */
    'general_settings' => [
        'title' => 'General Settings',
        'heading' => 'General Settings',
        'subheading' => 'Manage general site settings here.',
        'navigationLabel' => 'General',
        'sections' => [
            "site" => [
                "title" => "Site",
                "description" => "Manage basic settings."
            ],
            "theme" => [
                "title" => "Theme",
                "description" => "Change default theme."
            ],
        ],
        "fields" => [
            "brand_name" => "Brand Name",
            "site_active" => "Site Status",
            "brand_logoHeight" => "Brand Logo Height",
            "brand_logo" => "Brand Logo",
            "site_favicon" => "Site Favicon",
            "primary" => "Primary",
            "secondary" => "Secondary",
            "gray" => "Gray",
            "success" => "Success",
            "danger" => "Danger",
            "info" => "Info",
            "warning" => "Warning",
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Mail Settings
    |--------------------------------------------------------------------------
    */
    'mail_settings' => [
        'title' => 'Mail Settings',
        'heading' => 'Mail Settings',
        'subheading' => 'Manage mail configuration.',
        'navigationLabel' => 'Mail',
        'sections' => [
            "config" => [
                "title" => "Configuration",
                "description" => "description"
            ],
            "sender" => [
                "title" => "From (Sender)",
                "description" => "description"
            ],
            "mail_to" => [
                "title" => "Mail to",
                "description" => "description"
            ],
        ],
        "fields" => [
            "placeholder" => [
                "receiver_email" => "Receiver email.."
            ],
            "driver" => "Driver",
            "host" => "Host",
            "port" => "Port",
            "encryption" => "Encryption",
            "timeout" => "Timeout",
            "username" => "Username",
            "password" => "Password",
            "email" => "Email",
            "name" => "Name",
            "mail_to" => "Mail to",
        ],
        "actions" => [
            "send_test_mail" => "Send Test Mail"
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | FCM Broadcast
    |--------------------------------------------------------------------------
    */
    'fcm_broadcast' => [
        'title' => 'Broadcast Notification',
        'heading' => 'Broadcast Push Notification',
        'subheading' => 'Send a push notification to jamaah via Firebase Cloud Messaging.',
        'navigationLabel' => 'Broadcast Notification',
        'fields' => [
            'title' => 'Notification Title',
            'body' => 'Message Body',
            'target' => 'Target Recipient',
        ],
        'targets' => [
            'semua_santri' => 'All Santri',
            'wali_santri' => 'Wali Santri',
        ],
        'actions' => [
            'send' => 'Send Notification',
            'sending' => 'Sending...',
        ],
        'notifications' => [
            'success_title' => 'Notification Sent!',
            'success_body' => 'The push notification has been sent successfully.',
            'error_title' => 'Failed to Send Notification',
        ],
    ],

];
