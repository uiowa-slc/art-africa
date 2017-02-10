<% loop $getCountries %>
	<% if $Name %>
	  <li data-lat="$Latitude" data-lng="$Longitude" id="$ID"><a href="$Link(false)" data-gmaps="{$CapitalCity}, {$Name}" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>" >$Name</a></li>
	<% else_if $Title %>
	  <li data-lat="$Latitude" data-lng="$Longitude" id="$ID"><a href="$Link(false)" data-gmaps="{$CapitalCity}, {$Title}" data-googlename="<% if $GoogleName %>$GoogleName<% else %>$Title<% end_if %>">$Title</a></li>
	<% end_if %>
<% end_loop %>