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
        return $this->getAllowedIps()->containsStrict($this->ip());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function getAllowedIps(): Collection
    {
        return collect([
            '52.31.139.75',
            '52.49.173.169',
            '52.214.14.220',
        ]);
    }
}
