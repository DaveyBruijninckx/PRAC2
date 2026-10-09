
<footer class="site-footer">
  <div class="container">
    <p class="site-footer__copyright">© {{ __('misc.copyright') }}</p>
    <div class="site-footer__columns">
  <section>
        <h2>{{ __('site.about_us') }}</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id tellus ac justo vehicula tempus. Aenean scelerisque efficitur volutpat. Etiam eleifend eleifend dolor non varius. Integer quam nunc, maximus quis.</p>
  </section>
  <section>
        <h2>{{ __('site.contact_details') }}</h2>
        <p>{{ __('site.phone') }}:</p>
        <p>{{ __('site.email') }}:</p>
        <p><a href="/contact/" title="{{ __('site.to_contact_form') }}">{{ __('site.to_contact_form') }}</a></p>
  </section>
  <section>
        <h2>{{ __('site.socials') }}</h2>
        <a href="">Lorem ipsum</a>
  </section>
    </div>
  </div>
</footer>


<!-- analytics code -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30506707-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- Einde analytics code -->

<script language="Javascript" type="text/javascript">

 if (top.location!= self.location) {
  top.location = self.location.href
 }

</script>
