<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StylistUpdateRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //only allow updates if the user is currently logged in.
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stylist_last_name' => 'required',
            'stylist_first_name' => 'required',
            'stylist_address' => 'required',
            'stylist_contact_no' => 'required',
            'stylist_email' => 'required',
            'date_hired' => 'required',
            'branch_id' => 'required'
        ];
    }
}
