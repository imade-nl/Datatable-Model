Datatable Model
===============

A dedicated class (model) to configure Chumper's Datatable package for Laravel (https://github.com/Chumper/Datatable) to keep your controllers as clean as possible.


##Example

Your Userscontroller:

```php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$table = new UserDatatable();

		if($table->dataRequest()) return $table->data();

		return View::make('resource.index')->withTable($table);
	}
}

```

Dedicated UserDatatable.
This class is required to extend "Imade\Datatable\DatatableModel".
The two methods "data" and "table" are required.

```php

	use Imade\Datatable\DatatableModel;

	class UserDatatable extends DatatableModel
	{
		public $columns = array(
			'id' => '#',
			'name' => 'Naam',
			'email' => 'E-mail'
		);


		public function data()
		{
			$query = User::select( array_keys($this->columns) );

			return Datatable::query($query)
				->showColumns( array_keys($this->columns) )
				->make();
		}


		public function table()
		{
			return Datatable::table()
				->addColumn( array_values($this->columns) );
		}
	}

```

##Install

1. Install Datatable on: https://github.com/Chumper/Datatable
2. Require Imade/Datatable in your composer.json:

```php
	"imade/datatable-model": "dev-master"
```
