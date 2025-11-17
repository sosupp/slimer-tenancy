<?php
namespace Sosupp\SlimerTenancy\Services\Tenant;

use Sosupp\SlimDashboard\Contracts\Crudable;
use Sosupp\SlimerTenancy\Models\Landlord\Tenant;
use Sosupp\SlimDashboard\Concerns\Filters\CommonFilters;
use Sosupp\SlimDashboard\Concerns\Filters\WithDateFormat;

class TenantCrudService implements Crudable
{
    use CommonFilters, WithDateFormat;

    public function make(?int $id, array $data)
    {
        return Tenant::query()
        ->updateOrCreate(
            [
                'name' => $data['name']
            ],
            [
                'slug' => str($data['name'])->slug(),
                'domain' => $data['domain'] ?? null,
                'db' => $data['db'] ?? null,
                'schema' => $data['schema'] ?? null,
                'meta' => $data['meta'] ?? null,
                'owner' => $data['owner'] ?? null,
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'] ?? 'active',
                'disabled_at' => $data['disabledDate'] ?? null,
            ]
        );
    }

    public function one(int|string $id)
    {
        return Tenant::query()
        ->where('id', $id)
        ->status(status: $this->status)
        ->first();
    }

    public function list(int|null $limit = 12, array $cols = ['*'])
    {
        return Tenant::query()
        ->when($this->withTrashed, function($query){
            $query->withTrashed();
        })
        ->when(!empty($this->searchTerm), function($q){
            $q->{$this->searchType}($this->searchCol, $this->searchTerm);
        })
        ->status(status: $this->status)
        ->dated($this->selectedDate)
        ->orderBy($this->orderByColumn, $this->orderByDirection)
        ->get($cols);
    }

    public function paginate(int|null $limit = 12, array $cols = ['*'])
    {
        return Tenant::query()
        ->when($this->withTrashed, function($query){
            $query->withTrashed();
        })
        ->when(!empty($this->searchTerm), function($q){
            $q->{$this->searchType}($this->searchCol, $this->searchTerm);
        })
        ->status(status: $this->status)
        ->dated($this->selectedDate)
        ->orderBy($this->orderByColumn, $this->orderByDirection)
        ->paginate(perPage: $limit, columns: $cols);
    }

    public function remove(int|string $id)
    {

    }

}
