 <div class="audio-piece">
	     
	     <video class="" id="videoPiece{$Pos}" src="{$AudioFile.URL}" width="320" height="240"></video>
	     <h3><a href="{$Link}">$Title</a></h3>
	    <script>
			
			$('video').mediaelementplayer({
			  pluginPath: '{$BaseHref}themes/africa/javascript/mediaelement/build/'
			}); //Replaces video tags with media element player
	
		</script>
	 
	 
</div>