<?php

namespace Sosupp\SlimerTenancy\Models\Landlord;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';   // <— IMPORTANT
    protected $table = 'landlord.categories';

    protected $fillable = [];

    // relationships
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class);
    }



}
