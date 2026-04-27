<?php

return [
    'app' => [
        'path' => 'app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    // Bundle içindeki dosyayı standart alias üzerinden çağırıyoruz:
    '@symfony/stimulus-bundle' => [
        'path' => '@symfony/stimulus-bundle/loader.js',
    ],
];