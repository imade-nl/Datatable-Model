<?php namespace Imade\Datatable;

use HTML, Form, Route;
use Chumper\Datatable\Columns\BaseColumn;

class ActionsColumn extends BaseColumn {

    private $controllerName;

    function __construct()
    {
        parent::__construct('actions');

        $action = Route::currentRouteAction();
        $this->controllerName = strstr($action, '@', true);
    }


    public function run($model)
    {
        $actions = Form::open(array('action' =>  array($this->controllerName . '@destroy', $model->id), 'class' => 'pull-right'));

        $actions .= '<a class="btn btn-link btn-lg" href="'. action($this->controllerName . '@edit', array('id' => $model->id)) .'"><i class="fa fa-pencil"></i></a>';

        $actions .= '&nbsp;';

        $actions .= '<button class="btn btn-link btn-lg" type="submit"><i class="fa fa-trash-o"></i></button>';

        $actions .= Form::hidden('_method', 'DELETE');
        $actions .= Form::close();

        return $actions;
    }
}