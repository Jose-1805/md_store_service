<?php

namespace App\Http\Requests;

use App\Rules\OkApiGatewayResponse;
use Illuminate\Foundation\Http\FormRequest;

class ToggleSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'store' => 'required|exists:stores,id',
            'seller' => ['required', new OkApiGatewayResponse('/api/seller')]
        ];
    }

    public function attributes()
    {
        return [
            'store' => 'tienda',
            'seller' => 'vendedor',
        ];
    }
}
