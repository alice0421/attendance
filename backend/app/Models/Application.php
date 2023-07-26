<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
        'record_type',
        'date',
        'time',
        'comment',
        'is_accepted',
        'manager_id',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function record()
    {
        return $this->belongsTo(Record::class);
    }
}
