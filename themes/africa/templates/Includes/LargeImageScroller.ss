<div class="media-grid-container">
  <ul class="large-image-grid">
    <% loop Images %>
    <li>
      <img src="{$CroppedImage(650,650).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="{$CreditLine}" data-mfp-href="{$Link(false)}">
    </li>
    <% end_loop %>
  </ul>
</div>
