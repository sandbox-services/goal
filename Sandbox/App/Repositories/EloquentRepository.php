<?php namespace Sandbox\Repositories;


abstract class EloquentRepository {

    public function getAll($limit = null, $paginate = false, $returnQuery = false, $orderBy = null, $sortDir = 'asc')
    {
        $results = $this->model;

        if( $orderBy != null )
            $results = $results->orderBy($orderBy, $sortDir);

        if( $paginate )
            return $results->paginate($limit);

        if( isset($limit) )
            return $results->limit($limit)->get();

        if( $returnQuery )
            return $results->where('deleted_at', null);

        return $results->all();
    }

    public function getById($id, $required = true, $withTrashed = false)
    {
        $model = $this->model;

        if( $withTrashed )
            $model = $model->withTrashed();

        if( $required )
            return $model->findOrFail($id);
        else
            return $model->find($id);
    }
}