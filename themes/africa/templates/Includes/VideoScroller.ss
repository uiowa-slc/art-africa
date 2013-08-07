<div class="media-grid-container" id="video-scroller">
  <ul>
    <% loop VideoPieces %> 
    <li>
      <img src="{$Thumbnail.CroppedImage(225,225).URL}" data-mfp-src="{$Thumbnail.URL}" class="videoThumbnail artPhoto" title="{$CreditLine}" data-mfp-href="{$Link(false)}">
      <!--
      <span class="play">
            <span></span>
        </span>-->
      <img class="play-icon" src="{$ThemeDir}/images/play-icon.png" />
    </li>
    <% end_loop %>
  </ul>
</div>
