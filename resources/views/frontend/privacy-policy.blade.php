Copy

{{-- resources/views/frontend/policy.blade.php --}}

@section('meta_title', $policy->title . ' — Akshar Plus')

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($policy->description), 155) }}">
<meta name="keywords" content="privacy policy, data protection, Akshar Plus, user data, GDPR">
<meta name="author" content="Akshar Plus">
<meta name="robots" content="index, follow">

{{-- Open Graph --}}
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $policy->title }} — Akshar Plus">
<meta property="og:description" content="{{ Str::limit(strip_tags($policy->description), 155) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('image/logo.png') }}">
<meta property="og:site_name" content="Akshar Plus">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $policy->title }} — Akshar Plus">
<meta name="twitter:description" content="{{ Str::limit(strip_tags($policy->description), 155) }}">
<meta name="twitter:site" content="@aksharplus">

{{-- Canonical --}}
<link rel="canonical" href="{{ url()->current() }}">
@endsection
@include('frontend.layouts.navbar')

<style>
    section#hero {
        max-width: 1200px;
        margin: auto;
        line-height: 33px;
        margin-top: 100px;
    }
</style>
<!-- ══════════════════ HERO BANNER (SLIDER) ══════════════════ -->
<section class="hero" id="hero">
    <div class="container py-5">

        <h1>{{$policy->title}}</h1>

        {!!$policy->description!!}

    </div>
</section>
@include('frontend.layouts.footer')