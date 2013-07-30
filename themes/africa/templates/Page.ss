<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title>$Title - Art &amp; Life in Africa - The University of Iowa Museum of Art</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    $MetaTags(false)
    <link href="{$ThemeDir}/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/2.1.0/normalize.min.css" media="all" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script src="{$ThemeDir}/javascript/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>

    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="icon" type="image/png" href="/art-africa/themes/africa/images/logo.png">
    <!-- Add mousewheel plugin (this is optional)
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    Add fancyBox
    <link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script> -->
  </head>
  <body>
  
    <div id="view">
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
            <% loop Menu(1) %>
            <li>
              <a href="$Link">$MenuTitle</a>
            </li>
            <% end_loop %>
            <li class="search-li">
              <% include SearchForm %>
            </li>
          </ul>
        </nav>
      </div>
      <div id="middle">
        <!-- for chapter pages -->
        <div id="subnav-container">
        <div id="chapters_heading">$Level(1).Title</div>
        <nav class="nav2 interior-page">
          <ul>
            <!-- Chapters -->
            <% if $Level(1).Title == 'Chapters' %>
              <% loop ChildrenOf('chapters') %>
              <li>
                <a href="$Link">$MenuTitle</a>
                <% if LinkOrSection = section %>
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
              </li>
              <% end_loop %>
            <% end_if %>

            <!-- Countries -->
            <% if $Level(1).Title == 'Countries' %>
              <% loop getCountries %>
                <% if Name %>
                  <li><a href="countries/show/{$ID}" data-gmaps="{$CapitalCity}, {$Name}">$Name</a></li>
                <% else_if Title %>
                  <li><a href="countries/show/{$ID}" data-gmaps="{$CapitalCity}, {$Title}">$Title</a></li>
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
            	<li><a href="#">All</a>
				<nav class="nav3">
                    <ul>
                    	<li><a href="#">Photos</a></li>
                    	<li><a href="#">Video</a></li>
                    	<li><a href="#">Audio</a></li>

                    </ul>
				</nav>

            	</li>
				<li><a href="#">By Country</a></li>
				<li><a href="#">By Chapter</a></li>
				<li><a href="#">By Subtopic</a></li>
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

            <!-- Field Essays -->
            <% if $Level(1).Title == 'Field Essays' %>
              <% loop getEssays %>
                <% if Name %>
                  <li><a href="$Link(false)">$Name</a></li>
                <% else_if Title %>
                  <li><a href="$Link(false)">$Title</a></li>
                <% end_if %>
              <% end_loop %>
            <% end_if %>
          </ul>
        </nav>
        </div>
        <div id="main_content">
          $Layout
          <!-- <div class="gal">
            <a class="gal-link" href="/art-africa/themes/africa/images/logo.png">adsfasd</a>
            <a class="gal-link" href="/art-africa/themes/africa/images/UIMA-newlogo-black.png">adsfasd</a>
            <a class="gal-link" href="/art-africa/themes/africa/images/facebook-icon.png">adsfasd</a>
          </div> -->
          <!-- <img src="{$ThemeDir}/images/homepage-pic.jpg" alt="">
          <div class="content-container typography">
            <article>
              <div class="content"><p>Welcome to SilverStripe! This is the default homepage. You can edit this page by opening <a href="admin/">the CMS</a>. You can now access the <a href="http://doc.silverstripe.org">developer documentation</a>, or begin <a href="http://doc.silverstripe.org/doku.php?id=tutorials">the tutorials.</a></p></div>
            </article>
          </div> -->
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
                  <a class="img-link" target="_blank" href="#">
                    <img width="42" src="{$ThemeDir}/images/facebook-icon.png" style="margin-right: 0.5rem">
                  </a>
                  <a class="img-link" target="_blank" href="#">
                    <img width="42" src="{$ThemeDir}/images/twitter-icon.png" style="margin-right: 0.5rem">
                  </a>
                  <a class="img-link" target="_blank" href="http://www.youtube.com/user/CDROYburkina">
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
  </body>
</html>
