 <div class="audio-piece">
	     
	     <video class="" id="videoPiece{$Pos}" src="{$AudioFile.URL}" width="282" height="240"></video>
	     <p><a href="{$Link}">$Title</a></p>
	    <script>
			
			$('video').mediaelementplayer({
			  pluginPath: '{$BaseHref}themes/africa/javascript/mediaelement/build/'
			}); //Replaces video tags with media element player
	
		</script>
	 
	 
</div>