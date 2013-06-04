<!DOCTYPE html>
<html lang="$ContentLocale">
  <head>
    <% base_tag %>
    <title>Art &amp; Life in Africa</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1">
    $MetaTags(false)
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/normalize/2.1.0/normalize.min.css" media="all" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <script src="{$ThemeDir}/javascript/script.js" type="text/javascript"></script>
    <link href='{$ThemeDir}/css/layout.css' rel='stylesheet' type='text/css'>
    <meta name="apple-mobile-web-app-capable" content="yes" />
  </head>
  <body>
    <div id="view">
      <div id="top">
        <div class="hamburger m" data-toggle=".nav1" onclick="void(0)">
          <div></div>
          <div class="patty"></div>
          <div></div>
        </div>
        <div id="logo" class="trol">
          Art &amp; Life<br>
          in Africa
        </div>
        <nav class="nav1 toggle">
          <ul>
            <% loop Menu(1) %>
            <li>
              <a href="$Link" class="trol">$MenuTitle</a>
              <% if $URLSegment = 'chapters' %>
              <nav class="nav2">
                <ul>
                  <li>
                    <a href="#">Everyday Endeavors</a>
                    <nav class="nav3">
                      <ul>
                        <li>
                          <a href="#">Everyday Endeavors</a>
                        </li>
                        <li>
                          <a href="#">Key Moments in Life</a>
                        </li>
                        <li>
                          <a href="#">Education Initiation</a>
                        </li>
                        <li>
                          <a href="#">Abundance</a>
                        </li>
                        <li>
                          <a href="#">Sacred Spaces</a>
                        </li>
                        <li>
                          <a href="#">Divination</a>
                        </li>
                        <li>
                          <a href="#">Ancient Africa</a>
                        </li>
                        <li>
                          <a href="#">Arts of Healing</a>
                        </li>
                        <!--<% loop ChildrenOf('chapters') %>
                        <li>
                          <a href="$Link" id="$URLSegment" class="trol">$MenuTitle</a>
                        </li>
                        <% end_loop %>-->
                      </ul>
                    </nav>
                  </li>
                  <li>
                    <a href="#">Key Moments in Life</a>
                  </li>
                  <li>
                    <a href="#">Education Initiation</a>
                  </li>
                  <li>
                    <a href="#">Abundance</a>
                  </li>
                  <li>
                    <a href="#">Sacred Spaces</a>
                  </li>
                  <li>
                    <a href="#">Divination</a>
                  </li>
                  <li>
                    <a href="#">Ancient Africa</a>
                  </li>
                  <li>
                    <a href="#">Arts of Healing</a>
                  </li>
                  <!--<% loop ChildrenOf('chapters') %>
                  <li>
                    <a href="$Link" id="$URLSegment" class="trol">$MenuTitle</a>
                  </li>
                  <% end_loop %>-->
                </ul>
              </nav>
              <% end_if %>
            </li>
            <% end_loop %>
          </ul>
        </nav>
      </div>
      <div id="middle">
        <!-- for chapter pages -->
        <div id="chapters_heading">Chapters</div>
        <nav class="nav2">
          <ul>
            <li>
              <a href="#">Everyday Endeavors</a>
              <nav class="nav3">
                <ul>
                  <li>
                    <a href="#">Everyday Endeavors</a>
                  </li>
                  <li>
                    <a href="#">Key Moments in Life</a>
                  </li>
                  <li>
                    <a href="#">Education Initiation</a>
                  </li>
                  <li>
                    <a href="#">Abundance</a>
                  </li>
                  <li>
                    <a href="#">Sacred Spaces</a>
                  </li>
                  <li>
                    <a href="#">Divination</a>
                  </li>
                  <li>
                    <a href="#">Ancient Africa</a>
                  </li>
                  <li>
                    <a href="#">Arts of Healing</a>
                  </li>
                  <!--<% loop ChildrenOf('chapters') %>
                  <li>
                    <a href="$Link" id="$URLSegment" class="trol">$MenuTitle</a>
                  </li>
                  <% end_loop %>-->
                </ul>
              </nav>
            </li>
            <li>
              <a href="#">Key Moments in Life</a>
            </li>
            <li>
              <a href="#">Education Initiation</a>
            </li>
            <li>
              <a href="#">Abundance</a>
            </li>
            <li>
              <a href="#">Sacred Spaces</a>
            </li>
            <li>
              <a href="#">Divination</a>
            </li>
            <li>
              <a href="#">Ancient Africa</a>
            </li>
            <li>
              <a href="#">Arts of Healing</a>
            </li>
            <!--<% loop ChildrenOf('chapters') %>
            <li>
              <a href="$Link" id="$URLSegment" class="trol">$MenuTitle</a>
            </li>
            <% end_loop %>-->
          </ul>
        </nav>
        <div id="main_content">
        	$Layout
         
         
          <!-- <img src="{$ThemeDir}/images/homepage-pic.jpg" alt="">
          <div class="content-container typography">
            <article>
              <div class="content"><p>Welcome to SilverStripe! This is the default homepage. You can edit this page by opening <a href="admin/">the CMS</a>. You can now access the <a href="http://doc.silverstripe.org">developer documentation</a>, or begin <a href="http://doc.silverstripe.org/doku.php?id=tutorials">the tutorials.</a></p></div>
            </article>
          </div> -->
        </div>
      </div>
    </div>
  </body>
</html>
