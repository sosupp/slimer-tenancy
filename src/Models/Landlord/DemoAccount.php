<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;

class DemoAccount extends Model
{
    use HasFactory, Notifiable, CommonScopes, SoftDeletes;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.demo_accounts';

    protected $guarded = [];

}
