<?php

namespace AleksandroDelPiero\ValidatePhone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


class ValidatePhoneServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'validate_phone');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('validate_phone.php'),
        ], 'config');

        $this->registerValidatorExtends();
    }

    protected function registerValidatorExtends(): void
    {
        Validator::extend('validate_phone', function ($attribute, $value, $parameters, $validator) {
            $regularExpression = config('validate_phone.regular_expression');

            preg_match($regularExpression, $value, $matches);

            return count($matches) !== 0;
        });
    }
}
