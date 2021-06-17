<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% include GlobalAnalytics %>
    <% include Gtag %>
    <% base_tag %>
    <title><% if not $Object %>$Title<% else %>$Object.Title<% end_if %><% if $EssayPages.Count > 1 || $Object.EssayPages.Count > 1 %>, Page <% loop $getPaginatedPages %>$PageNo<% end_loop %><% end_if %> -  Art &amp; Life in Africa - The University of Iowa Stanley Museum of Art</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <% include OpenGraphTags %>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    $MetaTags(false)
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOH9KFNRO7khI_4vmU7In5JAmeSay11Mw&v=3.expe&libraries=geometry"></script>
    <link rel="icon" type="image/png" href="{$BaseHref}{$ThemeDir}/dist/images/logo.png">
    <link rel="stylesheet" type="text/css" href="{$ThemeDir}/dist/css/main2020-6-3.css" />
  </head>
  
  <body>
    <% include UiowaBar %>
<!--[if lte IE 9]>
     <link rel="stylesheet" href="{$ThemeDir}/css/ie.css" />  
<![endif]-->
    <div id="view" class="$ClassName $Action">
      <div class="top-link"><a href="#">Top &#8593;</a></div><!-- end .top-link -->
      <div id="top" class="top">
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
             <a href="https://stanleymuseum.uiowa.edu/" target="_blank" rel="noopener">University of Iowa Stanley Museum of Art</a>
              </p>
                $SiteConfig.FooterInfo
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
<script src="{$ThemeDir}/dist/scripts/main.min-2021.js"></script>    

  </body>
</html>
