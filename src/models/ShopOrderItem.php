<?php namespace Agriya\Webshoporder;
use Eloquent;
class ShopOrderItem extends Eloquent
{
    protected $table = "shop_order_item";
    public $timestamps = false;
    protected $primarykey = 'id';
    protected $table_fields = array("id", "order_id", "item_id", "buyer_id", "item_owner_id", "item_amount", "services_amount", "total_amount", "service_ids", "	item_type", "site_commission", "seller_amount", "date_added");
}