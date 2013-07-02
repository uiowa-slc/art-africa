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
          Art &amp; Life<br>
          in Africa
        </div>
        <nav class="nav1 toggle">
          <ul>
            <% loop Menu(1) %>
            <li>
              <a href="$Link">$MenuTitle</a>
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
                          <a href="$Link" id="$URLSegment">$MenuTitle</a>
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
                    <a href="$Link" id="$URLSegment">$MenuTitle</a>
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
      <div id="pic" style="background-image:url('{$ThemeDir}/images/homepage-pic.jpg')">
        <div style="position:absolute;bottom: 2rem; right: 2rem;">
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
                    <a href="$Link" id="$URLSegment">$MenuTitle</a>
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
              <a href="$Link" id="$URLSegment">$MenuTitle</a>
            </li>
            <% end_loop %>-->
          </ul>
        </nav>
        <div id="main_content">
          
          <div id="ptcc">
            <article>
              <h1>Chapters</h1>
              <div class="content"></div>
            </article>
            <img style="margin-top: 2rem" src="{$ThemeDir}/images/homepage-pic.jpg" alt="">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <div class="two_columns">
              <h3>Hedy, Hedy, Hedy</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
              <h3>Hedy, Hedy, Hedy</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
            <hr>
            <ul class="objects">
              <li>
                <img src="{$ThemeDir}/images/object.jpg" width alt="">
                <h3>Everyday Endeavors</h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </li>
              <li>
                <img src="{$ThemeDir}/images/object.jpg" width alt="">
                <h3>Key Moments in Life</h3>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
              </li>
            </ul>
          </div>
          <% include SearchForm %>
          <div id="footer">
            <div class="c">
              <div class="col">
                <p>
                  <img src="{$ThemeDir}/images/UIMA-newlogo-black.png">
                </p>
                <p>
                  1375 Highway One West<br>
                  1840 Studio Arts Building</br>
                  Iowa City, IA 52242<br>
                  Telephone (319) 335-1727<br>
                  Fax (319) 335-3677
                </p>
              </div>
              <div class="col">
                <h3>See the African Art collection in person</h3>
                <p>
                  1375 Highway One West<br>
                  1840 Studio Arts Building</br>
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
      </div>
    </div>
  </body>
</html>