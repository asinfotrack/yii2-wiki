# yii2-wiki
Yii2-Wiki is a flexible implementation of a wiki for Yii2
 - can implement own layout
 - can use rules for access control

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require asinfotrack/yii2-wiki
```

or add

```
"asinfotrack/yii2-wiki": "dev-master"
```

to the `require` section of your `composer.json` file.


## Configuration

###### Migration
For the default table structure execute the provided migration as follows:

	yii migrate --migrationPath=@vendor/asinfotrack/yii2-wiki/migrations

To remove the table just do the same migration downwards.

###### Configuring the module
add the following entry to the modules-part of your config-file:

```php
//...

'modules'=>[
	'wiki'=>[
		'class'=>'asinfotrack\yii2\wiki\Module',
		'processContentCallback'=>function($content) {
			//example if you want to use markdown in your wiki
			return Parsedown::instance()->parse($content);
		},
		//example for implementing other layout
        'layout' =>  '@layout',
        'viewMap' => [
            'admin'=>'@vendor/ea/eablankonthema/wiki_views/content/admin',
            'view'=>'@vendor/ea/eablankonthema/wiki_views/content/view',
            'create'=>'@vendor/ea/eablankonthema/wiki_views/content/create',
            'update'=>'@vendor/ea/eablankonthema/wiki_views/content/update',
        ],

        'rolesCanEdit' => ['WikiEdit'],
        'rolesCanView' => ['@']
	],
],

//...
```

For a full list of possible options check out the well documented attributes of the module-class.

###### Bootstrapping the module
This step is only necessary if you want to use the deafault url-rules provided by the module.  
If you want to use this feature, add the module-id to the bootstrap-array of your config file:

```php
//...

'bootstrap'=>['log', 'wiki'],

//...

```
