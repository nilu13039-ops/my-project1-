<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'table_id', 'reservation_date', 'reservation_time', 'guests_count', 'status', 'notes'];

    protected function casts(): array
    {
        return [
            'reservation_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
