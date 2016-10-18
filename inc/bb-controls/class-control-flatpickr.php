<?php
/**
* Address control class for ButterBean.
*/
if ( ! class_exists( 'ButterBean_Control' ) ) {
	return; }

class ButterBean_Control_FlatPickr extends ButterBean_Control {

	public $type = 'flatpickr';

	public $show_time = true;

	public $date_format = 'Y-m-d';

	public $min_date = '';

	public $max_date = '';

	public function to_json() {
		parent::to_json();

		$this->json['show_time'] = $this->show_time;

		$this->json['date_format'] = $this->date_format;

		$this->json['value'] = esc_html( $this->get_value() );
	}

	public function get_template() {

		wp_enqueue_style( 'flatpickr' );
		wp_enqueue_script( 'flatpickr' );
		?>

		<div class="row">
			<p class="flatpickr input-group">
				<span class="butterbean-label">{{ data.label }}</span>
				<input type="text" id="{{ data.field_name }}" class="flatpickr-input" placeholder="Date" value="{{ data.value }}" name="{{ data.field_name }}" <# if ( true === data.show_time ) { #> data-enable-time="true" <# } #>>
			</p>
		</div>
		<?php }

}
