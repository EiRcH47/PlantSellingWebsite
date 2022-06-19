<?php if(is_active_sidebar('click-icon-layout-1')) : ?>
    <div class="click-icon-wrapper click-icon-categories">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="icon-list icons"></i></button>
        <div class="dropdown-menu click-icon-content">
            <?php dynamic_sidebar('click-icon-layout-1'); ?>
        </div>
    </div>
<?php endif;?>