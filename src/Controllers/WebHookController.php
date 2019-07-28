<?php

/**
 * This file is part of the Xeviant Laravel Paystack package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @version         1.0
 *
 * @author          Olatunbosun Egberinde
 * @license         MIT Licence
 * @copyright       (c) Olatunbosun Egberinde <bosunski@gmail.com>
 *
 * @link            https://github.com/bosunski/lpaystack
 */

namespace Xeviant\LaravelPaystack\Controllers;

use Illuminate\Routing\Controller;
use Xeviant\LaravelPaystack\Model\PaystackEvent;
use Xeviant\LaravelPaystack\Request\WebHookRequest;

class WebHookController extends Controller
{
    /**
     * Handles the WebHook Request.
     *
     * @param WebHookRequest $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handleWebHook(WebHookRequest $request)
    {
        $data = $this->getFormattedPayload($request->all());

        $paystackEvent = PaystackEvent::create($data);

        event($data['event'], $paystackEvent);

        return response([], 200);
    }

    /**
     * Retrieves a formatted payload data.
     *
     * @param array $newData
     *
     * @return array
     */
    protected function getFormattedPayload(array $newData): array
    {
        $data = $newData['data'];

        return [
            'event'   => $newData['event'],
            'payload' => $data,
        ];
    }
}
