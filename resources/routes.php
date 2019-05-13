<?php

use Illuminate\Support\Facades\Route;

Route::post(config('paystack.webhookUrl', '/paystack/hook'), '\Unicodeveloper\Paystack\Controllers\WebHookController@handleWebHook');
