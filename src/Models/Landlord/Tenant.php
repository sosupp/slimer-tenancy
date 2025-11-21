<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes, CommonScopes;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.tenants';


    protected $fillable = [
        'name', 'slug', 'domain', 'key', 'subdomain',
        'db', 'schema', 'meta', 'disabled_at',
        'owner', 'email', 'phone', 'status', 'is_deployed'
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
