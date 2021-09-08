<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $filters = [];

    /** @var Request
     *
     */
    protected $request;
    protected $builder;

    /**
     *ThreadFilters constructor
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {

        $this->builder = $builder;

//        collect($this->getFilters())
//            ->filter(function ($value, $filter) {
//                return method_exists($this, $filter);
//            })
//            ->each(function ($value, $filter) {
//                $this->$filter($value);
//            });

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;


//        if ($this->request->has('by')) {
//            $this->by($this->request->by);
//        }
//        return $this->builder;
    }

    private function getFilters(): array
    {
        $filters = array_intersect(array_keys($this->request->all()), $this->filters);
        return $this->request->only($filters);
    }

}
