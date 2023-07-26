<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'record_type',
        'is_remote',
        'date',
        'time',
        'error',
    ];

    public function application()
    {
        return $this->hasOne(Application::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
