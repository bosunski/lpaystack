<?php

namespace Unicodeveloper\Paystack\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class WebHookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->getAllowedIps()->containsStrict($this->ip()) && $this->hasValidSignature();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required',
            'event' => 'required',
        ];
    }

    protected function getAllowedIps(): Collection
    {
        $allowed = collect([
            '52.31.139.75',
            '52.49.173.169',
            '52.214.14.220',
        ]);

        return app()->environment() === "local" ? $allowed->merge(['127.0.0.1']) : $allowed;
    }

    protected function hasValidSignature(): bool
    {
        return $this->hasHeader('X-Paystack-Signature') && $this->signatureMatches();
    }

    protected function signatureMatches(): bool
    {
        return app()->environment() === "local" ? true :
            $this->header('X-Paystack-Signature') === hash_hmac('sha512', app('paystack')->getConnectionConfig()['secretKey'], '');
    }
}
