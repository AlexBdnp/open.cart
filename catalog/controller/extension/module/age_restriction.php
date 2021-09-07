<?php
class ControllerExtensionModuleAgeRestriction extends Controller {

	public function index($setting = null) {
		if($setting == null) return;
		$data = array();
		return $this->load->view('extension/module/age_restriction', $data);
	}
	
}