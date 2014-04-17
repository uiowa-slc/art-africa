<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <% base_tag %>
    <title>Art &amp; Life in Africa - The University of Iowa Museum of Art</title>
    <% include OpenGraphTags %>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="icon" type="image/png" href="{$BaseHref}{$ThemeDir}/images/logo.png">
    $MetaTags(false)
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="google-site-verification" content="EOeMxKdPKJbyFVnHKzi6c7yBXm64S-Kun7cOOgK6oOw" />
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
              <a href="http://uima.uiowa.edu" target="_blank"><img src="{$ThemeDir}/images/UIMA-newlogo-black.png"></a>
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
<script src="{$ThemeDir}/javascript/homepage-slider.js"></script>
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
