<?php

$microdataArray = [
    '@context' => 'http://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [],
];

if (count($items) > 0) {
    foreach($items as $item) {
        $microdataArray['mainEntity'][] = [
            '@type' => 'Question',
            'name' => $item->question,
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => strip_tags($item->answer),
            ],
        ];
    }
}
?>

@include('templates.seo.microdata.layout')
