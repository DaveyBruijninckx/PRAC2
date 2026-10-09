<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header mr-auto">
            <a class="navbar-brand" href="/" title="{{ __('misc.home_alt') }}">{{ __('misc.homepage_title') }}</a>
        </div>
        <ul class="navbar-nav mr-3">
            <li class="nav-item">
                <a class="nav-link" href="/contact/" title="{{ __('site.contact') }}">{{ __('site.contact') }}</a>
            </li>
            <li class="nav-item {{ app()->getLocale() == 'nl' ? 'active' : '' }}">
                <a class="nav-link" href="/language/nl/" title="Nederlands">NL</a>
            </li>
            <li class="nav-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                <a class="nav-link" href="/language/en/" title="English">EN</a>
            </li>
        </ul>
        <div id="navbar" class="form-inline">

            <script>
                (function () {
                    var cx = 'partner-pub-6236044096491918:8149652050';
                    var gcse = document.createElement('script');
                    gcse.type = 'text/javascript';
                    gcse.async = true;
                    gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(gcse, s);
                })();
            </script>
            <gcse:searchbox-only></gcse:searchbox-only>


        </div><!--/.navbar-collapse -->
    </div>
</nav>
