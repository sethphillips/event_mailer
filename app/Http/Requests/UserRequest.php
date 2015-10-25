<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        if($this->method === 'POST')
        {
            return [
                'email'=>'required|unique:users,email,'.$this->route('users'),
                'password'=>'required|min:4|same:password2',
                'name'=>'required',
            ];
        }

        return [
            'email'=>'required|unique:users,email,'.$this->route('users'),
            'password'=>'required_with:password2|min:4|same:password2',
            'name'=>'required',
        ];
    }
}
