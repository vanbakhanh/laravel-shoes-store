<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $guard;
    protected $user;

    abstract public function model();

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->model(), $method], $parameters);
    }

    public function setGuard($guard = null)
    {
        $this->guard = $guard;
        $this->user = \Auth::guard($this->guard)->user();

        return $this;
    }
}
