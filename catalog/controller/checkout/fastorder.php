<?php
class ControllerCheckoutFastorder extends Controller {
    public function index() {
        $data = [];
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_cart'),
			'href' => $this->url->link('checkout/cart')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('checkout/checkout', '', true)
		);
        $data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
        //данные для заказа
        $data['text_message'] = "Спасибо за покупку! Мы свяжемся с вами для уточнения деталей.";
        $data['telephone'] = $this->request->post["telephone"];
		$data['invoice_prefix'] = null;
		$data['store_id'] = null;
		$data['store_name'] = null;
		$data['store_url'] = null;
		$data['customer_id'] = null;
		$data['customer_group_id'] = null;
		$data['firstname'] = 'Новый';
		$data['lastname'] = 'Клиент';
		$data['email'] = null;
		$data['payment_firstname'] = null;
		$data['payment_lastname'] = null;
		$data['payment_company'] = null;
		$data['payment_address_1'] = null;
		$data['payment_address_2'] = null;
		$data['payment_city'] = null;
		$data['payment_postcode'] = null;
		$data['payment_country'] = null;
		$data['payment_country_id'] = null;
		$data['payment_zone'] = null;
		$data['payment_zone_id'] = null;
		$data['payment_address_format'] = null;
		$data['payment_method'] = null;
		$data['payment_code'] = null;
		$data['shipping_firstname'] = null;
		$data['shipping_lastname'] = null;
		$data['shipping_company'] = null;
		$data['shipping_address_1'] = null;
		$data['shipping_address_2'] = null;
		$data['shipping_city'] = null;
		$data['shipping_postcode'] = null;
		$data['shipping_country'] = null;
		$data['shipping_country_id'] = null;
		$data['shipping_zone'] = null;
		$data['shipping_zone_id'] = null;
		$data['shipping_address_format'] = null;
		$data['shipping_method'] = null;
		$data['shipping_code'] = null;
		$data['comment'] = null;
		$data['total'] = null;//$this->cart->getProducts();
		$data['affiliate_id'] = null;
		$data['commission'] = null;
		$data['marketing_id'] = null;
		$data['tracking'] = null;
		$data['language_id'] = null;
		$data['currency_id'] = null;
		$data['currency_code'] = null;
		$data['currency_value'] = null;
		$data['ip'] = null;
		$data['forwarded_ip'] = null;
		$data['user_agent'] = null;
		$data['accept_language'] = null;
		
		$this->load->model('checkout/fastorder');
        $this->model_checkout_fastorder->addOrder($data);
		$this->cart->clear();
        $this->response->setOutput($this->load->view('common/success', $data));
    }
}
