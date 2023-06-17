<?php

namespace App\Http\Requests\Task;

use App\Enum\TaskStateEnum;
use App\Enum\TaskPriorityEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255',
            'description'=>'string|max:255',
            'priority'=>['nullable',new Enum(TaskPriorityEnum::class)] ,
            'state'=>['nullable',new Enum(TaskStateEnum::class)] ,
            'project_id'=>'required|integer',
            'developer_id'=>'integer'
        ];
    }
}
