<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'datetime', 'weight', 'dimensions',
        'from_address', 'to_address', 'cargo_type',
        'status', 'needs_disposal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function getCargoTypeNameAttribute()
    {
        $types = [
            'fragile' => 'Хрупкое',
            'perishable' => 'Скоропортящееся',
            'refrigerated' => 'Требуется рефрижератор',
            'animals' => 'Животные',
            'liquid' => 'Жидкость',
            'furniture' => 'Мебель',
            'garbage' => 'Мусор',
        ];

        return $types[$this->cargo_type] ?? $this->cargo_type;
    }

    public function getStatusNameAttribute()
    {
        $statuses = [
            'new' => 'Новая',
            'in_progress' => 'В работе',
            'completed' => 'Выполнено',
            'canceled' => 'Отменена',
        ];

        return $statuses[$this->status] ?? $this->status;
    }
}
