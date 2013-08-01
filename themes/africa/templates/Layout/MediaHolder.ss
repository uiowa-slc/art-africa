<!--<div class="content-container typography">
  <article>
    <h1>$Title</h1>
    $Content
    <div class="content columns">
      
      <h4>Videos</h4>
      <ul>
      <% loop getObjects('VideoPiece') %>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <% end_loop %>
      </ul>

      <h4>Audio</h4>
      <ul>
      <% loop getObjects('AudioPiece') %>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <% end_loop %>
      </ul>

      <h4>Art Photos</h4>
      <ul>
      <%-- loop getObjects('Image') --%>
        <% if Title %>
          <li><a href="$Link(false)">$Title</a></li>
        <% end_if %>
      <%-- end_loop --%>
      </ul>

    </div>
  </article>
</div>

<% include SideBar %>
-->


<style>
.lazy {
  display: none;
}
.item {
	margin-bottom: 10px;
}
</style>


<div class="content-container typography">
 	<div id="media-container" class="fluid">
 		<div class="js-masonry">
 		<% loop $getImages %>
 			<div class="item">
 		
<img src="{$SetWidth(200).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="{$CreditLine}" data-mfp-href="{$Link(false)}" />
 			</div>
 		<% end_loop %>
 		</div>
 	</div>
 	<% include SmallImageScroller %>
</div>

<script type="text/javascript">
  $('.open-glossary-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
  });
</script>
<script src="{$ThemeDir}/javascript/masonry.pkgd.min.js"></script>
<script src="{$ThemeDir}/javascript/imagesloaded.js"></script>
<!--<script src="{$ThemeDir}/javascript/jquery-ias.js"></script>
<script src="{$ThemeDir}/javascript/ias-init.js"></script>-->

<script src="{$ThemeDir}/javascript/jquery.infinitescroll.min.js"></script>
<script src="{$ThemeDir}/javascript/infinite-init.js"></script>


<%# include SideBar %>


