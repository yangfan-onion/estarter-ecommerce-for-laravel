<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AttributeUpdateRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|min:1|max:50',
            'type'             => 'not_in:0',
            'current_option'   => 'sometimes|required_if:type,dropdown,multiple_select',
            'current_option.*' => 'sometimes|required_if:type,dropdown,multiple_select|min:1',
            'option'           => 'sometimes|required_if:type,dropdown,multiple_select',
            'option.*'         => 'sometimes|required_if:type,dropdown,multiple_select|min:1',
            'text'             => 'required_if:type,text',
            'textarea'         => 'required_if:type,textarea',
            'date'             => 'required_if:type,date',
            'media'            => 'required_if:type,media',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {

        $attributes = [];

        if (isset($this->option)) {
            foreach ($this->option as $key => $option) {
                $attributes['option.'.$key] = "Option #".($key);
            }
        }

        if (isset($this->current_option)) {
            foreach ($this->current_option as $key => $current_option) {
                $attributes['current_option.'.$key] = "Option #".($key);
            }
        }

        return $attributes;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
