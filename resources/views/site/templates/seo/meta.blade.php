<?php

if (is_object($object)) {

    $object['meta_title'] = $object->seoAttribute('meta_title');
    $object['meta_description'] = $object->seoAttribute('meta_description');
    $object['meta_keywords'] = $object->seoAttribute('meta_keywords');

}

?>


@section('title',               isset($object['meta_title']) ? $object['meta_title'] : '')
@section('meta_description',    isset($object['meta_description']) ? $object['meta_description'] : '')
@section('meta_keywords',       isset($object['meta_keywords']) ? $object['meta_keywords'] : '')
