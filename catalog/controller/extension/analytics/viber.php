<?php
class ControllerExtensionAnalyticsViber extends Controller {
    public function index() {
		if (isset($this->request->get['route']) && $this->request->get['route'] == 'viber') {
			$this->load->model('extension/analytics/viber');
			$session_id = $this->session->getId();

			if (!$this->model_extension_analytics_viber->SessionAlreadyRecorded($session_id)) {
				$this->model_extension_analytics_viber->AddNewSession($session_id);
			} else {
				$this->model_extension_analytics_viber->AddClickToSession($session_id);
			}
			// $this->response->redirect($this->url->link('catalog/attribute_group', 'user_token=' . $this->session->data['user_token'] . $url, true));
			$this->response->redirect(HTTPS_SERVER);
		}
	}
}
