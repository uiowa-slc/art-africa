<div id="tags">
		<h3>Tags</h3>
		<div class="pclip"></div>
		<p>
		<% loop SplitKeywords %>
			<a href="home/SearchForm?Search={$Keyword}&Go=Submit">$Keyword</a><% if Last %><% else %>,<% end_if %> 
		<% end_loop %>
		
		</p>
		<div class="clearfix"></div>
</div>