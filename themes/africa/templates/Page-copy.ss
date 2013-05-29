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
  </head>
  <body>
    <div id="view" class="homepage">
      <div id="masthead">
        <div class="container">
          <div id="logo" class="padded trol">
            Art &amp; Life<br>
            in Africa
          </div>
          <nav id="section_nav">
            <ul>
              <% loop Menu(1) %>
              <li>
                <a href="$Link" class="padded trol">$MenuTitle</a>
              </li>
              <% end_loop %>
            </ul>
          </nav>
        </div>
      </div>
      <div id="main" class="container">
        <div id="section_heading" onclick="void(0)">
          <h1 class="trol padded">Chapters</h1>
        </div>
        <nav id="pages_nav">
          <ul>
            <% loop ChildrenOf('chapters') %>
            <li>
              <a href="$Link" id="$URLSegment" class="padded trol selected">$MenuTitle</a>
            </li>
            <% end_loop %>
          </ul>
        </nav>
        <nav id="page_nav">
          <ul>
            <li>
              <a href="#artvscraft" class="padded trol">Art vs. Craft</a>
            </li>
            <li>
              <a href="#artist" class="padded trol">Artist</a>
            </li>
            <li>
              <a href="#furniture" class="padded trol">Furniture</a>
            </li>
            <li>
              <a href="#smokinganddrinking" class="padded trol">Smoking &amp; Drinking</a>
            </li>
            <li>
              <a href="#pottery" class="padded trol">Pottery</a>
            </li>
            <li>
              <a href="#architecture" class="padded trol">Architecture</a>
            </li>
            <li>
              <a href="#dress" class="padded trol">Dress</a>
            </li>
            <li>
              <a href="#textiles" class="padded trol">Textiles</a>
            </li>
          </ul>
        </nav>
        <div id="page_content">
          <div class="padded" style="padding: 1.25rem;">
            $Layout
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
