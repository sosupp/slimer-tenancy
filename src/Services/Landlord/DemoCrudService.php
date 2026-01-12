<?php
namespace Sosupp\SlimerTenancy\Services\Landlord;

use Sosupp\SlimDashboard\Contracts\Crudable;
use Sosupp\SlimerTenancy\Models\Landlord\DemoAccount;
use Sosupp\SlimDashboard\Concerns\Filters\CommonFilters;
use Sosupp\SlimDashboard\Concerns\Filters\WithDateFormat;

class DemoCrudService implements Crudable
{
    use CommonFilters, WithDateFormat;

    public function make(?int $id, array $data)
    {
        return DemoAccount::query()
        ->updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'admin_id' => auth(guard: 'landlord')->user()->id ?? null,
                'slug' => str($data['name'])->slug(),
                'domain' => $data['domain'] ?? null,
                'subdomain' => $data['subdomain'] ?? null,
                'db' => $data['db'] ?? null,
                'schema' => $data['schema'] ?? null,
                'meta' => $data['meta'] ?? null,
                'owner' => $data['owner'] ?? null,
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'status' => $data['status'] ?? 'active',
                'disabled_at' => $data['disabledDate'] ?? null,
                'is_deployed' => $data['deployed'] ?? false,
            ]
        );
    }

    public function one(int|string $id)
    {
        return DemoAccount::query()
        ->where('id', $id)
        ->status(status: $this->status)
        ->first();
    }

    public function list(int|null $limit = 12, array $cols = ['*'])
    {
        return DemoAccount::query()
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
        return DemoAccount::query()
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
