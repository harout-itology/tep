<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TowerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'towerid'  => 'required|string|max:255|unique:towers,towerid,'.$this->id.',id',
            'country'  => 'required|string|max:255',
            'state'  => 'required|string|max:255',
            'city'  => 'required|string|max:255',
            'latitude'  => 'required|numeric|max:255',
            'longitude'  => 'required|numeric|max:255',
            'structureclassification'  => 'required|string|max:255',
            'towerowner'  => 'required|string|max:255',
        ];
    }
}
