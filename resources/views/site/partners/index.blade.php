@extends('layouts.app')

@include('templates.seo.meta', ['object' => setting('partners')])

@section('content')

    <div class="partners">
        <div class="container">

            <h1 class="page-title">{{ setting('partners.meta_h1') }}</h1>

            <div class="default-description partners__description">
                <p>
                    {!! nl2br(setting('partners.page_description')) !!}
                </p>
            </div>


            <div class="partners__list">
                @foreach($partners as $partner)
                    @include('_partner')
                @endforeach
            </div>
        </div>
    </div>

@endsection
