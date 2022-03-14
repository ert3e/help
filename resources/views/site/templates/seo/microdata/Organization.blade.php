<?php
    $microdataArray = [
        '@context' => 'http://schema.org',
        '@type' => 'Organization',
        'url' => \URL::to('/'),
        'name' => setting('main.title'),
        'email' => setting('contacts.email'),
        'telephone' => setting('contacts.telephone'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => setting('contacts.address'),
        ]
    ];
?>

@include('templates.seo.microdata.layout')
