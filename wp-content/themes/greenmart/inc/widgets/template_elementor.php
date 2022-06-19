<?php

if( greenmart_elementor_is_activated() ) {
	class Tbay_Widget_Template_Elementor extends Tbay_Widget {
		public function __construct() {
			parent::__construct(
				'tbay_template_elementor',
				esc_html__( 'Tbay Template Elementor', 'greenmart' ),
				[
					'description' => esc_html__( 'Embed your saved elements', 'greenmart' ),
				]
			);
		}    
		public function getTemplate() {
			$this->template = 'template-elementor.php';
		}
		public function widget($args, $instance) {
			$title = apply_filters('widget_title', $instance['title']);
			$before_title = $args['before_title'];
			$after_title = $args['after_title'];
			if ( $title ) {
				echo trim($before_title)  . trim( $title ) . trim($after_title);
			}

			if ( ! empty( $instance['template_id'] ) && 'publish' === get_post_status( $instance['template_id'] ) ) {
				$this->sidebar_id = $args['id'];

				echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $instance['template_id'] );

				unset( $this->sidebar_id );
			}

		}
		public function form( $instance ) {
			$default = [
				'title' => '',
				'template_id' => '',
			];

			$instance = array_merge( $default, $instance );

			$templates = Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();

			if ( ! $templates ) {
				echo '<div id="tbay-elementor-widget-template-empty-templates">
				<div class="tbay-elementor-widget-template-empty-templates-icon"><i class="eicon-nerd" aria-hidden="true"></i></div>
				<div class="tbay-elementor-widget-template-empty-templates-title">' . esc_html__( 'You Haven’t Saved Templates Yet.', 'greenmart' ) . '</div>
				<div class="tbay-elementor-widget-template-empty-templates-footer">' . esc_html__( 'Want to learn more about Elementor library?', 'greenmart' ) . ' <a class="elementor-widget-template-empty-templates-footer-url" href="https://go.elementor.com/docs-library/" target="_blank">' . esc_html__( 'Click Here', 'greenmart' ) . '</a>
				</div>
				</div>';

				return;
			}
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'greenmart' ); ?>:</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'template_id' ) ); ?>"><?php esc_html_e( 'Choose Template', 'greenmart' ); ?>:</label>
				<select class="widefat elementor-widget-template-select" id="<?php echo esc_attr( $this->get_field_id( 'template_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'template_id' ) ); ?>">
					<option value="">— <?php esc_html_e( 'Select', 'greenmart' ); ?> —</option>
					<?php
					foreach ( $templates as $template ) :
						$selected = selected( $template['template_id'], $instance['template_id'] );
						?>
						<option value="<?php echo esc_attr($template['template_id']); ?>" <?php echo trim($selected); ?> data-type="<?php echo esc_attr( $template['type'] ); ?>">
							<?php echo trim($template['title']); ?> (<?php echo trim($template['type']); ?>)
						</option>
					<?php endforeach; ?>
				</select>
				<?php
				$style = ' style="display:none"';

				$template_type = get_post_meta( $instance['template_id'], 'meta_key', true );

				if ( 'page' === $template_type ) {
					$style = '';
				}
				?>
				<a target="_blank" class="elementor-edit-template"<?php echo trim($style); ?> href="<?php echo esc_url( add_query_arg( 'elementor', '', get_permalink( $instance['template_id'] ) ) ); ?>">
					<i class="eicon-pencil"></i> <?php echo esc_html__( 'Edit Template', 'greenmart' ); ?>
				</a>
			</p>
			<?php
		}


		public function update( $new_instance, $old_instance ) {
			$instance = [];
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['template_id'] = $new_instance['template_id'];

			return $instance;
		}
	}
}