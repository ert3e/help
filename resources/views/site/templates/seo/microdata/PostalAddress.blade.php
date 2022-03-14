<?php
$microdataArray = [
    '@context' => 'http://schema.org',
    '@type' => 'PostalAddress',
    'addressCountry' => 'RU',
    'addressRegion' => 'Dagestan',
    'addressLocality' => 'Makhachkala',
    'name' => setting('main.title'),
    'streetAddress' => setting('contacts.address'),
];
?>

@include('templates.seo.microdata.layout')
