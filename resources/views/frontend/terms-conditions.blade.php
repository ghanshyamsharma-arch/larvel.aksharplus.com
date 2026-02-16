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

        <h1>{{$terms->title}}</h1>

        {!!$terms->description!!}

    </div>
</section>
@include('frontend.layouts.footer')