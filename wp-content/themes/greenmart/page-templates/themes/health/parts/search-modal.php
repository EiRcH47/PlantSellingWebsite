<?php 

$_id = greenmart_tbay_random_key(); 

?>
<div id="search-form-modal-<?php echo esc_attr($_id); ?>">
	<button type="button" class="btn-search-totop" data-toggle="modal" data-target="#searchformshow-<?php echo esc_attr($_id); ?>">
	   <i class="<?php echo greenmart_get_icon('icon_search'); ?>"></i><?php esc_html_e('Search', 'greenmart'); ?>
	</button>
</div>

<div class="modal fade search-form-modal" id="searchformshow-<?php echo esc_attr($_id); ?>" tabindex="-1" role="dialog" aria-labelledby="searchformlable-<?php echo esc_attr($_id); ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="searchformlable-<?php echo esc_attr($_id); ?>"><?php esc_html_e('Search', 'greenmart'); ?></h4>
      </div>
      <div class="modal-body">
			<?php get_template_part( 'page-templates/parts/productsearchform' ); ?>
      </div>
    </div>
  </div>
</div>

