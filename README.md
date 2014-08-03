Datatable Model
===============

A dedicated class (model) to configure the excelent Datatable package (https://github.com/Chumper/Datatable) to keep your controllers as clean as possible.


##Example

Your Userscontroller:

```php
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
```

Dedicated UserDatatable:
This class is required to extend "Imade\Datatable\DatatableModel".

```php
	use Imade\Datatable\DatatableModel;

	class ClientDatatable extends DatatableModel
	{
		public $columns = array(
			'id' => '#',
			'name' => 'Naam',
			'email' => 'E-mail',
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
	"imade/datatable": "dev-master"
```

3. Add the serviceprovider to your config/app.php

```php
	// providers array:
    'Imade\Datatable\DatatableServiceProvider',
```
