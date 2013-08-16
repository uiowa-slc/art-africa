		<form action="{$BaseHref}home/SearchForm">
					<div class="fieldHolder">
							<input type="text" name="Search" class="textInput" id="searchInput" placeholder="Search ALA" value="{$Query}" /><input type="submit" id="submitSearch" name="Go" class="button" value = "" />
						</div>
						<!--
							<label>Search bibliographic references only </label><input type="checkbox" name="Search Bibliography" /><br>
							<input type="submit" name="Go" class="button"   />
						SEARCH FORM-->
		</form>
		<div class="clearfix"></div>

		<!--<form $FormAttributes>
	<% if $Message %>
	<p id="{$FormName}_error" class="message $MessageType">$Message</p>
	<% else %>
	<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
	<% end_if %>
	<fieldset>
		<% loop $Fields %>
		$FieldHolder
		<% end_loop %>
		<% loop $Actions %>
		$Field
		<% end_loop %>
	</fieldset>
</form>
-->