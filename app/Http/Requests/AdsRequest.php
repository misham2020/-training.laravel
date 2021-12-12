<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    public function messages()
    {
        return [
            'title.required' => 'Название объявления обязательна для заполнения',
            'cost.required' => 'Стоимость обязательна для заполнения',
            'category.required' => 'Категория должна быть хотябы одна',
            'file.required' => 'Изображение обязательно',
            'cost.numeric' => 'Цена должна быть числом',
            'cost.min' => 'Цена должна быть больше 1 руб',
            'images.max' => 'Колличество загружаемых файлов не может быть больше 2',
            'file.size' => 'Файл не более 250кб'

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'cost' => 'required|numeric|min:1',
            'category' => 'required',
            'images' => 'max:5',
            'file' => 'max:250'

        ];
    }
}
