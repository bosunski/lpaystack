<?php

Route::get('/paystack/hook', '\Unicodeveloper\Paystack\Controllers\WebHookController@handleWebHook');
