<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'name',
        'logo_path',
        'website_url',
        'tier',
        'order',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete logo file when the model is deleted
        static::deleting(function ($sponsor) {
            if ($sponsor->logo_path && Storage::disk('public')->exists($sponsor->logo_path)) {
                Storage::disk('public')->delete($sponsor->logo_path);
            }
        });
    }

    /**
     * Scope a query to only include active sponsors.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include sponsors for a specific year.
     */
    public function scopeForYear(Builder $query, int $year): Builder
    {
        return $query->where('year', $year);
    }

    /**
     * Accessor for full logo URL.
     */
    public function getLogoUrlAttribute(): string
    {
        return Storage::url($this->logo_path);
    }
}
