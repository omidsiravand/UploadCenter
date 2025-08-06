<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadCenterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image'=>'required|file|mimes:jpeg,png, gif,jpg|max:102400',
        ];
    }


    public function messages(){
       return [
        'image.required'=>'عکس مورد نظر خود را انتخاب کنید',
        'image.file' => 'فایل ارسالی معتبر نیست',
        'image.mimes' => 'فرمت فایل باید یکی از موارد زیر باشد:jpeg, png, gif,jpg',
        'image.max' => 'حجم فایل نمی‌تواند بیشتر از 100 مگابایت باشد',
       ];
    }
}
