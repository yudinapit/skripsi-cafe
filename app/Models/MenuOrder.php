<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuOrder extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tables()
    {
        return $this->belongsTo(Table::class);
    }

    public function menuOrderDetail()
    {
        return $this->hasMany(MenuOrderDetail::class, 'menu_orders_id', 'id');
    }
}
