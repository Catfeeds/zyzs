<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateSitenavRequest extends Request
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
            'nickname' => 'required|alpha_dash|unique:sitenavs|not_in:manage,admin,article,sub,contactus,feedback,support,album,product,products,albums,feedbacks,pubajax,articles,contact,service,server,user,auth',
            'weihao' => 'required|integer',
            'keywords' => 'required',
            'description' => 'required'
        ];
    }
}
