# Package for validation of mobile phones for Laravel

With the help of this package, you can validate a mobile phone number.

## Installation

You can install the package via composer:

``` bash
composer require aleksandro_del_piero/validate_phone
```

Publish configuration file (optional). This command will publish a configuration file in your application. After that,
you will be able to find the configuration file in the directory config/validate_phone.php:

``` bash
php artisan vendor:publish --provider="AleksandroDelPiero\ValidatePhone\ValidatePhoneServiceProvider" --tag="config"
```

## Documentation

#### Using validation form requests:

Create a validation file following the example:

```bash
php artisan make:request ValidatePhoneFormRequest
```

In the created file, edit the validation rules:

```php
    public function rules(): array
    {
        return [
            'phone' => ['validate_phone']
        ];
    }
```

or with using rule file:

```php
use AleksandroDelPiero\ValidatePhone\Rules\ValidatePhoneRule;

    public function rules(): array
    {
        return [
            'phone' => [new ValidatePhoneRule(__('validation.validate_phone'))]
        ];
    }
```

In the translation file you must add a translation that will be used when a validation error occurs (by default path:
lang/en/validation.php):

```php 
validation.php  

    return [
    ... 
     'validate_phone' => 'my custom message for phone validation',
    ...
    ]
```

#### Using validation in controller.

```php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => ['validate_phone']
        ]);
    }
```

or with using rule file:

```php 
namespace App\Http\Controllers;

use AleksandroDelPiero\ValidatePhone\Rules\ValidatePhoneRule;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => [new ValidatePhoneRule(__('validation.validate_phone'))]
        ]);
    }
```

### Change the validation rules.

If you want to change the validation rules, 
you can do this in the published configuration file along the path 'config/validate_phone.php'

```php 
return [
    'regular_expression' => '/^[\+]380(39|50|6[3|6-8]|9[1-9])[0-9]{7}$/'
];
```

After changing the configuration file, it is advisable to run the command to clear the cache:

```bash
php artisan optimize:clear
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
