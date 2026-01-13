<?php
namespace Sosupp\SlimerTenancy\Services\Landlord;

use Illuminate\Support\Facades\Hash;
use Sosupp\SlimDashboard\Contracts\Crudable;
use Sosupp\SlimDashboard\Concerns\GeneratePassword;
use Sosupp\SlimDashboard\Concerns\Filters\CommonFilters;
use Sosupp\SlimDashboard\Concerns\Filters\WithDateFormat;
use Sosupp\SlimerTenancy\Events\Landlord\LandlordCreated;

class LandlordCrudService implements Crudable
{
    use CommonFilters, WithDateFormat, GeneratePassword;

    protected $landlordAdmin;

    public function __construct()
    {
        $this->landlordAdmin = config('slimertenancy.landlord.model');
    }

    public function make(?int $id, array $data, $testUser = false)
    {

        $password = config('app.env') === 'local'
            ? 'password' : $this->randomPass();

        if($testUser){
            $password = 'password';
        }

        $cryptPassword =  Hash::make($password);

        $standardCols = [
            'role_id' => $data['role'] ?? null,
            'type' => $data['adminType'] ?? null,
            'name' => $data['name'] ?? '',
            'phone' => $data['phone'],
        ];

        $addColumn = [
            'password' => $cryptPassword,
        ];

        $useColumns = $standardCols + $addColumn;

        $admin = $this->landlordAdmin::query()
        ->updateOrCreate(
            ['email' => $data['email']],
            $id == null ? $useColumns : $standardCols
        );

        if(is_null($id)){
            event(new LandlordCreated(
                $id,
                $admin,
                $password,
            ));
        }

        return $admin;


    }


    public function one(int|string $id)
    {
        return $this->landlordAdmin::query()
        ->where('id', $id)
        ->status(status: $this->status)
        ->first();
    }

    public function list(int|null $limit = 12, array $cols = ['*'])
    {
        return $this->landlordAdmin::query()
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
        return $this->landlordAdmin::query()
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
