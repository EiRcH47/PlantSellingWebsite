<?php if(is_active_sidebar('click-icon-layout-3')) : ?>
    <div class="click-icon-wrapper">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="icon-options-vertical icons"></i></button>
        <div class="dropdown-menu click-icon-content">
            <?php dynamic_sidebar('click-icon-layout-3'); ?>
        </div>
    </div>
<?php endif;?>