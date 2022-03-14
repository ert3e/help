    <meta property="og:title" content="@yield('title', setting('main.meta_title'))">
    <meta property="og:image" content="@yield('image', '/images/site/logo.svg')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:description" content="@yield('meta_description', setting('main.meta_description'))">
