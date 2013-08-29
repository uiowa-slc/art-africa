
<div class="media-grid-container" id="video-scroller">
  <ul>
    <% loop AudioPieces %> 
        <li>
     
     <video class="" id="videoPiece{$Pos}" src="{$AudioFile.URL}" width="320" height="240"></video>
     <div></div>
     <span class="audioTitle">$Title asdTitle </span>
     <a class="audioLink" href="{$Link}">$Link asdLink</a>
    

      <!--<a href="#videoPiece{$Pos}" data-mfp-src="#videoPiece{$Pos}" class="open-glossary-link"> <img src="{$Thumbnail.CroppedImage(225,225).URL}" class="videoThumbnail" title="{$MediaLink}" /> </a>-->

      <!--<img class="avContent relPos play-icon" data-mfp-src="{$MediaLink}" src="{$ThemeDir}/images/play-icon.png" data-mfp-href="{$Link(false)}"/>-->
      
    </li>
    <% end_loop %>
  </ul>
</div>

<!--art-africa/assets/Uploads/176484-goup-1-piano-key-a-2.wav-->