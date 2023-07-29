<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentor_id',
        'work_type',
        'date',
        'start_time',
        'end_time',
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
