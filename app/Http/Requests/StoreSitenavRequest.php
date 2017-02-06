<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreSitenavRequest extends Request
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
            'showsnot'=>'required|integer',
            'layout' => 'required|integer',
            'name' => 'required|alpha_num',
            'nickname' => 'required|alpha_dash|unique:sitenavs,nickname,'.$this->sitenav_id.'|not_in:manage,admin,article,sub,contactus,feedback,service,server,user,auth',
            'weihao' => 'required|integer',
            'keywords' => 'required',
            'description' => 'required'
        ];
    }
}
