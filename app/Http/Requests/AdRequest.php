<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'goal' => ['required', Rule::in(['TRAFFIC'])], 
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:500'],
            'call_to_action' => ['required', Rule::in(['READ_MORE', 'LEARN_MORE', 'CALL_NOW', 'APPLY_NOW', 'CONTACT_US'])],
            'website_url' => [
                'required', 
                'url', 
                'regex:/^https:\/\/.+$/i'
            ],
            'media_type' => ['required', 'integer', 'in:1,2'],
            'dates' => ['required', 'regex:/^\d{4}-\d{2}-\d{2} - \d{4}-\d{2}-\d{2}$/', 'after_or_equal:today'],
            'budget' => ['required', 'numeric', 'min:160'],
        ];
    }

    public function messages(): array
    {
        return [
            'goal.required' => 'The ad goal is required.',
            'goal.in' => 'The selected goal is invalid.',
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 5 characters long.',
            'description.required' => 'The description is required.',
            'description.min' => 'The description must be at least 100 characters long.',
            'call_to_action.required' => 'Please select a valid call-to-action option.',
            'website_url.required' => 'A valid website URL is required.',
            'website_url.url' => 'Enter a valid URL.',
            'website_url.regex' => 'Enter a valid URL.',
            'media_type.required' => 'The media type is required.',
            'media_type.in' => 'Invalid media type selected.',
            'dates.required' => 'You must provide a date range.',
            'dates.regex' => 'The date format should be YYYY-MM-DD - YYYY-MM-DD.',
            'dates.after_or_equal' => 'The date range must start from today or a future date.',
            'budget.required' => 'A budget is required.',
            'budget.numeric' => 'Budget must be a valid number.',
            'budget.min' => 'The budget must be at least 160.',
        ];
    }
}
