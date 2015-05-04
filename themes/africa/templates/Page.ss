<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title><% if not $Object %>$Title<% else %>$Object.Title<% end_if %><% if $EssayPages || $Object.EssayPages %>, Page <% loop $getPaginatedPages %>$PageNo<% end_loop %><% end_if %> -  Art &amp; Life in Africa - The University of Iowa Museum of Art</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <% include OpenGraphTags %>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    $MetaTags(false)
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>
    <link rel="icon" type="image/png" href="{$BaseHref}themes/africa/images/logo.png">
  </head>
  
  <body>
<!--[if lte IE 9]>
     <link rel="stylesheet" href="{$ThemeDir}/css/ie.css" /> 
<![endif]-->
    <div id="view" class="$ClassName $Action">
      <div class="top-link"><a href="#">Top &#8593;</a></div>
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
            <li class="mobile-filter-container visible-phone visible-tablet">
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
            <li class="search-li">
              $SearchForm
            </li>
          </ul>
        </nav>
      </div>
      <div id="middle" class="">
        <%-- for chapter pages --%>
        <div id="subnav-container">
        <div id="chapters_heading"><% if $Action == "SearchForm" %>Search Results<% else %><a href="$Level(1).Link">$Level(1).Title</a><% end_if %></div>
        <nav class="nav2 interior-page">
              <% if $Action =="SearchForm" %>
              <div id="quick-links-container">
                <h3><% if $ResultsFound %>Jump To<% end_if %></h3>
                <ul class="quick-links">
                  <% if Image %><li><a href="#images">Images</a></li><% end_if %>
                  <% if VideoPiece %><li><a href="#videos">Videos</a></li><% end_if %>
                  <% if AudioPiece %><li><a href="#audio">Audio</a></li><% end_if %>
                  <% if Subtopic %><li><a href="#subtopics">Subtopics</a></li><% end_if %>
                  <% if People %><li><a href="#people">People</a></li><% end_if %>
                  <% if Essay %><li><a href="#essays">Essays</a></li><% end_if %>
                  <% if Country %><li><a href="#countries">Countries</a></li><% end_if %>
                  <% if BibliographyPage %><li><a href="#bibliographic">Bibliographic Entries</a></li><% end_if %>
                  <li><a href="#">Top of the page</a></li>
                </ul>
              <% end_if %>
          <ul class="$URLSegment">
            <%-- Search Results --%>

            <%-- Chapters --%>
            <% if $Level(1).Title == 'Chapters' %>
              <% loop ChildrenOf('chapters') %>
              <li>
                <!--<a href="$Link">$MenuTitle</a>-->
                <% if LinkOrSection = section %>
                  <a href="$Link" class="nav3">$MenuTitle</a>
                  <% if Children %>
                  	
	                  <nav class="nav3">
	                    <ul>
	                      <% loop Children %>
		                      <li>
		                        <a href="$Link"<% if LinkOrCurrent = current %> class="selected"<% end_if %>>
		                          $MenuTitle
		                        </a>
		                      </li>
	                      <% end_loop %>	                   
	                    </ul>
	                  </nav>
                  <% end_if %>
                <% else %>
                	 
                 <a href="$Link">$MenuTitle</a>
                	             
                <% end_if %>
              </li>
              <% end_loop %>
            <% end_if %>

            <%-- Countries --%>
            <% if $Level(1).Title == 'Countries' %>
              <% loop getCountries %>
                <% if Name %>
                  <li data-lat="$Latitude" data-lng="$Longitude" id="$ID"><a href="$Link(false)" data-gmaps="{$CapitalCity}, {$Name}" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>" >$Name</a></li>
                <% else_if Title %>
                  <li data-lat="$Latitude" data-lng="$Longitude" id="$ID"><a href="$Link(false)" data-gmaps="{$CapitalCity}, {$Title}" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>

            <%-- Peoples --%>
            <% if $Level(1).Title == 'Peoples' %>
              <% loop getPeople %>
                <% if Name %>
                  <li><a href="$Link(false)">$Name</a></li>
                <% else_if Title %>
                  <li><a href="$Link(false)">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>

            <%-- Media --%>
            <% if $Level(1).Title == 'Media' %>

            <li>
        				<nav class="media-filter-form">
                  $MediaFilterForm
                  <% include MediaFilterQuickLinks %>
        				</nav>
            </li>
            <% end_if %>

                <%-- Video --%>
                <% if $Level(1).Title == 'Video' %>
                  <% loop getVideoPieces %>
                    <% if Name %>
                      <li><a href="$Link(false)">$Name</a></li>
                    <% else_if Title %>
                      <li><a href="$Link(false)">$Title</a></li>
                    <% end_if %>
                  <% end_loop %>
                <% end_if %>

                <%-- Audio --%>
                <% if $Level(1).Title == 'Audio' %>
                  <% loop getAudio %>
                    <% if Name %>
                      <li><a href="$Link(false)">$Name</a></li>
                    <% else_if Title %>
                      <li><a href="$Link(false)">$Title</a></li>
                    <% end_if %>
                  <% end_loop %>
                <% end_if %>

                <%-- ArtPhotos --%>
                <% if $Level(1).Title == 'Art Photos' %>
                  <% loop getArtPhotos %>
                    <% if Name %>
                      <li><a href="$Link(false)">$Name</a></li>
                    <% else_if Title %>
                      <li><a href="$Link(false)">$Title</a></li>
                    <% end_if %>
                  <% end_loop %>
                <% end_if %>

            <%-- Field Essays (refered to on front end as topic essays)--%>
            <% if $Level(1).Title == 'Topic Essays' %>
              <% loop getEssays %>
                <% if Name %>
                  <li><a href="$Link(false)">$Name</a></li>
                <% else_if Title %>
                  <li><a href="$Link(false)">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>
     
              
            <%-- Bibliogrpahy --%>
            <% if $Level(1).Title == 'About' %>
              <% loop ChildrenOf('about') %>
              <li>
                <!--<a href="$Link">$MenuTitle</a>-->
                
                  <a href="$Link" class="nav3">$MenuTitle</a>
                  <% if $Children %>
	                  <nav class="nav3">
	                    <ul>
	                      <% loop Children %>
		                      <li>
		                        <a href="$Link"<% if LinkOrCurrent = current %> class="selected"<% end_if %>>
		                          $MenuTitle
		                        </a>
		                      </li>
	                      <% end_loop %>	                   
	                    </ul>
	                  </nav>
                <% else %>
                	 
                 <a href="$Link">$MenuTitle</a>
                	             
                <% end_if %>
              </li>
              <% end_loop %>
            <% end_if %>
    
          </ul>

        </nav>
        </div>
        <div id="main_content" class="$ClassName">
          $Layout
          <div id="footer" class="padded">
            <div class="container-fluid">
              <div class="row-fluid">
              <div class="span4">
                <div>
                <p>
                <a href="http://uima.uiowa.edu" target="_blank"><img src="{$ThemeDir}/images/UIMA-newlogo-black.png" alt="University of Iowa Museum of Art" class="uima-logo"></a>
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
                    <img width="42" src="{$ThemeDir}/images/facebook-icon.png" alt="Facebook" style="margin-right: 0.5rem">
                  </a>
                  <a class="img-link" target="_blank" href="https://twitter.com/UIMuseumofArt">
                    <img width="42" src="{$ThemeDir}/images/twitter-icon.png" alt="Twitter" style="margin-right: 0.5rem">
                  </a>
                  <a class="img-link" target="_blank" href="http://www.youtube.com/user/UIMAartmatters">
                    <img width="42" src="{$ThemeDir}/images/youtube-icon.png" alt="Youtube">
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
        </div>
      </div>
    </div>
    
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
