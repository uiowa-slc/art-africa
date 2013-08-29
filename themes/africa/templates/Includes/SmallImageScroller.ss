<div class="image-scroller-container">
  <ul>
    <% loop Images %>
    <li>
      <img src="{$CroppedFocusedImage(225,225).URL}" data-mfp-src="{$URL}" class="artPhoto {$size}" title="{$CreditLine}" data-mfp-href="$ShowLink">
    </li>
    <% end_loop %>
  </ul>
</div>
