## Nova Relationship Selector

[![Latest Version on Github](https://img.shields.io/github/release/eminiarts/nova-relationship-selector.svg?style=flat-square)](https://packagist.org/packages/eminiarts/nova-relationship-selector)
[![Total Downloads](https://img.shields.io/packagist/dt/eminiarts/nova-relationship-selector.svg?style=flat-square)](https://packagist.org/packages/eminiarts/nova-relationship-selector)

Display your resource's relationships with a dropdown vs endless scrolling

![image](https://user-images.githubusercontent.com/3426944/50488260-e8e3d080-0a01-11e9-8c9e-8df945a9f6ce.png)

### Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require eminiarts/nova-relationship-selector
```

### Usage

```php
use Eminiarts\RelationshipSelector\RelationshipSelector;
```
```php
public function fields()
{
    return [
        
        // ...
        
        RelationshipSelector::make('Relations')
            ->addOption('Invoices', HasMany::make('Invoices'))
            ->addOption('Notes', HasMany::make('Notes'))
            ->addOption('Contacts', HasMany::make('Contacts'))
            ->addOption('Tags', MorphToMany::make('Tags')),
        
        // ...
        
    ];
}
```

### With Select

If you want to display the Select on the right side, you can use the `->withSelect()` function.

![image](https://user-images.githubusercontent.com/3426944/50475956-96d18980-09c6-11e9-9f02-56bdaca4ada6.png)

