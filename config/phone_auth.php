<?php

return [
    "auth" => [
        "class_user" => App\Modules\Admin\Users\Models\User::class,
        "guard" => "web",
        "createUser" => true,
        "loginAfter" => true,
        "redirectTo" => false,
    ],
    "code_sent" => "ERTY3",
    "emitSendCode" => false,
    "emitBefore" => false,
    "emitAfter" => false,

    "code_length" => 4,
    "code_digits_only" => false,
    "verify_code_dynamic" => true,
    "limit_send_count" => 3,
    "next_send_after" => 30,
    "expire_seconds" => 240,
    "flushCode" => true,

    "custom_phone_field_name" => "telephone", //If you need to use without a form



    "sms_service" => [
        "class" =>App\Utilities\PhoneAuth\SentSmsRu::class,
        "settings" => [],
    ]
];
