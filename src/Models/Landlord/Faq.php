<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Faq extends Model
{
    use SoftDeletes;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.faqs';

    protected $fillable = [
        'question', 'answer',
        'slug', 'category',
        'views', 'clicks', 'extra'
    ];

    protected $casts = [
        'extra' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Faq $faq) {
            if ($faq->isDirty('question') || empty($faq->slug)) {
                $faq->slug = static::generateUniqueSlug($faq->question, $faq->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $question, ?int $ignoreId = null): string
    {
        $base = Str::slug($question);
        $slug = $base;
        $i = 1;

        while (
            static::withTrashed()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
