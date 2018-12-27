# Laravel Nova - Relationship Selector

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require eminiarts/nova-relationship-selector
```

## Usage

### Relationship Selector

![image](https://user-images.githubusercontent.com/3426944/50475996-b4065800-09c6-11e9-9a25-6754260f2545.png)

![image](https://user-images.githubusercontent.com/29180903/50483856-98e21b00-09bb-11e9-9a1b-677204bc44a4.png)

You can group Relations of a Resource.

```php
// in app/Nova/Resource.php

use Eminiarts\RelationshipSelector\RelationshipSelector;

public function fields()
{
    return [
        
        // ...
        
        RelationshipSelector::make('Relations')
            ->addOption(__('Invoices'), HasMany::make('Invoices'))
            ->addOption(__('Notes'), HasMany::make('Notes'))
            ->addOption(__('Contacts'), HasMany::make('Contacts'))
            ->addOption(__('Tags'), MorphToMany::make('Tags'))
        ,
        
        // ...
        
    ];
}
```

### With Select

If you want to display the Select on the right side, you can use the `->withSelect()` function.

![image](https://user-images.githubusercontent.com/3426944/50475956-96d18980-09c6-11e9-9f02-56bdaca4ada6.png)
 
```php
// in app/Nova/Resource.php

use Eminiarts\RelationshipSelector\RelationshipSelector;

public function fields()
{
    return [
        
        // ...
        
        RelationshipSelector::make('Relations')
            ->addOption(__('Invoices'), HasMany::make('Invoices'))
            ->addOption(__('Notes'), HasMany::make('Notes'))
            ->addOption(__('Contacts'), HasMany::make('Contacts'))
            ->addOption(__('Tags'), MorphToMany::make('Tags'))
            ->withSelect()
        ,
        
        // ...
        
    ];
}

```

