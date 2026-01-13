<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes, CommonScopes;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.tenants';


    protected $fillable = [
        'country_id', 'admin_id', 'plan_id',
        'name', 'slug', 'key', 'domain', 'subdomain',
        'db', 'schema', 'meta', 'owner', 'email', 
        'phone', 'status', 'sms', 'is_deployed', 'disabled_at',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    // relationship
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
    
}
