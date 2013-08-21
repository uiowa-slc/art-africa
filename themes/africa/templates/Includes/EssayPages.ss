    <div class="content columns" id="essay">
       <% loop $getPaginatedPages('EssayPages') %>
        $Content
      <% end_loop %>
    </div>

    <% if $getPaginatedPages('EssayPages').MoreThanOnePage %>
      <div class="pagination">
      <% if $getPaginatedPages('EssayPages').NotFirstPage %>
        <a class="prev" href="{$getPaginatedPages('EssayPages').PrevLink}#essay">Prev</a>
      <% end_if %>
      <% loop $getPaginatedPages('EssayPages').Pages %>
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
        <a class="next" href="{$getPaginatedPages('EssayPages').NextLink}#essay">Next</a>
      <% else %>
       	<% if $Level(1).Title == 'Chapters' %>
	   		<a href="{$getNextSubtopic($Title, 'Link')}">Next Chapter: {$getNextSubtopic($Title, 'Title')}</a>
	   	<% end_if %>
      <% end_if %>
      
      </div>
    <% end_if %>