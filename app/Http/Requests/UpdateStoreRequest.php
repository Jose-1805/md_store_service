<?php

namespace App\Http\Requests;

use App\Rules\OkApiGatewayResponse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'name' => 'required|unique:stores,name,'.$this->store->id.',id|string|max:100',
            'status' => 'required|in:0,1',
            'url' => 'required|unique:stores,url,'.$this->store->id.',id|url|max:250',
            'whatsapp' => 'required|unique:stores,whatsapp,'.$this->store->id.',id|phone:CO,mobile',
            'facebook' => 'nullable|url|max:250',
            'instagram' => 'nullable|url|max:250',
            'file' => 'nullable|file|mimes:png,jpg,webp|max:200',
            'admin' => ['required', new OkApiGatewayResponse('/api/seller')]
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nombre',
            'status' => 'estado',
            'url' => 'url',
            'file' => 'archivo',
            'admin' => 'administrador',
        ];
    }

    public function messages()
    {
        return [
            'whatsapp.phone' => 'El número para Whatsapp no contiene un formato válido para Colombia'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'whatsapp' => substr($this->whatsapp, 0, 3) == '+57' ? $this->whatsapp : '+57'.$this->whatsapp,
        ]);
    }
}
