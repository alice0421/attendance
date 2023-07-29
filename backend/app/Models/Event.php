<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
    ];

    /**
     * @return BelongsToMany<Mentor>
     */
    public function mentors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class);
    }
}
