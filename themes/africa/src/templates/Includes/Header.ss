<header class="header" role="banner">
	<div class="inner">
		<a href="{$BaseHref}home" class="brand" rel="home">
			<h1>$SiteConfig.Title</h1>
			<% if SiteConfig.Tagline %>
			<p>$SiteConfig.Tagline</p>
			<% end_if %>
		</a>
		<% if SearchForm %>
			<span class="search-dropdown-icon">L</span>
			<div class="search-bar">
				$SearchForm
			</div>		
		<% end_if %>
		<% include Navigation %>
	</div>
</header>