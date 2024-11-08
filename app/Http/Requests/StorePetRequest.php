<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required|string|max:255',
      'status' => 'required|in:available,pending,sold'
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Pet name is required',
      'status.required' => 'Pet status is required'
    ];
  }
}
