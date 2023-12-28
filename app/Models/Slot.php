<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
    ];

    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    protected function formattedTime(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) =>
                Carbon::parse($attributes['start'])->format('H:i') . ' - ' .
                Carbon::parse($attributes['end'])->format('H:i')
        );
    }
}
