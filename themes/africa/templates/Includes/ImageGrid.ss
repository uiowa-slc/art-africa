<div class="media-grid-container">
  <ul>
    <% loop Images %>
    <li>
      <img src="{$CroppedImage(225,225).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="{$CreditLine}" data-mfp-href="{$Link(false)}">
    </li>
    <% end_loop %>
  </ul>
</div>
