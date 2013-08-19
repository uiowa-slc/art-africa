<div id="tags">
		<h3>Countries</h3>
		<div class="pclip"></div>
		<p>
		<% loop Countries %>
			<a href="{$Link}">$Title</a><% if Last %><% else %>,<% end_if %> 
		<% end_loop %>
		
		</p>
		<div class="clearfix"></div>
</div>