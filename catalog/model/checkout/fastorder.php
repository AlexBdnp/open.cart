<?php
class ModelCheckoutFastorder extends Model {
	
	public $products = null;

	public function addOrder($data) {
		$this->products = $this->cart->getProducts();
		$total = 0;
		foreach($this->products as $product) {
			$total += $product['total'];
		}
		$q = "INSERT INTO `" . DB_PREFIX . "order` SET telephone ='" . $this->db->escape($data['telephone']) . "', total = '$total', firstname = 'Новый', lastname = 'Клиент', comment = 'Быстрый заказ', order_status_id = 1, currency_id = '2', currency_code = 'USD', date_added = NOW(), date_modified = NOW()";
		$query = $this->db->query($q);
		//echo $q . "\n\n<br><br>";
		$order_id = $this->db->getLastId();
		$this->addOrderHistory($order_id, 1);
		$this->addOrderProduct($order_id);
		$this->addOrderTotal($order_id);
    }

	public function addOrderHistory($order_id, $order_status_id, $comment = '', $notify = false, $override = false) {
		$q = "INSERT INTO `" . DB_PREFIX . "order_history` SET order_id = $order_id, order_status_id = $order_status_id";
		//echo $q . "\n\n<br><br>";
		$query = $this->db->query($q);
	}
	
    public function addOrderProduct($order_id) {

		foreach($this->products as $product) {
			$product_id = $product['product_id'];
			$name = $product['name'];
			$model = $product['model'];
			$quantity = $product['quantity'];
			$price = $product['price'];
			$total = $product['total'];
			$tax = 0;
			$reward = 0;

			$q = "INSERT INTO `" . DB_PREFIX . "order_product` SET order_id = $order_id, product_id = $product_id, name = `$name`, model = `$model`, quantity = $quantity, price = $price, total = $total, tax = $tax, reward = $reward";
			$q = "INSERT INTO `" . DB_PREFIX . "order_product` (`order_product_id`, `order_id`, `product_id`, `name`, `model`, `quantity`, `price`, `total`, `tax`, `reward`) VALUES (NULL, '$order_id', '$product_id', '$name', '$model', '$quantity', '$price', '$total', '$tax', '$reward');";
			//echo $q . "\n<br>";
			$query = $this->db->query($q);
		}
		//echo "\n<br>";
	}

	public function addOrderTotal($order_id) {
		// $results = $this->model_setting_extension->getExtensions('total');
		
		$total = 0;
		foreach($this->products as $product) {
			$total += $product['total'];
		}
		$q = "INSERT INTO `" . DB_PREFIX . "order_total` SET order_id = $order_id, code = 'total', title = 'Total', value = $total, sort_order = 9";
		//echo $q . "\n<br>";
		$query = $this->db->query($q);
	}
	
}