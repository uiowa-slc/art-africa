		<form action="{$BaseHref}home/SearchForm">
			<div class="fieldHolder">
				<label for="searchInput" class="sr-only">Search</label><button type="submit" class="fa fa-search search-button" aria-hidden="true"></button>
				<input type="search" name="Search" class="textInput" id="searchInput" placeholder="Search" value="{$Query}" />
				<input type="submit" id="submitSearch" name="Go" class="button" value="Go"/>
					
			</div>
		</form>
		<div class="clearfix"></div>