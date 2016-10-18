<?php
/**
 * Documents metaboxes
 */

if ( ! class_exists( 'DPT_Documents_Meta' ) ) {

	/**
	 * Main DPT class.  Runs the show.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	final class DPT_Documents_Meta {

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {

			// Register managers, sections, settings, and controls.
			add_action( 'butterbean_register', array( $this, 'register' ), 10, 2 );
		}

		/**
		 * Registers managers, sections, controls, and settings.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  object  $butterbean  Instance of the `DPT` object.
		 * @param  string  $post_type
		 * @return void
		 */
		public function register( $butterbean, $post_type ) {

			// Only run this on the `document` post type.
			// if ( 'bulletin' !== $post_type || 'thursday_packet' !== $post_type || 'press_release' !== $post_type ) {
			// 	return; }

			// Register our custom manager.
			$butterbean->register_manager(
				'dpt_document',
				array(
					'label'     => 'Document',
					'post_type' => array(
						'bulletin',
						'thursday_packet',
						'press_release',
					),
					'context'   => 'normal',
					'priority' 	=> 'high',
				)
			);

			// Get our custom manager object.
			$manager = $butterbean->get_manager( 'dpt_document' );

			// Register a section.
			$manager->register_section(
				'dpt_document_id_section',
				array(
					'label'    => 'Attached Document',
					'icon' => 'dashicons-format-aside',
				)
			);

			require_once stmark_posts_plugin()->dir_path . 'inc/bb-controls/class-control-file.php';
			$manager->register_control(
				new ButterBean_Control_File(
					$manager,
					'dpt_document_id',
					array(
						'type'        	=> 'document',
						'section'     	=> 'dpt_document_id_section',
						'label'       	=> '',
					)
				)
			);

			// Register a setting.
			$manager->register_setting(
				'dpt_document_id',
				array(
					array( 'sanitize_callback' => 'absint' )
				)
			);

			require_once stmark_posts_plugin()->dir_path . 'inc/bb-controls/class-control-flatpickr.php';
			$manager->register_control(
				new ButterBean_Control_FlatPickr(
					$manager,
					'doc_date',
					array(
						'type'        => 'flatpickr',
						'section'     => 'dpt_document_id_section',
						'label'       => 'Date of this material',
						'show_time' 	=> false,
						'description' => 'Example description.',
					)
				)
			);

			$manager->register_setting(
				'doc_date',
				array( 'sanitize_callback' => 'wp_filter_nohtml_kses' )
			);

			// Register a section.
			$manager->register_section(
				'dpt_document_v_section',
				array(
					'label'    => 'Version',
					'icon' => 'dashicons-tag',
				)
			);

			// Register a control.
			$manager->register_control(
				'document-version',
				array(
					'type'    => 'text',
					'section' => 'dpt_document_v_section',
					'label'   => '',
					'description' => 'date, revision, language, etc. <em>(optional)</em>',
				)
			);

			// Register a setting.
			$manager->register_setting(
				'document-version',
				array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			// Register a section.
			$manager->register_section(
				'dpt_document_parent_section',
				array(
					'label'    => 'Parent Document',
					'icon' => 'dashicons-networking',
				)
			);

			// Register a control.
			require_once stmark_posts_plugin()->dir_path . 'inc/bb-controls/class-control-doc-parent.php';
			$manager->register_control(
				new ButterBean_Control_Doc_Parent(
					$manager,
				'document-parent',
				array(
					'type'    => 'doc-parent',
					'section' => 'dpt_document_parent_section',
					'label'   => 'Is this file an appendix?',
					'description' => 'Choose the Document to append to.',
				)
				)
			);
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {

			static $instance = null;

			if ( is_null( $instance ) ) {
				$instance = new self;
				$instance->setup_actions();
			}

			return $instance;
		}

		/**
		 * Constructor method.
		 *
		 * @since  1.0.0
		 * @access private
		 * @return void
		 */
		private function __construct() {}
	}

	DPT_Documents_Meta::get_instance();
}
