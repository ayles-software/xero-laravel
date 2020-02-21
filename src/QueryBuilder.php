<?php

namespace AylesSoftware\XeroLaravel;

use XeroPHP\Exception;
use XeroPHP\Application;
use XeroPHP\Remote\Query;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Arrayable;
use XeroPHP\Remote\Exception\NotFoundException;

class QueryBuilder
{
    /**
     * The original Xero PHP Query object.
     *
     * @var Query
     */
    private $query;

    /**
     * The Xero app object.
     *
     * @var Query
     */
    private $app;

    /**
     * Builds a QueryWrapper around a Query object.
     *
     * @param Query $query
     * @param Application $app
     */
    public function __construct(Query $query, Application $app)
    {
        $this->query = $query;
        $this->app = $app;
    }

    /**
     * Pass through any undefined methods to the wrapped Query object.
     * If the response is another Query object, assign it to the wrapper
     * and return it, otherwise, just return it.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $returnValue = call_user_func_array([$this->query, $name], $arguments);

        if ($returnValue instanceof Query) {
            $this->query = $returnValue;

            return $this;
        }

        return $returnValue;
    }

    /**
     * Runs the query's execute method and returns the result
     * as a Laravel collection.
     *
     * @return Collection
     */
    public function get()
    {
        return collect($this->query->execute());
    }

    /**
     * Returns the first element of the retrieved collection.
     *
     * @return mixed
     */
    public function first()
    {
        return $this->get()->first();
    }

    /**
     * Retrieves a Xero model if passed a single GUID.
     * Retrieves a collection of Xero models if passed an array or collection of GUIDs.
     *
     * @param string|array|Collection $guid
     * @return null|\XeroPHP\Remote\Collection|\XeroPHP\Remote\Model
     * @throws Exception
     * @throws NotFoundException
     */
    public function find($guid)
    {
        if ($guid instanceof Arrayable) {
            return collect($this->app->loadByGUIDs($this->getClass(), implode(',', (array) $guid)));
        }

        return $this->app->loadByGUID($this->getClass(), $guid);
    }

    /**
     * Get the Xero class (Contact, Invoice, etc.) that the
     * wrapped query object is using.
     *
     * @return string
     */
    private function getClass()
    {
        return $this->query->getFrom();
    }
}
