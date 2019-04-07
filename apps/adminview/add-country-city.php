<link rel="stylesheet" type="text/css" href="<?php echo Config\Config::url('/assets/css/admin-main.css')?>">

<h1>Event Settings</h1>
<ul class="tabs mainmenu">
  <li><a href="#tab-Settings">Settings</a></li>
  <li><a href="#tab-Country">Country</a></li>
</ul>
<ul class="mainmenu ">
    <li><a class="active" href="#">Add New Country/City</a></li>
</ul>

<div id="tab-Settings" class="tab_content">

  <ul>
    <li>Post publicado</li>
    <li>Post publicado</li>
    <li>Post publicado</li>
  </ul>
</div>

<div id="tab-Country" class="tab_content">
  <div class="wraper">
    <div class="list-country">
        <!-- <h3 style="margin: 0;">All Country</h3> -->
      <ul class="tabs">
        <li><a href="#tab-publicados">All Country</a></li>
        <li><a href="#tab-borradores">Borradores</a></li>
      </ul>
    </div>
    <div class="city-list">
      <div id="tab-publicados" class="tab_content">
        <ul>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
          <li>Post publicado</li>
        </ul>
      </div>
    </div>
  </div>
<!--   
  <div id="tab-borradores" class="tab_content">
      <ul>
        <li>Post borrador</li>
        <li>Post borrador</li>
        <li>Post borrador</li>
      </ul>
  </div> 
-->
</div>

<div id="tab-country_andcity" class="tab_content">
  <div class="wrap-from">
      <div class="child child-left">
          <h3>Add New Country</h3>
        <form> 
            <input type="text" placeholder="Bangladesh" name="firstname">
            <input type="text" placeholder="+088" name="lastname">
            <input class="country-submit" type="submit" value="Submit">
        </form>

      </div>
      <div class="child child-right"></div>
  </div>
</div>




<script type="text/javascript">
  jQuery('ul.mainmenu').each(function(){
    // For each set of tabs, we want to keep track of
    // which tab is active and it's associated content
    var $active, $content, $links = jQuery(this).find('a');

    // If the location.hash matches one of the links, use that as the active tab.
    // If no match is found, use the first link as the initial active tab.
    $active = jQuery($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
    $active.addClass('active');

    $content = $($active[0].hash);

    // Hide the remaining content
    $links.not($active).each(function () {
        jQuery(this.hash).hide();
    });

    // Bind the click event handler
    jQuery(this).on('click', 'a', function(e){
        // Make the old tab inactive.
        $active.removeClass('active');
        $content.hide();

        // Update the variables with the new link and content
        $active = jQuery(this);
        $content = jQuery(this.hash);

        // Make the tab active.
        $active.addClass('active');
        $content.show();

        // Prevent the anchor's default click action
        e.preventDefault();
    });
});
</script>