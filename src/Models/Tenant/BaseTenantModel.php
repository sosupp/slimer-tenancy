<?php

namespace Sosupp\SlimerTenancy\Models\Tenant;

use Illuminate\Database\Eloquent\Model;

abstract class BaseTenantModel extends Model
{
    protected $connection = 'tenant';
}
