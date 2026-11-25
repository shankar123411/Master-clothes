<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'order_id',
        'customer_name',
        'business_name',
        'phone',
        'location',
        'grand_total',
        'items_json',
    ];

    protected $casts = [
        'items_json' => 'array',
    ];

    protected $appends = [
        'items',
        'customer_id',
    ];

    public function setCustomerIdAttribute($value)
    {
        // Virtual attribute - never write to DB column
    }

    public function getCustomerIdAttribute()
    {
        if (isset($this->attributes['customer_id']) && !empty($this->attributes['customer_id'])) {
            return (int)$this->attributes['customer_id'];
        }
        if (!empty($this->phone)) {
            $id = Customer::where('phone', $this->phone)->value('id');
            if ($id) return (int)$id;
        }
        if (!empty($this->customer_name)) {
            $id = Customer::where('name', $this->customer_name)->value('id');
            if ($id) return (int)$id;
        }
        if (!empty($this->business_name)) {
            $id = Customer::where('business_name', $this->business_name)->value('id');
            if ($id) return (int)$id;
        }
        return null;
    }

    public function getItemsAttribute()
    {
        if (is_array($this->items_json)) {
            return $this->items_json;
        }
        if (is_string($this->items_json)) {
            return json_decode($this->items_json, true) ?? [];
        }
        return [];
    }

    public function setItemsAttribute($value)
    {
        $this->attributes['items_json'] = is_array($value) ? json_encode($value) : $value;
    }

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->order_id)) {
                $maxId = static::max('id') ?: 0;
                $order->order_id = 'NA-' . (1001 + $maxId);
            }
        });
    }
}
