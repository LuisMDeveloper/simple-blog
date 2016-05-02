<form class="form-inline" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <div class="form-group">
        <label class="sr-only" for="s"><?php _e( 'Search', 'underscoresme' ); ?></label>
        <input type="text" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'underscoresme' ); ?>">
    </div>
    <button type="submit" class="btn btn-default" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'underscoresme' ); ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
</form>