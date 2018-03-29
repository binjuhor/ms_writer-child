<span class="btc-search"><i class="fa fa-search"></i></span>
<form method="get" id="btc-mondaysearch" class="searchbox search-form" action="<?php echo esc_attr( home_url() ); ?>" _lpchecked="1">
    <input type="text" name="s" id="btc-searchinput" class="searchbox-input" value="<?php the_search_query(); ?>" <?php if (!empty($mts_options['mts_ajax_search'])) echo ' autocomplete="off"'; ?> />
    <input type="submit" value="<?php esc_html_e("Tìm kiếm","ms_writer");?>">
</form>