<form class="form-horizontal" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
    <div class="form-group">
        <label class="sr-only" for="s"><?php _e( 'Search', 'underscoresme' ); ?></label>
        <div class="col-xs-12">
            <div class="input-group">
                <input type="text" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'underscoresme' ); ?>">
                <div class="input-group-addon" onclick="document.getElementById('searchform').submit();">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
</form>