<div class="image-scroller-container" id="video-scroller">

<% if VideoPieces %> 
<h3>Video</h3>
  <ul>
	    <% loop VideoPieces %> 
	    <li>
	      <img src="{$Thumbnail.CroppedFocusedImage(225,225).URL}" data-mfp-src="{$MediaLink}" class="videoThumbnail avContent" title="{$CreditLine}" data-mfp-href="{$Link(false)}">
	      <!--
	      <span class="play">
	            <span></span>
	        </span>-->
	      <img class="avContent relPos play-icon" data-mfp-src="{$MediaLink}" src="{$ThemeDir}/images/play-icon.png" data-mfp-href="{$Link(false)}"/>
	    </li>
	    <% end_loop %>
  </ul>
<% end_if %>
</div>

