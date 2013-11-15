    <% if $getPaginatedPages('EssayPages').MoreThanOnePage %>
      <div class="pagination">
      <% if $getPaginatedPages('EssayPages').NotFirstPage %>
        <a class="prev" href="{$getPaginatedPages('EssayPages').PrevLink}">Prev</a>
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
        <a class="next" href="{$getPaginatedPages('EssayPages').NextLink}">Next Page</a>
   
      <% else %>
   
       	<% if $Level(1).Title == 'Chapters' && $ClassName = 'Subtopic' %>
       	<%--This check should only occur when this include is used with a Chapter, not with a Field Essay or the introduction to a Chapter
       	    getNextSubtopic is in Subtopic.php  --%>      
       	     	<% with $getNextSubtopic($Title) %>
	       		  <!--<a href="{$getNextSubtopic($Title, 'Link')}">Next Subtopic: {$getNextSubtopic($Title, 'Title')}</a>-->
	       		  <a href="{$Link}">Next $ClassName: $Title</a>
       		  <% end_with %>
   
        <% else_if $ClassName='Chapter' %>
        	<%--in Chapter.php
        					--%>
        	
        	<% with $getNextChapter %>
	       		  <!--<a href="{$getNextSubtopic($Title, 'Link')}">Next Subtopic: {$getNextSubtopic($Title, 'Title')}</a>-->
	       		  <a href="{$Link}">Next $ClassName: $Title</a>
       		<% end_with %>
	   	<% end_if %>
	   	
	   
	  <% end_if %> 
	  
      
      
      </div>
    <% end_if %>