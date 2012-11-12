<form id="searchform" class="fon-form search-form" role="search" method="get" action="<?php echo home_url('/'); ?>">
    <fieldset>
        <div id="fon-s-autocomplete" class="ajax-autocomplete-box"></div>
        <input type="text" value="" name="s" id="fon-s-input" placeholder="Search posts" spellcheck="false" required autocomplete="off" aria-autocomplete="list" aria-haspopup="true"/>
        <button type="submit">Search</button>
    </fieldset>
    <div id="fon-s-results" class="ajax-results-box"></div>
</form>