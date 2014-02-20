<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title>$Title - Art &amp; Life in Africa - The University of Iowa Museum of Art</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    $MetaTags(false)
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/2.1.0/normalize.min.css" media="all" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="icon" type="image/png" href="{$BaseHref}themes/africa/images/logo.png">
    
    <!-- Facebook intro -->

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=470713492967451";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
     
  </head>
  
  <body>
<!--[if lte IE 9]>
     <link rel="stylesheet" href="{$ThemeDir}/css/ie.css" /> 
<![endif]-->
    <div id="view" class="$ClassName $Action">
      <div class="top-link"><a href="#"><% if $Action == "SearchForm" %>Search Results<% else %>$Title<% end_if %> &#8593;</a></div>
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
                         <!-- Media -->
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
        <!-- for chapter pages -->
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
            <!-- Search Results -->

            <!-- Chapters -->
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

            <!-- Countries -->
            <% if $Level(1).Title == 'Countries' %>
              <% loop getCountries %>
                <% if Name %>
                  <li><a href="$Link(false)" data-gmaps="{$CapitalCity}, {$Name}" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>">$Name</a></li>
                <% else_if Title %>
                  <li><a href="$Link(false)" data-gmaps="{$CapitalCity}, {$Title}" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>

            <!-- Peoples -->
            <% if $Level(1).Title == 'Peoples' %>
              <% loop getPeople %>
                <% if Name %>
                  <li><a href="$Link(false)">$Name</a></li>
                <% else_if Title %>
                  <li><a href="$Link(false)">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>

            <!-- Media -->
            <% if $Level(1).Title == 'Media' %>

            <li>
        				<nav class="media-filter-form">
                  $MediaFilterForm
                  <% include MediaFilterQuickLinks %>
        				</nav>
            </li>
            <% end_if %>

                <!-- Video -->
                <% if $Level(1).Title == 'Video' %>
                  <% loop getVideoPieces %>
                    <% if Name %>
                      <li><a href="$Link(false)">$Name</a></li>
                    <% else_if Title %>
                      <li><a href="$Link(false)">$Title</a></li>
                    <% end_if %>
                  <% end_loop %>
                <% end_if %>

                <!-- Audio -->
                <% if $Level(1).Title == 'Audio' %>
                  <% loop getAudio %>
                    <% if Name %>
                      <li><a href="$Link(false)">$Name</a></li>
                    <% else_if Title %>
                      <li><a href="$Link(false)">$Title</a></li>
                    <% end_if %>
                  <% end_loop %>
                <% end_if %>

                <!-- ArtPhotos -->
                <% if $Level(1).Title == 'Art Photos' %>
                  <% loop getArtPhotos %>
                    <% if Name %>
                      <li><a href="$Link(false)">$Name</a></li>
                    <% else_if Title %>
                      <li><a href="$Link(false)">$Title</a></li>
                    <% end_if %>
                  <% end_loop %>
                <% end_if %>

            <!-- Field Essays (refered to on front end as topic essays)-->
            <% if $Level(1).Title == 'Topic Essays' %>
              <% loop getEssays %>
                <% if Name %>
                  <li><a href="$Link(false)">$Name</a></li>
                <% else_if Title %>
                  <li><a href="$Link(false)">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>
     
              
            <!-- Bibliogrpahy -->
            <% if $Level(1).Title == 'About' %>
              <% loop ChildrenOf('about') %>
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
                  <img src="{$ThemeDir}/images/UIMA-newlogo-black.png" class="uima-logo">
                </p>
                <p>
                  Administrative Offices: <br />
                  1375 Highway One West<br>
                  1840 Studio Arts Building<br>
                  Iowa City, IA 52242<br>
                  <a href="http://uima.uiowa.edu/visit-us/" target="_blank">View Museum Locations</a><br />
                  Telephone (319) 335-1727<br>
                  Fax (319) 335-3677
                </p>
                </div>
              </div>

              <div class="span4 offset4 social-media">
        
                <p style="margin-top: 2rem">
                  <a class="img-link" target="_blank" href="https://www.facebook.com/UIMuseumofArt">
                    <img width="42" src="{$ThemeDir}/images/facebook-icon.png" style="margin-right: 0.5rem">
                  </a>
                  <a class="img-link" target="_blank" href="https://twitter.com/UIMuseumofArt">
                    <img width="42" src="{$ThemeDir}/images/twitter-icon.png" style="margin-right: 0.5rem">
                  </a>
                  <a class="img-link" target="_blank" href="http://www.youtube.com/user/UIMAartmatters">
                    <img width="42" src="{$ThemeDir}/images/youtube-icon.png">
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

  </body>
</html>
