<div class="popupnewsletter">
    <!-- Modal -->
    <div class="modal fade" id="popupNewsletterModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" <?php if ( isset($image) && $image ) : ?> style="background:url('<?php echo esc_attr( $image ); ?>') no-repeat #eaeaea" <?php endif; ?> >
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="fa fa-times"></span></button>
          <div class="modal-body">
                 <div class="popupnewsletter-widget">
                    <?php if(!empty($title)){ ?>
                        <h3>
                            <span><?php echo esc_html( $title ); ?></span>
                        </h3>
                    <?php } ?>
                    
                    <?php if(!empty($description)){ ?>
                        <p class="description">
                            <?php echo trim( $description ); ?>
                        </p>
                    <?php } ?>      
                    <?php
                        if (function_exists('mc4wp_show_form')) {
                          try {
                                $form = mc4wp_get_form();
                                echo do_shortcode('[mc4wp_form id="'. $form->ID .'"]');
                            } catch (Exception $e) {
                                esc_html_e('Please create a newsletter form from Mailchip plugins', 'greenmart');
                            }
                        }
                    ?>
                </div>
          </div>
        </div>
      </div>
    </div>
</div>