<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title><% if not $Object %>$Title<% else %>$Object.Title<% end_if %><% if $EssayPages || $Object.EssayPages %>, Page <% loop $getPaginatedPages %>$PageNo<% end_loop %><% end_if %> -  Art &amp; Life in Africa - The University of Iowa Museum of Art</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <% include OpenGraphTags %>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    $MetaTags(false)
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOH9KFNRO7khI_4vmU7In5JAmeSay11Mw&v=3.expe&libraries=geometry"></script>
    <link rel="icon" type="image/png" href="{$BaseHref}themes/africa/images/logo.png">
    <link rel="stylesheet" type="text/css" href="{$ThemeDir}/dist/css/main.css" />
  </head>
  
  <body>
<!--[if lte IE 9]>
     <link rel="stylesheet" href="{$ThemeDir}/css/ie.css" />  
<![endif]-->
    <div id="view" class="$ClassName $Action">
      <div class="top-link"><a href="#">Top &#8593;</a></div><!-- end .top-link -->
      <div id="top">
        <div class="hamburger m" data-toggle=".nav1" onclick="void(0)">
          <div></div>
          <div class="patty"></div>
          <div></div>
        </div>
        <div id="logo">
          <a href="{$BaseHref}">Art &amp; Life<br>in Africa</a>
        </div>
        <nav class="nav1 toggle">
          <ul>
            <li class="mobile-filter-container visible-phone">
            <%-- Media --%>
            <% if Title == 'Media' %>
                <nav class="media-filter-form">
                  $MediaFilterForm
                </nav>
            <% end_if %>
            </li>
            <% loop Menu(1) %>
            <li <% if $URLSegment == "home" %>style="display: none"<% end_if %> class="$URLSegment">
              <a href="$Link" class="$LinkOrSection $URLSegment">$MenuTitle</a>
            </li>
            <% end_loop %>
            <% if $Action != "SearchForm" %>
            <li class="search-li">
              $SearchForm
            </li>
            <% end_if %>
          </ul>
        </nav>
      </div><!-- end #top -->

      <div id="middle">
      <% include Subnav %>

      <div id="main_content" class="$ClassName">
        $Layout
        <div id="footer" class="padded">
          <div class="container-fluid">
            <div class="row-fluid">
            <div class="span4">
              <div>
              <p>
              <a href="http://uima.uiowa.edu" target="_blank"><img src="{$ThemeDir}/dist/images/UIMA-newlogo-black.png" alt="University of Iowa Museum of Art" class="uima-logo"></a>
              </p>
              <p>
                Administrative Offices: <br />
                1375 Highway One West<br />
                1840 Studio Arts Building<br />
                Iowa City, IA 52242<br />
                <a href="http://uima.uiowa.edu/visit-us/" target="_blank">View Museum Locations</a><br />
                Telephone (319) 335-1727<br />
                Fax (319) 335-3677<br />
                <a href="http://www.uiowa.edu/homepage/online-privacy-information" target="_blank">Privacy Information</a>
              </p>
              </div>
            </div>

            <div class="span4 offset4 social-media">
      
              <p style="margin-top: 2rem">
                <a class="img-link" target="_blank" href="https://www.facebook.com/UIMuseumofArt">
                  <img width="42" src="{$ThemeDir}/dist/images/facebook-icon.png" alt="Facebook" style="margin-right: 0.5rem">
                </a>
                <a class="img-link" target="_blank" href="https://twitter.com/UIMuseumofArt">
                  <img width="42" src="{$ThemeDir}/dist/images/twitter-icon.png" alt="Twitter" style="margin-right: 0.5rem">
                </a>
                <a class="img-link" target="_blank" href="http://www.youtube.com/user/UIMAartmatters">
                  <img width="42" src="{$ThemeDir}/dist/images/youtube-icon.png" alt="Youtube">
                </a>
              </p>
              <ul>
                <% loop Menu(1) %>
                <li>
                  <a href="$Link">$MenuTitle</a>
                </li>
                <% end_loop %>
              </ul>
            </div><!-- end .span4 .social-media -->
          </div><!-- end .row-fluid -->
          </div><!-- end .container-fluid -->
        </div><!-- end #footer -->
      </div><!-- end #main_content -->

    </div><!-- end #middle -->
    </div><!-- end #view-->
<script src="{$ThemeDir}/dist/scripts/main.min.js"></script>    
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