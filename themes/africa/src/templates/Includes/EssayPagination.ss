<div class="pagination">
<% if $getPaginatedPages('EssayPages').MoreThanOnePage %>
    <% if $getPaginatedPages('EssayPages').NotFirstPage %>
      <a class="prev" href="{$getPaginatedPages('EssayPages').PrevLink}"><i class="fa fa-caret-left" aria-hidden="true"></i> Previous Page</a>
     <% end_if %>

    <% loop $getPaginatedPages('EssayPages').PaginationSummary(4) %>
      <% if $CurrentBool %>
        <span>$PageNum</span>
      <% else %>
        <% if $Link %>
          <a href="{$Link}#essay">$PageNum</a>
        <% else %>
          ...
        <% end_if %>
      <% end_if %>
    <% end_loop %>

    <% if $getPaginatedPages('EssayPages').NotLastPage %>
      <a class="next" href="{$getPaginatedPages('EssayPages').NextLink}">Next Page <i class="fa fa-caret-right" aria-hidden="true"></i></a>
    <% else %>
      <% if $nextPageInTree %>
        <% with $nextPageInTree %>
          <a href="{$Link}">Next $ClassName: $Title <i class="fa fa-caret-right" aria-hidden="true"></i></a>
        <% end_with %>
      <% end_if %>
  	<% end_if %> 
<!-- end pagination -->

  <%-- else if $getPaginatedPages('EssayPages').MoreThanOnePage --%>
  <% else %>
    <% if $nextPageInTree %>
      <% with $nextPageInTree %>
        <a href="{$Link}">Next $ClassName: $Title <i class="fa fa-caret-right" aria-hidden="true"></i></a>
      <% end_with %>
    <% end_if %>
 <% end_if %>
</div>