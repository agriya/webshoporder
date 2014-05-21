<?php namespace Agriya\Webshoporder;

use Input;
use Config;
use Validator;

class Webshoporders {

	protected $order_id;

	protected $fields_arr = array();

	protected $order_per_page = '';

	public function __construct()
	{
	}

	public function setOrderId($val)
	{
		$this->fields_arr['id'] = $val;
	}

	public function setBuyerId($val)
	{
		$this->fields_arr['buyer_id'] = $val;
	}

	public function setTotalAmount($val)
	{
		$this->fields_arr['total_amount'] = $val;
	}

	public function setSiteCommission($val)
	{
		$this->fields_arr['site_commission'] = $val;
	}

	public function setCurrency($val)
	{
		$this->fields_arr['currency'] = $val;
	}

	public function setOrderStatus($val)
	{
		$this->fields_arr['order_status'] = $val;
	}

	public function setPayKey($val)
	{
		$this->fields_arr['pay_key'] = $val;
	}

	public function setTrackingId($val)
	{
		$this->fields_arr['tracking_id'] = $val;
	}

	public function setPaymentStatus($val)
	{
		$this->fields_arr['payment_status'] = $val;
	}

	public function setPaymentResponse($val)
	{
		$this->fields_arr['payment_response'] = $val;
	}

	public function setDateCreated($val)
	{
		$this->fields_arr['date_created'] = $val;
	}

	public function setDateUpdated($val)
	{
		$this->fields_arr['date_updated'] = $val;
	}

	public function setItemOrderId($val)
	{
		$this->fields_arr['order_id'] = $val;
	}

	public function setItemId($val)
	{
		$this->fields_arr['item_id'] = $val;
	}

	public function setItemOwnerId($val)
	{
		$this->fields_arr['item_owner_id'] = $val;
	}

	public function setItemAmount($val)
	{
		$this->fields_arr['item_amount'] = $val;
	}

	public function setSellerAmount($val)
	{
		$this->fields_arr['seller_amount'] = $val;
	}

	public function setDateAdded($val)
	{
		$this->fields_arr['date_added'] = $val;
	}

	public function setOrderPagination($val)
	{
		$this->order_per_page = $val;
	}

	/**
	 * Inserts items into the order.
	 *
	 * @access   public
	 * @param    item
	 * @return   json
	 */
	public function add()
	{

		$rules = $message = array();
		$validator = Validator::make($this->fields_arr, $rules, $message);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return json_encode(array('status' => 'error', 'error_messages' => $errors));
		}
		else {
			$order_id = 0;
			if(isset($this->fields_arr['id'])) {
				$order_details = ShopOrder::Select('id')
											->whereRaw('id = ?', array($this->fields_arr['id']))
											->first();
				if(count($order_details) > 0) {
					$order_id = $order_details['id'];
				}
			}
			if($order_id > 0) {
				ShopOrder::whereRaw('id = ?', array($order_id))->update($this->fields_arr);
				return json_encode(array('status' => 'success'));
			}
			else {
				$order_id = ShopOrder::insertGetId($this->fields_arr);
				return json_encode(array('status' => 'success', 'order_id' => $order_id));
			}
		}
	}

	/**
	 * Remove an item from the order.
	 *
	 * @access   public
	 * @param    order_id
	 * @return   json
	 */
	public function remove($order_id = 0)
	{
		// Try to remove the item.
		$order = ShopOrder::whereRaw('id != ?', array(''));
		if($order_id)
			$order = $order->whereRaw('id = ?', array($order_id));
		$order = $order->delete();

		if ($order) {
			return json_encode(array('status' => 'success'));
		}
		return json_encode(array('status' => 'error', 'error_messages' => 'Order not exits'));
	}

	/**
	 * Returns the order contents.
	 *
	 * @return 		array
	 * @access 		public
	 * @throws   	Exception
	 */
	public function contents()
	{
		$order = ShopOrder::Select('id', 'user_id', 'item_id', 'item_owner_id', 'qty', 'cookie_id', 'date_added')
									->orderBy('id', 'ASC');
		if($this->order_per_page != '' && $this->order_per_page > 0)
			$order = $order->paginate($this->order_per_page);
		else
			$order = $order->get();
		return $order;
	}

	/**
	 * Inserts order items.
	 *
	 * @access   public
	 * @param    item
	 * @return   json
	 */
	public function addOrderItems()
	{
		$rules = $message = array();
		$validator = Validator::make($this->fields_arr, $rules, $message);
		if ($validator->fails()) {
			$errors = $validator->errors()->all();
			return json_encode(array('status' => 'error', 'error_messages' => $errors));
		}
		else {
			$order_item_id = ShopOrderItem::insertGetId($this->fields_arr);
			return json_encode(array('status' => 'success', 'order_item_id' => $order_item_id));
		}
	}
}
?>