<?php

Route::post('/paystack/hook', '\Unicodeveloper\Paystack\Controllers\WebHookController@handleWebHook');
