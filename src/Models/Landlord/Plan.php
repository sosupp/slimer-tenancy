<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;

class Plan extends Model
{
    use HasFactory, SoftDeletes, CommonScopes;

    protected $fillable = [
        'name', 'description', 'price', 'status', 'features',
        'admin_id'
    ];

    protected $casts = [
        'features' => 'array',
    ];

    // relationships
    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }


}
