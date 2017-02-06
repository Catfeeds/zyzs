<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAticleRequest extends Request
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
            'title'=>'required|min:5',
            'showsnot'=>'required|integer|in:1,0',
            'comment' =>'integer|in:1,0',
            'weihao' =>'integer|min:1|max:99999999999',
            'keywords' =>'min:1,max:100',
            'description' =>'min:1,max:200',
            'views'=>'integer|min:1|max:99999999999',
            'praise'=>'integer|min:1|max:99999999999'
        ];
    }
}
