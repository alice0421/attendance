<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'record_id',
        'record_type',
        'date',
        'time',
        'comment',
        'is_accepted',
        'staff_id',
    ];

    /**
     * @return BelongsTo<Staff, Application>
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    /**
     * @return BelongsTo<Record, Application>
     */
    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }
}
