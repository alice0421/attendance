<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Record extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'mentor_id',
        'record_type',
        'is_remote',
        'date',
        'time',
        'error',
    ];

    /**
     * @return HasOne<Application>
     */
    public function application(): HasOne
    {
        return $this->hasOne(Application::class);
    }

    /**
     * @return BelongsTo<Mentor, Record>
     */
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(Mentor::class);
    }
}
