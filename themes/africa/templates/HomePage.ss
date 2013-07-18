<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title>Art &amp; Life in Africa</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="icon" type="image/png" href="http://localhost:8888/art-africa/themes/africa/images/logo.png">
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
            <li>
              <a href="$Link">$MenuTitle</a>
            </li>
            <% end_loop %>
          </ul>
        </nav>
      </div>
      <div style="position:relative">
        <div id="homepage-pic" onclick="void(0)">
          <div id="homepage-pic-switchers">
          <% loop HomepagePics %>
            
            <% if First %>
	            <span class="switcher selected" data-img-url="{$getFilename}"></span>
            <% else %>
            	<span class="switcher" data-img-url="{$getFilename}"></span>
            <% end_if %>
          <% end_loop %>
          </div>
        </div>
      </div>
      <div id="homepage-fixed-footer">
        <img src="{$ThemeDir}/images/home/uiowa-logo.png" width="200" style="margin-right: 2rem;position:relative;top:-1rem;">
        <img src="{$ThemeDir}/images/home/UIMA-newlogo-white.png" width="160" style="margin-right: 1.125rem;">
        <a href="http://www.youtube.com/user/CDROYburkina" target="_blank" class="img-link">
          <img width="42" src="{$ThemeDir}/images/home/youtube-icon-white.png" style="margin-right: 0.5rem">
        </a>
        <a href="#" class="img-link">
          <img width="42" src="{$ThemeDir}/images/home/facebook-icon-white.png" style="margin-right: 0.5rem">
        </a>
        <a href="#" class="img-link">
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
            <h3>See the African Art collection in person</h3>
            <p>
              1375 Highway One West<br>
              1840 Studio Arts Building<br>
              Iowa City, IA 52242<br>
              Telephone (319) 335-1727
            </p>
          </div>
          <div class="col">
            <p style="margin-top: 2rem">
              <a href="http://www.youtube.com/user/CDROYburkina" target="_blank" class="img-link">
                <img width="42" src="{$ThemeDir}/images/youtube-icon.png" style="margin-right: 0.5rem">
              </a>
              <a href="#" class="img-link">
                <img width="42" src="{$ThemeDir}/images/facebook-icon.png" style="margin-right: 0.5rem">
              </a>
              <a href="#" class="img-link">
                <img width="42" src="{$ThemeDir}/images/twitter-icon.png">
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
      $(document).ready(function () {
        $('#homepage-pic').css('background-image', 'url(' + $('.switcher.selected').data('img-url') + ')');
      });

      $(document).on('click', '.switcher:not(.selected)', function () {
        switchTo(this);
      });

      $(document).on('click', '#homepage-pic', function (event) {
        if (! event.target.classList.contains('switcher')) { switchToNext(); }
      });

      function switchTo (switcherElement) {
        var hp = $('#homepage-pic');
        var switcher = $(switcherElement);

        switcher.addClass('selected')
                .siblings()
                .removeClass('selected');

        $('#homepage-pic').animate(
          { opacity: 0 },
          { duration: 400,
            complete: function () {
              hp.css('background-image', 'url(' + switcher.data('img-url') + ')');

              hp.animate({ opacity: 1 },
                         { duration: 600 });
            }
          }
        );

        clearTimeout(slideshowTimeout);
        slideshowTimeout = setTimeout(switchToNext, slideshowInterval);
      }

      function switchToNext () {
        var nextEl = document.querySelector('.switcher.selected').nextElementSibling;
        if (nextEl) {
          switchTo(nextEl);
        } else {
          switchTo(document.querySelector('.switcher'));
        }
      }

      var slideshowInterval = 10000;
      var slideshowTimeout = setTimeout(switchToNext, slideshowInterval);
    </script>
  </body>
</html>
