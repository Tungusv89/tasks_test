<?php
class CustomClass
{
	public function __construct()
	{
		add_action('wp_ajax_test_jobcart', array($this, 'test_jobcart'));
		add_action('wp_ajax_nopriv_test_jobcart', array($this, 'test_jobcart'));
	}

	public function test_jobcart()
	{
		// Проверка nonce
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'test_jobcart')) {
			$result = array('status' => false);
			wp_send_json($result);
		}

		// Очистка данных
		$template = sanitize_text_field($_POST['template']);
		$timestamp = $_POST['timestamp'];

		update_user_meta(get_current_user_id(), 'templates', $template);


		$template_date = get_user_meta(get_current_user_id(), 'template-date', true);
		if ($template_date) {
			update_user_meta(get_current_user_id(), 'template-date-update', $timestamp);
			$result = array('status' => 'update');
		} else {
			update_user_meta(get_current_user_id(), 'template-date', $timestamp);
			$result = array('status' => 'inserted');
		}

		wp_send_json($result);
	}
}

$customClass = new CustomClass();
