<?php

$CONFIG = array(
    'force_language' => getenv('FORCE_LANGUAGE'),
    'default_phone_region' => 'FR',
    'trusted_domains' => array(
        0 => 'nginx',
        1 => getenv('DOMAIN'),
        2 => getenv('STACK_NAME') . "_nginx",
    ),
    'trusted_proxies' => array(
        0 => '172.xx.0.x',
    ),
    'overwrite.cli.url' => 'https://' . getenv('DOMAIN'),
    'overwriteprotocol' => 'https',
    'onlyoffice' => array (
        'DocumentServerUrl' => '/ds-vpath/',
        'DocumentServerInternalUrl' => 'http://onlyoffice/',
        'StorageUrl' => 'http://' . getenv('STACK_NAME') . '_nginx/',
        'verify_peer_off' => 'true',
    ),
);

if (getenv("ENABLE_S3")) {
    $CONFIG = array_merge($CONFIG, array(
        'objectstore' => array(
            "class" => "OC\\Files\\ObjectStore\\S3",
            "arguments" => array(
                "bucket" => getenv("S3_BUCKET"),
                "key" => getenv("S3_KEY"),
                "secret" => getenv("S3_SECRET"),
                "region" => getenv("S3_REGION"),
                "hostname" => getenv("S3_HOSTNAME"),
                "port" => getenv("S3_PORT"),
                "use_ssl" => getenv("S3_USE_SSL") === "true" ? true : false,
                'autocreate' => getenv("S3_AUTOCREATE") === "true" ? true : false,
                'use_path_style' => getenv("S3_USE_PATH_STYLE") === "true" ? true : false,
                'objectPrefix' => getenv("S3_OBJECT_PREFIX") ? getenv("S3_OBJECT_PREFIX") : "urn:oid:",
            ),
        ),
    ));
}
