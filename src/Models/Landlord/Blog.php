<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;
use Sosupp\SlimDashboard\Concerns\HasCustomRouteBinding;

class Blog extends Model
{
    use HasFactory, SoftDeletes, CommonScopes, HasCustomRouteBinding;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.blogs';

    protected $fillable = [
        'category_id',
        'admin_id',
        'title',
        'slug',
        'content',
        'status',
        'source',
        'contributor',
        'views',
        'summary',
        'keywords',
        'banner',
        'image_caption',
    ];

    // relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
