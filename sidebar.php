<aside id="sidebar">
   <div class="widget widget_search">
      <h5>Search</h5>
      <form action="#">
         <input class="text-search" name="s" type="text" onfocus="if (this.value == 'Search here...') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Search here...'; }" value="Search here...">
         <input type="submit" class="submit-search" value="">
      </form>
   </div>
   <? dynamic_sidebar('sidebar-1')?>
</aside>