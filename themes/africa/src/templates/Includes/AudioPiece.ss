 <div class="audio-piece">
	     
	     <video class="" id="videoPiece{$Pos}" src="{$AudioFile.URL}" width="282" height="282"></video>
	     <a href="{$Link}" target="_blank">$Title</a>
	    <script>
			
			$('video').mediaelementplayer({
			  pluginPath: '{$BaseHref}themes/africa/javascript/mediaelement/build/'
			}); //Replaces video tags with media element player
	
		</script>
	<div class="credit-line">
	 <% if $Caption %>
		$Caption
	<% end_if %>
	</div>
</div>
