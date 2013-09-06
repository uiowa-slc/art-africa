
<div class="image-scroller-container" id="audio-scroller">
  <ul>
    <% loop AudioPieces %> 
        <li id="audioObject">
     
     <video class="" id="videoPiece{$Pos}" src="{$AudioFile.URL}" width="320" height="240"></video>

     <span class="audioTitle">$Title.LimitWordCountXML(8) <br> <a href="{$Link}">View Track Info</a></span>
     
    <script>
		
		  $('video').mediaelementplayer(); //Replaces video tags with media element player

	</script>
 
 
    </li>
    <% end_loop %>
  </ul>
</div>

<!--art-africa/assets/Uploads/176484-goup-1-piano-key-a-2.wav-->