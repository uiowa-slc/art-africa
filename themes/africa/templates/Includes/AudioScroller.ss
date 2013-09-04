
<div class="image-scroller-container" id="audio-scroller">
  <ul>
    <% loop AudioPieces %> 
        <li id="audioObject">
     
     <video class="" id="videoPiece{$Pos}" src="{$AudioFile.URL}" width="320" height="240"></video>

     <span class="audioTitle">$Title.Summary(8) <br> <a href="{$Link}">View Track Info</a></span>
    

      <!--<a href="#videoPiece{$Pos}" data-mfp-src="#videoPiece{$Pos}" class="open-glossary-link"> <img src="{$Thumbnail.CroppedImage(225,225).URL}" class="videoThumbnail" title="{$MediaLink}" /> </a>-->

      <!--<img class="avContent relPos play-icon" data-mfp-src="{$MediaLink}" src="{$ThemeDir}/images/play-icon.png" data-mfp-href="{$Link(false)}"/>-->
      
    </li>
    <% end_loop %>
  </ul>
</div>

<!--art-africa/assets/Uploads/176484-goup-1-piano-key-a-2.wav-->