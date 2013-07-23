<div class="media-grid-container">
  <ul>
    <% loop ArtPhotos %>
    <li>
      <img src="{$Picture.CroppedImage(125,125).Filename}" data-mfp-src="{$Picture.Filename}" class="artPhoto {$size}" title="{$CreditLine}" data-mfp-href="{$Link(false)}">
    </li>
    <% end_loop %>
  </ul>
</div>
