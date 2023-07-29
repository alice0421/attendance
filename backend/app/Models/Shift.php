<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shift extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'mentor_id',
        'work_type',
        'date',
        'start_time',
        'end_time',
    ];

    /**
     * @return BelongsTo<Mentor, Shift>
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }
}
