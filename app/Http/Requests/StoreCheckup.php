<?php
/**
 * 版权所有 (c) 2017-2018 成都盛世华旭科技有限公司
 * Copyright (c) 2017-2018. Chengdu ShengShiHuaXu Scientific & Technical Ltd.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckup extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
