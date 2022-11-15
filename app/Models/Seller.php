<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'sellers';

    protected $fillable = [
        'id',
        'admin',
        'priority',
        'seller_id',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
