<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Sosupp\SlimDashboard\Concerns\Filters\CommonScopes;

class Landlord extends Authenticatable
{
    use HasFactory, Notifiable,
        SoftDeletes, CommonScopes;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.landlords';

    protected $fillable = [
        'role_id', 'name', 'email', 'phone',
        'password', 'type', 'status', 'logged_in',
        'telegram_id', 'telegram_token', 'default_pass_reset_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'telegram_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




}
