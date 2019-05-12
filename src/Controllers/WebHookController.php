<?php

namespace Unicodeveloper\Paystack\Controllers;

use Illuminate\Routing\Controller;
use Unicodeveloper\Model\PaystackEvent;
use Unicodeveloper\Paystack\Request\WebHookRequest;

class WebHookController extends Controller
{
    public function handleWebHook(WebHookRequest $request)
    {
        $data = $this->getFormattedPayload($request->all());

        PaystackEvent::create($data);

        event($data['event']);

        return response([], 200);
    }

    protected function getFormattedPayload(array $newData): array
    {
        $data = $newData['data'];

        return [
            'event'  => $newData['event'],
            'payload' => $data,
        ];
    }
}
