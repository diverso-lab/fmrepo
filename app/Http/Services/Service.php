<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Service
{

    protected string $model;
    protected array $validation_rules;
    protected Request $request;

    public function __construct($model)
    {
        $this->model = $model;
        $this->request = Request::capture();
    }

    public function validate()
    {
        $validator = Validator::make($this->request->all(), $this->validation_rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    protected function set_validation_rules($array)
    {
        $this->validation_rules = $array;
    }

    public function create($array)
    {
        $this->validate();
        return $this->model::create($array);
    }

    public function update($id,$array)
    {
        $this->validate();
        return $this->model::where('id', $id)->update($array);
    }

    public function delete($id)
    {
        $entity = $this->model::find($id);
        $entity->delete();
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function find_or_fail($id)
    {
        return $this->model::findOrFail($id);
    }

    public function find_by($array)
    {
        return $this->model::where($array)->first();
    }

    public function find_all_by($array)
    {
        return $this->model::where($array)->get();
    }

    public function all()
    {
        return $this->model::all();
    }

}
