<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'stores';

    protected $fillable = [
        'id',
        'name',
        'status',
        'url',
        'whatsapp',
        'facebook',
        'instagram',
        'file_id',
    ];
}
