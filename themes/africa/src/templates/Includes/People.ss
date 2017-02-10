<div id="tags">
		<h3>People</h3>
		<div class="pclip"></div>
		<p>
		<% loop People %>
			<a href="{$Link}">$Title</a><% if Last %><% else %>,<% end_if %> 
		<% end_loop %>
		
		</p>
		<div class="clearfix"></div>
</div>