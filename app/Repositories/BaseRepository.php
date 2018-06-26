<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    protected $app;
    protected $guards;
    protected $user;

    public function __construct()
    {
        $this->app = new App();
        $this->makeModel();
    }

    /**
     * to call relationship in model
     *
     * @return relationship
    */
    public function __call($method, $args)
    {
        $model = $this->model;

        if ($method == head($args)) {
            $this->model = call_user_func_array([$model, $method], array_diff($args, [head($args)]));

            return $this;
        }

        if (!$model instanceof Model) {
            $model = $model->first();
            if (!$model) {
                throw new ModelNotFoundException();
            }
        }

        $this->model = call_user_func_array([$model, $method], $args);
        
        return $this;
    }

    /**
     * to call eager loading
     *
     * @return collection
    */
    public function __get($name)
    {
        $model = $this->model;

        if (!$model instanceof Model) {
            $model = $model->first();
            if (!$model) {
                throw new ModelNotFoundException();
            }
        }

        return $model->$name;
    }

    abstract public function model();

    public function setGuard($guard = null)
    {
        $this->guard = $guard;
        $this->user = Auth::guard($this->guard)->user();

        return $this;
    }

    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * function all to get all data of model.
     *
     * @return void
    */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * to get columns that delete used soft delete.
     *
     * @return void
    */
    public function withTrashed()
    {
        $this->model = $this->model->withTrashed();

        return $this;
    }

    /**
    * to get column that delete used soft delete.
     *
     * @return void
    */
    public function onlyTrashed()
    {
        $this->model = $this->model->onlyTrashed();

        return $this;
    }

    /**
     * to get lists columns.
     *
     * @return void
    */
    public function lists($column, $key = null)
    {
        $model = $this->model->pluck($column, $key);
        $this->makeModel();

        return $model;
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = $limit ?: config('setting.paginate');
        $model = $this->model->paginate($limit, $columns);
        $this->makeModel();

        return $model;
    }

    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findOrFail($id, $columns = ['*'])
    {
        try {
            $model = $this->model->findOrFail($id, $columns);
            $this->makeModel();

            return $model;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function whereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];
        $this->model = $this->model->whereIn($column, $values);

        return $this;
    }

    public function orWhere($column, $operator = null, $value = null)
    {
        $this->model = $this->model->orWhere($column, $operator, $value);

        return $this;
    }

    public function orWhereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];
        $this->model = $this->model->orWhereIn($column, $values);

        return $this;
    }

    public function where($conditions, $operator = null, $value = null)
    {
        $this->model = $this->model->where($conditions, $operator, $value);

        return $this;
    }

    public function whereBetween($colunm, $values)
    {
        $this->model = $this->model->whereBetween($colunm, $values);

        return $this;
    }

    public function whereNotIn($colunm, $values)
    {
        $this->model = $this->model->whereNotIn($colunm, $values);

        return $this;
    }

    public function whereNull($colunm)
    {
        $this->model = $this->model->whereNull($colunm);

        return $this;
    }

    public function whereNotNull($colunm)
    {
        $this->model = $this->model->whereNotNull($colunm);

        return $this;
    }

    public function whereHas($relationships, $function)
    {
        $this->model = $this->model->whereHas($relationships, $function);

        return $this;
    }

    public function insertGetId($input)
    {
        return $this->model->insertGetId($input);
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function firstOrCreate($input)
    {
        return $this->model->firstOrCreate($input);
    }

    public function multiCreate($input)
    {
        return $this->model->insert($input);
    }

    public function update($id, $input)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    public function multiUpdate($column, $value, $input)
    {
        $value = is_array($value) ? $value : [$value];

        return $this->model->whereIn($column, $value)->update($input);
    }

    public function delete($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        return $this->model->whereIn('id', $ids)->delete();
    }

    public function forceDelete($ids)
    {
        $ids = is_array($ids) ? $ids : [$ids];

        return $this->model->whereIn('id', $ids)->forceDelete();
    }

    public function orderBy($column, $option = 'asc')
    {
        $model = $this->model->orderBy($column, $option);
        $this->makeModel();

        return $model;
    }

    public function join($tableName, $tableColumn, $modelColumn, $option = '')
    {
        switch ($option) {
            case 'leftJoin':
                $this->model = $this->model->leftJoin($tableName, $tableColumn, $modelColumn);
                break;
            case 'rightJoin':
                $this->model = $this->model->rightJoin($tableName, $tableColumn, $modelColumn);
                break;
            default:
                $this->model = $this->model->join($tableName, $tableColumn, $modelColumn);
        }

        return $this;
    }

    public function groupBy($colunms)
    {
        $colunms = is_array($colunms) ? $colunms : [$colunms];

        return $this->model->groupBy($colunms);
    }

    public function count()
    {
        $model = $this->model->count();
        $this->makeModel();

        return $model;
    }

    public function first($columns = ['*'])
    {
        $model = $this->model->first($columns);
        $this->makeModel();

        return $model;
    }

    public function with($relationships)
    {
        if (is_string($relationships)) {
            $relationships = func_get_args();
        }

        $this->model = $this->model->with($relationships);

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function get()
    {
        $model = $this->model->get();
        $this->makeModel();
        return $model;
    }

    public function exists($column, $input)
    {
        return $this->model->where($column, $input)->exists();
    }

    public function select($columns = ['*'])
    {
        $columns = is_array($columns) ? $columns : func_get_args();
        $this->model = $this->model->select($columns);

        return $this;
    }

    public function createByRelationship($method, $inputs, $option = false)
    {
        $inputs = is_array($inputs) ? $inputs : [$inputs];

        if (!empty($inputs['model'])) {
            $this->model = $inputs['model'];
            $inputs = array_except($inputs, ['model']);
        }

        if (empty($inputs['attribute'])) {
            throw new Exception('No input field to create model');
        }

        $this->__call($method, []);

        return !$option
            ? $this->model->create($inputs['attribute'])
            : $this->model->createMany($inputs['attribute']);
    }

    public function checkLike($model, $userId)
    {
        return $model->withTrashed()->whereHas('likes', function ($query) use ($userId) {
            $query->withTrashed()->where('user_id', $userId);
        })->get()->pluck('id');
    }

    public function take($limit)
    {
        $this->model = $this->model->take($limit);

        return $this;
    }

    public function inRandomOrder()
    {
        $this->model = $this->model->inRandomOrder();

        return $this;
    }
    
    public function pluck($column, $key = null)
    {
        $model = $this->model->pluck($column, $key);
        $this->makeModel();
        
        return $model;
    }
}