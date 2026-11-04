<?php
namespace Sosupp\SlimerTenancy\Services\Landlord;

use Sosupp\SlimerTenancy\Models\Landlord\Blog;
use Sosupp\SlimDashboard\Concerns\Filters\CommonFilters;
use Sosupp\SlimDashboard\Contracts\Crudable;
use Sosupp\SlimDashboard\Concerns\Filters\WithDateFormat;

class BlogsCrudService implements Crudable
{
    use CommonFilters, WithDateFormat;

    public function make(?int $id, array $data)
    {
        return Blog::query()
        ->updateOrCreate(
            ['id' => $id],
            [
                'category_id' => $data['category'],
                'title' => $data['title'],
                'slug' => str($data['title'])->slug(),
                'content' => $data['content'],
                'summary'       => $data['summary'], 
                'source' => $data['source'],
                'contributor' => $data['contributor'],
                'keywords' => $data['keywords'],
                'image_caption' => $data['imageCaption'],
                'banner' => $data['banner'],
            ]
        );
    }

    public function one(int|string $id)
    {
        return Blog::query()
        ->where('id', $id)
        ->status(status: $this->status)
        ->first();
    }

    public function list(int|null $limit = 12, array $cols = ['*'])
    {
        return Blog::query()
        ->when($this->withTrashed, function($query){
            $query->withTrashed();
        })
        ->when(!empty($this->searchTerm), function($q){
            $q->search($this->searchTerm);
        })
        ->status(status: $this->status)
        ->dated($this->selectedDate)
        ->orderBy($this->orderByColumn, $this->orderByDirection)
        ->get($cols);
    }

    public function paginate(int|null $limit = 12, array $cols = ['*'])
    {
        return Blog::query()
        ->when($this->withTrashed, function($query){
            $query->withTrashed();
        })
        ->status(status: $this->status)
        ->dated($this->selectedDate)
        ->orderBy($this->orderByColumn, $this->orderByDirection)
        ->paginate(perPage: $limit);
    }

    public function remove(int|string $id)
    {

    }

}
