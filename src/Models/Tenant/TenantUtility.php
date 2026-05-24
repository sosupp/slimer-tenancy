<?php

namespace Sosupp\SlimerTenancy\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;

class TenantUtility extends Model
{
    use HasFactory, CommonScopes;

    protected $fillable = [
        'name', 'value', 'slug', 'status', 'data'
    ];
}
