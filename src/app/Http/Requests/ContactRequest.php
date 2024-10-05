<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone_part1' => ['required', 'digits:3', 'regex:/^[0-9]+$/'],
            'phone_part2' => ['required', 'digits:4', 'regex:/^[0-9]+$/'],
            'phone_part3' => ['required', 'digits:4', 'regex:/^[0-9]+$/'],
            'address' => 'required',
            'category_id' => 'required',
            'detail' => 'required|max:120',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください。',
            'last_name.required' => '名を入力してください。',
            'gender.required' => '性別を選択してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスはメール形式で入力してください。',
            'phone_part1.required' => '電話番号を入力してください。',
            'phone_part1.digits' => '3桁で入力してください。',
            'phone_part1.regex' => '数字で入力してください。',
            'phone_part2.required' => '電話番号を入力してください。',
            'phone_part2.digits' => '4桁で入力してください。',
            'phone_part2.regex' => '数字で入力してください。',
            'phone_part3.required' => '電話番号を入力してください。',
            'phone_part3.digits' => '4桁で入力してください。',
            'phone_part3.regex' => '数字で入力してください。',
            'address.required' => '住所を入力してください。',
            'category_id.required' => 'お問い合わせの種類を選択してください。',
            'detail.required' => 'お問い合わせの内容を入力してください。',
            'detail.max' => 'お問い合わせ内容は120文字以内で入力してください。',
        ];
    }
}
