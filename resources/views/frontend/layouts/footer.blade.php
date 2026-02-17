<!-- ══════════════════ FOOTER ══════════════════ -->
<footer id="footer">
    <div class="footer-grid">
        <div>
            <a class="nav-logo" href="#" style="margin-bottom:16px;display:inline-flex;">
                <div class="logo-icon">
                    <img alt="Akshar Plus" title="Akshar Plus" src="{{ asset('image/logo.png') }}">
                </div>

            </a>
            <p class="footer-desc">We challenge the standards of configuration, push the limits of advancement, and we've not looked back rather are consistently discovering, developing & learning from that point forward.</p>
            <div class="social-row">
                @php
                $socialLinks = \App\Models\SocialLink::active()->get();
                @endphp

                @if($socialLinks->count())
                <div class="footer-socials">
                    @foreach($socialLinks as $social)
                    <a href="{{ $social->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        title="{{ $social->label }}"
                        class="fsoc-btn">
                        {!! $social->icon_svg !!}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="footer-col">
            <h4>Product</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('home') }}#calling">Audio Calling</a></li>
                <li><a href="{{ route('home') }}#calling">Video Calling</a></li>
                <li><a href="{{ route('home') }}#multicompany">Multi-Company</a></li>
                <li><a href="{{ route('home') }}#file">Media Library</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Company</h4>
            <ul>
                <li><a href="https://www.shakuniya.in/aboutus_files/about-us.php">About Us</a></li>
                <li><a href="https://www.shakuniya.in/aboutus_files/caareer.php">Careers</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="https://www.shakuniya.in/aboutus_files/contact-us.php">Contact</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Stay in the loop</h4>
            <p style="color:var(--muted);font-size:.88rem;line-height:1.6;margin-bottom:0;">Get product updates and tips delivered to your inbox.</p>
            <div id="subscribe-message">

                @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

                @endif


                @if($errors->any())

                <div class="alert alert-danger">

                    {{ $errors->first('email') }}

                </div>

                @endif

            </div>
            <div class="nl-form">

                <form action="{{ route('subscribe') }}" method="POST">

                    @csrf

                    <div class="d-flex gap-2">

                        <input type="email"
                            name="email"
                            class="form-control"
                            placeholder="your@email.com"
                            required>


                        <button class="btn btn-primary">

                            Subscribe

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2025 Akshar Plus. All rights reserved.</p>
        <div class="footer-links">
            <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
            <a href="{{ route('terms.conditions') }}">Terms of Service</a>
            <!-- <a href="#">Cookie Policy</a> -->
        </div>
    </div>
</footer>

<!-- ══════════════════ JS ══════════════════ -->
<script src="{{ asset('js/script.js') }}"></script>

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        let msg =
            document.getElementById('subscribe-message');

        if (msg && msg.innerText.trim() !== '') {

            msg.scrollIntoView({

                behavior: 'smooth'

            });

        }

    });
</script>

<style>
    /* ── Footer Social Links ─────────────────────────────
   Same style as admin platform-icon buttons
   Apni existing CSS file mein paste karo
────────────────────────────────────────────────── */

    .footer-socials {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .fsoc-btn {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, .55);
        transition: background .2s, border-color .2s, color .2s, transform .2s;
        text-decoration: none;
        flex-shrink: 0;
    }

    .fsoc-btn svg {
        width: 18px;
        height: 18px;
        fill: #938fb5;
        display: block;
    }

    .fsoc-btn:hover {
        background: rgba(255, 255, 255, .13);
        border-color: rgba(255, 255, 255, .28);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ── Agar footer light background pe hai ── */
    .footer-light .fsoc-btn {
        background: rgba(15, 10, 30, .06);
        border-color: rgba(15, 10, 30, .12);
        color: rgba(15, 10, 30, .5);
    }

    .footer-light .fsoc-btn:hover {
        background: rgba(124, 58, 237, .1);
        border-color: rgba(124, 58, 237, .3);
        color: #7c3aed;
    }
</style>

</body>

</html>