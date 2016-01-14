<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TouchRequest extends Request
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
                'title'=>'required',
                'subject'=>'required',
                'send_on'=>'required',
                'title_slug'=>'required|unique:touches,title_slug,'.$this->route('touches'),
                'template'=>'required',
            ];
  
    }
}
