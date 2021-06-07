<?php

/**
 * Email Setup
 * BihongoPHP uses PHPMailer Library to sending email.
 */
/**
 * Host Address
 */
$email['host'] = env('MAIL_HOST', 'smtp.gmail.com');
/**
 * Port
 */
$email['port'] = env('MAIL_PORT', 587);

/**
 * Encryption
 */
$email['encryption'] = env('MAIL_ENCRYPTION', 'tls');
/**
 * Global Form Address
 */
$email['from'] = [
    'address' => env('MAIL_FROM_ADDRESS', 'hello@exmaple.com'),
    'name' =>  env('MAIL_FROM_NAME', 'Example'),
];
/**
 * SMTP Server Username
 */
$email['username'] = env('MAIL_USERNAME');
$email['password'] =  env('MAIL_PASSWORD');
