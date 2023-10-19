# Laravel Nova Checklist Field

Maximus Agency are bespoke cloud software developers in Perth, Australia. You'll find more information about us [on our website](https://maximus.agency).

This package is made to allow you to easily create checklists in Laravel Nova. All you need is a text/json column on your model to store the checklist items and keep track of their status (completion).

Special thanks to *E2Consult* who made the original package for earlier versions of Nova.

## Installation

You can install the package via composer:


```bash
composer require mxms/checklist
```

## Usage


```php
use Mxms\Checklist\Checklist;

Checklist::make('Tasks')
    ->placeholder('Add another task')   // Defaults to "Add item"
    ->withPlaceholderCount()            // Not active by default
    ->logUsers()                        // Not active by default, accepts user-model column. Uses "name" when column isn't provided.
    ->showTimestamps()                  // Not active by default
    ->showItemStatusOnIndex()           // Not active by default
    ->showCompletionOnIndex(),          // Not active by default
```

To use this package you'll need a text or JSON column on you model to save the items/tasks, as they are persisted as json on your model.

### Form Pages (Create / Update)
The `->placeholder()` method allows you to specify your placeholder-text for the "add new item field".

The `->withPlaceholderCount()` method lets you show the item number when adding new item. If there is already 5 items, then it will say "Add item 6".

The `->logUsers()` method allows you to save which user created or completed the task/item. You specify which column on the User model you want to save on task, it default to use the "name" column.

You can edit an existing item by clicking on it.

### Details Page (View)

The `->showTimestamps()` method lets you show how long ago a task was completed.

### Index Page (Table Listing)

By default this package will only show the task count on the index page.

The `->showItemStatusOnIndex()` will change the index to show how many tasks are completed of the total amount of tasks/items.

The `->showCompletionOnIndex()` method will let you show how many percent of the tasks are completed.

### Optional Extra

This package also has an optional extra of allowing 'checklist templates'. 
Templates are drawn via Axios hard-coded for now. 
Follow-up work will be done to make the templates a parameter to toggle and enter the endpoint in. Feel free to submit a PR.

## License

The MIT License (MIT).