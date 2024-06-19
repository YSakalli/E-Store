<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Custom\Models\Order;
class Orders extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id'); // Burada orders_id yerine order_id kullanılıyor
    }
}
