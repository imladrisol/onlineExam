<?php
/**
 * Created by PhpStorm.
 * User: imlad
 * Date: 12.12.2017
 * Time: 13:07
 */

namespace App\Http\Requests;
use App\Http\Requests\Request;

class QuestionRequest
{
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
            'question' => 'required|min:3'
        ];
    }
}