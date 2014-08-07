<?php namespace Imade\Datatable;

use Datatable, Route;

/**
 * Class Datatable
 * @package Imade\Datatable
 */

abstract class DatatableModel {

    /**
     * Var to hold the Datatable::table() object.
     * @var object
     */
    protected $table;


    /**
     * Return data for table requested by Ajax call.
     * To be implemented by child class.
     * @return Json response
     */
    public function data()
    {
        throw new Exception('DatatableModel Exception: data() method not implemented in child Class');
    }

    /**
     * Html helper to render table and script to be placed in view
     * @return Object
     */
    public function table()
    {
        throw new Exception('DatatableModel Exception: table() method not implemented in child Class');
    }

    /**
     * Determine if there was a (ajax) request for data
     * I prefer "dataRequest" over "shouldHandle"
     * @return boolean
     */
    public function dataRequest()
    {
        return Datatable::shouldHandle();
    }

    /**
     * Returns the rendered table
     * @return string
     */
    public function render()
    {
        if( ! $this->table) $this->table = $this->table();

        return $this->table->render();
    }

    /**
     * Returns the rendered script
     * @return string
     */
    public function script()
    {
        if( ! $this->table) $this->table = $this->table();

        return $this->table->script();
    }

    /**
     * Returns the create url for this resource
     * @return string
     */
    public function routeCreate()
    {
        $action = Route::currentRouteAction();

        $controllerName = strstr($action, '@', true);

        return action($controllerName . '@create');
    }

}