<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bill_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bill_id',
        'meter_reading_id',
        'amount',
        'created_at',
        'updated_at',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function reading()
    {
        return $this->belongsTo(MeterReading::class);
    }
}
