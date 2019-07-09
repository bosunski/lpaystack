<?php

use Illuminate\Support\Facades\Route;

Route::post(config('paystack.webhookUrl', '/paystack/hook'), '\Xeviant\LaravelPaystack\Controllers\WebHookController@handleWebHook');
