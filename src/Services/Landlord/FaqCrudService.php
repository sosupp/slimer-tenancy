<?php
namespace Sosupp\SlimerTenancy\Services\Landlord;

use Sosupp\SlimerTenancy\Models\Landlord\Faq;
use Sosupp\SlimDashboard\Concerns\Filters\CommonFilters;
use Sosupp\SlimDashboard\Contracts\Crudable;
use Sosupp\SlimDashboard\Concerns\Filters\WithDateFormat;

class FaqCrudService implements Crudable
{
    use CommonFilters, WithDateFormat;

    public function make(?int $id, array $data)
    {
        return Faq::query()
        ->updateOrCreate(
            ['id' => $id],
            $data,
        );
    }

    public function one(int|string $id) 
    { 
        return Faq::query()
        ->where('id', $id)
        ->status(status: $this->status)
        ->first();
    }

    public function list(int|null $limit = 12, array $cols = ['*'])
    {
        return Faq::query()
        ->when($this->withTrashed, function($query){
            $query->withTrashed();
        })
        ->when(!empty($this->searchTerm), function($q){
            $q->{$this->searchType}($this->searchCol, $this->searchTerm);
        })
        // ->status(status: $this->status)
        // ->dated($this->selectedDate)
        ->orderBy($this->orderByColumn, $this->orderByDirection)
        ->get($cols);
    }

    public function paginate(int|null $limit = 12, array $cols = ['*'])
    {
        return Faq::query()
        ->when($this->withTrashed, function($query){
            $query->withTrashed();
        })
        ->when(!empty($this->searchTerm), function($q){
            $q->{$this->searchType}($this->searchCol, $this->searchTerm);
        })
        // ->status(status: $this->status)
        // ->dated($this->selectedDate)
        ->orderBy($this->orderByColumn, $this->orderByDirection)
        ->paginate(perPage: $limit, columns: $cols);
    }

    public function remove(int|string $id) 
    { 

    }

}
