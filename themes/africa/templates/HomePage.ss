<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title>Art &amp; Life in Africa</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="icon" type="image/png" href="{$BaseHref}{$ThemeDir}/images/logo.png">
    $MetaTags(false)
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/2.1.0/normalize.min.css" media="all" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <meta name="apple-mobile-web-app-capable" content="yes" />
  </head>
  <body>
    <div id="view" class="homepage">
      <div id="top">
        <div class="hamburger m" data-toggle=".nav1, #pic" onclick="void(0)">
          <div></div>
          <div class="patty"></div>
          <div></div>
        </div>
        <div id="logo">
          <a href="{$BaseHref}">
            Art &amp; Life<br>
            in Africa
          </a>
        </div>
        <nav class="nav1 toggle">
          <ul>
            <% loop Menu(1) %>
            <li <% if $URLSegment == "home" %>style="display: none"<% end_if %> class="$URLSegment">
              <a href="$Link" class="$LinkOrSection $URLSegment">$MenuTitle</a>
            </li>
            <% end_loop %>
            <li class="search-li">
              $SearchForm
            </li>
          </ul>
        </nav>
      </div>
      <div style="position:relative">
        <div id="homepage-pic" onclick="void(0)">
          <div id="homepage-pic-switchers">
            <div id="homepage-pic-shadow"></div>
            <% loop HomepagePics %>
              <span class="switcher<% if First %> selected<% end_if %>"
                    data-img-url="{$HomepagePic.CroppedFocusedImage(1000,500).URL}"
                    data-link="{$PageLink}"
                    data-desc="{$CreditLine}">
              </span>
            <% end_loop %>
            <div id="homepage-pic-desc"></div>
          </div>
        </div>
      </div>
      <div id="homepage-fixed-footer">
        <a href="http://www.uiowa.edu/" target="_blank"><img src="{$ThemeDir}/images/home/uiowa-logo.png" width="200" style="margin-right: 2rem;position:relative;top:-1rem;"></a>
       <a href="http://uima.uiowa.edu/" target="_blank"> <img src="{$ThemeDir}/images/home/UIMA-newlogo-white.png" width="160" style="margin-right: 1.125rem;"></a>
        <a href="http://www.youtube.com/user/UIMAartmatters" target="_blank" class="img-link">
          <img width="42" src="{$ThemeDir}/images/home/youtube-icon-white.png" style="margin-right: 0.5rem">
        </a>
        <a href="https://www.facebook.com/UIMuseumofArt" target="_blank" class="img-link">
          <img width="42" src="{$ThemeDir}/images/home/facebook-icon-white.png" style="margin-right: 0.5rem">
        </a>
        <a href="https://twitter.com/UIMuseumofArt" target="_blank" class="img-link">
          <img width="42" src="{$ThemeDir}/images/home/twitter-icon-white.png">
        </a>
      </div>
      <div id="footer">
        <div class="c">
          <div class="col">
            <p>
              <img src="{$ThemeDir}/images/UIMA-newlogo-black.png">
            </p>
            <p>
              1375 Highway One West<br>
              1840 Studio Arts Building<br>
              Iowa City, IA 52242<br>
              Telephone (319) 335-1727<br>
              Fax (319) 335-3677
            </p>
          </div>
          <div class="col">
           <!-- <h3>See the African Art collection in person</h3>
            <p>
              1375 Highway One West<br>
              1840 Studio Arts Building<br>
              Iowa City, IA 52242<br>
              Telephone (319) 335-1727
            </p>-->
          </div>
          <div class="col">
            <p style="margin-top: 2rem">

              <a href="#" class="img-link">
                <img width="42" src="{$ThemeDir}/images/facebook-icon.png" style="margin-right: 0.5rem">
              </a>
              <a href="#" class="img-link">
                <img width="42" src="{$ThemeDir}/images/twitter-icon.png">
              </a>
              <a href="http://www.youtube.com/user/UIMAartmatters" target="_blank" class="img-link">
                <img width="42" src="{$ThemeDir}/images/youtube-icon.png" style="margin-right: 0.5rem">
              </a>
            </p>
            <ul>
              <% loop Menu(1) %>
                <li>
                  <a href="$Link">$MenuTitle</a>
                </li>
              <% end_loop %>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      // set the homepage background to the selected switcher on page load
      $(document).ready(function () {
        var selectedSwitcher = $('.switcher.selected:first');
        $('#homepage-pic').css('background-image', 'url(' + selectedSwitcher.data('img-url') + ')');
        $('#homepage-pic-desc').text( selectedSwitcher.data('desc') );
      });

      // when a switcher that is not selected is clicked, switch to its background
      $(document).on('click', '.switcher:not(.selected)', function () {
        // `this` is the .switcher:not(.selected) element that was clicked
        switchTo(this);
      });

      // when the homepage pic is clicked visit its link
      $(document).on('click', '#homepage-pic', function (event) {
        // if the target of the event is a switcher within the
        // #homepage-pic element just ignore the click
        if (! event.target.classList.contains('switcher')) {
          window.location.href = $('.switcher.selected').data('link');
        }
      });

      function switchTo (switcherElement) {
        var hp = $('#homepage-pic'),
            switcher = $(switcherElement);

        // mark the switcher as selected and deselect its selected siblings
        switcher.addClass('selected')
                .siblings('.selected')
                .removeClass('selected');

        // animate the background image
        // step 1: fade opacity to 0
        hp.animate(
          { opacity: 0 },
          { duration: 400,
            // step 2: change description and background-image, then fade opacity back to 1
            complete: function () {
              $('#homepage-pic-desc').text( switcher.data('desc') );
              hp.css('background-image', 'url(' + switcher.data('img-url') + ')');
              hp.animate({ opacity: 1 },
                         { duration: 600 });
            }
          }
        );

        // clear the existing auto-switch timeout
        clearTimeout(slideshowTimeout);
        // start the auto-switch timeout again
        slideshowTimeout = setTimeout(switchToNext, slideshowInterval);
      }

      function switchToNext () {
        // if there are not multiple homepage pics, do nothing
        if (document.querySelectorAll('.switcher').length < 2) { return; }

        // try to get the next switcher
        var nextEl = document.querySelector('.switcher.selected').nextElementSibling;

        // if there is a nextEl and it is a switcher...
        if (nextEl && nextEl.classList.contains('switcher')) {
          switchTo(nextEl);
        } else {
        // if there is not a nextEl, switch to the first switcher
          switchTo(document.querySelector('.switcher'));
        }
      }

      // start the slideshow timeout
      var slideshowInterval = 10000,
          slideshowTimeout  = setTimeout(switchToNext, slideshowInterval);
    </script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-426753-56', 'uiowa.edu');
  ga('send', 'pageview');

</script>
  </body>
</html>
