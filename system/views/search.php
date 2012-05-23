<ul id="search_options">
    <li class="search_option">
        <h2>Search Users</h2>
        <p>Enter a username to view their geogram.</p>
        <form action="" id="search_user_form" data-search-type="user">
            <label>Enter username:</label>
            <input type="text" class="textbox" placeholder="username" id="search_user_text">
            <input type="submit" class="submit" value=" Search " id="search_user_submit"><img src="/public/images/ajax_loader.gif" class="ajax_loader">
        </form>
        <div id="search_user_results" class="search_results">
            <h3>Choose a user:</h3>
            <ul id="user_chooser"></ul>
        </div>
    </li>
    <li class="search_option">
        <h2>Search Tags</h2>
        <p>Enter a tag to view its geogram.</p>
        <form action="" id="search_tag_form" data-search-type="tag">
            <label>Enter tag:</label>
            <input type="text" class="textbox" placeholder="mariokart" id="search_tag_text">
            <input type="submit" class="submit" value=" Search " id="search_tag_submit"><img src="/public/images/ajax_loader.gif" class="ajax_loader">
        </form>
        <div id="search_tag_results" class="search_results">
            <h3>Choose a tag</h3>
            <ul id="tag_chooser"></ul>
        </div>
    </li>
    <li class="search_option">
        <h2>Search Location</h2>
        <p>You can enter a location or search for photos <a href="/location/me/">near you</a>.</p>
        <form action="" id="search_location_form" data-search-type="location">
            <label>Enter location:</label>
            <input type="text" class="textbox" placeholder="San Diego, CA" id="search_location_text">
            <input type="hidden" id="search_location_distance" value="">
            <input type="submit" class="submit" value=" Search " id="search_location_submit"><img src="/public/images/ajax_loader.gif" class="ajax_loader">
        </form>
        <p class="search_extra">Distance: <span id="distance_value"><?php echo INSTAGRAM_DEFAULT_DISTANCE ?></span> meters</p>
        <div id="distance_slider"></div>
        <div id="search_location_results" class="search_results">
            <h3>Choose a location</h3>
            <ul id="location_chooser"></ul>
        </div>
    </li>
</ul>