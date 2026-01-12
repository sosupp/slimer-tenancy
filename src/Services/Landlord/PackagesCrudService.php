<?php
namespace Sosupp\SlimerTenancy\Services\Landlord;

use Sosupp\SlimDashboard\Contracts\Crudable;
use Sosupp\SlimerTenancy\Models\Landlord\Plan;
use Sosupp\SlimDashboard\Concerns\Filters\CommonFilters;
use Sosupp\SlimDashboard\Concerns\Filters\WithDateFormat;

class PackagesCrudService implements Crudable
{
    use CommonFilters, WithDateFormat;

    public function make(?int $id, array $data)
    {
        return Plan::query()
        ->updateOrCreate(
            [
                'id' => $id
            ],
            [
                'name' => $data['name'],
                'admin_id' => auth(guard: 'landlord')->user()->id ?? null,
                'slug' => str($data['name'])->slug(),
                'description' => $data['description'] ?? null,
                'price' => $data['price'],
                'status' => $data['status'] ?? 'active',
                'features' => $data['subdomain'] ?? null,
            ]
        );
    }


    public function one(int|string $id)
    {
        return Plan::query()
        ->where('id', $id)
        ->status(status: $this->status)
        ->first();
    }

    public function list(int|null $limit = 12, array $cols = ['*'])
    {
        return Plan::query()
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
        return Plan::query()
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
