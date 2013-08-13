<div class="media-grid-container" id="video-scroller">
<h3>Images from the essay</h3>
			<ul>
<% cached 'EssayImages', EssayPages.max(LastEdited) %>
<% loop getEssayImages %>
				
											
				    
				    <li>
				      <img src="{$CroppedImage(225,225).URL}" data-mfp-src="{$URL}" class="videoThumbnail artPhoto" title="{$CreditLine}" data-mfp-href="{$Link(false)}">
				      <!--
				      <span class="play">
				            <span></span>
				        </span>-->
				     </li>
				   
				
		

<% end_loop %>
<% end_cached %>
</ul>
			</div>