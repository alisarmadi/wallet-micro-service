<?php

namespace App\Repositories\MySql;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected Model $model;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model
            ->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function update(array $data, $id): Model
    {
        $item = $this->findById($id);
        if (isset($item->id)){
            $item->update($data);
        }
        return $item;
    }

    /**
     * @param $id
     * @return Model
     */
    public function delete($id): Model
    {
        $item = $this->findById($id);
        if (isset($item->id)){
            $item->delete();
        }
        return $item;
    }

    /**
     * @param $id
     * @return Model
     */
    public function findById($id): Model
    {
        return $this->model
            ->where('_id', $id)
            ->first();
    }

    public function createMany($items)
    {
        foreach ($items as $key => $item) {
            $items[$key]['created_at'] = Carbon::now();
            $items[$key]['updated_at'] = Carbon::now();
        }
        $this->model->raw(function ($collection) use ($items) {
            return $collection->insertMany($items);
        });
    }
}
