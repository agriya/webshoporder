<?php namespace Agriya\Webshoporder;
use Eloquent;
class ShopOrder extends Eloquent
{
    protected $table = "shop_order";
    public $timestamps = false;
    protected $primarykey = 'id';
    protected $table_fields = array("id", "buyer_id", "total_amount", "site_commission", "currency", "order_status", "pay_key", "tracking_id", "payment_status", "payment_response", "date_created", "date_updated");
}