<?php
$offersCount = 0;
if (isset($serviceOffers)) {
    $offersCount = count($serviceOffers);
}

$microdataArray = [
    '@context' => 'http://schema.org',
    '@type' => 'Service',
    'name' => $service->title,
    'description' => strip_tags(html_entity_decode(preg_replace('/\s+/', ' ', $service->description))),
    'url' => \Request::url(),
    'provider' => [
        '@type' => 'Organization',
        'name' => setting('main.title'),
    ]
];

if ($offersCount > 0) {
    $microdataArray['hasOfferCatalog'] = [
        '@type' => 'OfferCatalog',
        'name' => $service->title,
        'itemListElement' => [],
    ];

    foreach($serviceOffers as $offer) {
        $microdataArray['hasOfferCatalog']['itemListElement'][] = [
            '@type' => 'Offer',
            'itemOffered' => [
                '@type' => 'Service',
                'name' => $offer->title,
            ],
        ];
    }
}
?>

@include('templates.seo.microdata.layout')
