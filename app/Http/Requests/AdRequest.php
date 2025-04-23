<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class AdRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:500'],
            'website_url' => ['required', 'url', 'regex:/^https:\/\/.+$/i'],
            'media_type' => ['required', 'integer', 'in:1,2'],
            'media' => ['required'], 
            'social_media' => ['required', Rule::in(['snapchat', 'tiktok'])],
            'budget' => ['required', 'numeric', 'min:160'],
            'from' => ['required', 'date', 'after_or_equal:today'],
            'to' => ['required', 'date', 'after_or_equal:from'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 5 characters long.',
            'description.required' => 'The description is required.',
            'description.min' => 'The description must be at least 20 characters long.',
            'description.max' => 'The description should not be greater than 500 characters.',
            'website_url.required' => 'A valid website URL is required.',
            'website_url.url' => 'Enter a valid Website URL.',
            'website_url.regex' => 'The Website URL must begin with https://',
            'media_type.required' => 'The media type is required.',
            'media_type.in' => 'Invalid media type selected.',
            'media.required' => 'A Media is required.',
            'social_media.required' => 'Please specify the target social media platform.',
            'budget.required' => 'A budget is required.',
            'budget.numeric' => 'Budget must be a valid number.',
            'budget.min' => 'The budget must be at least 160.',
            'from.required' => 'The start date is required.',
            'from.date' => 'The start date must be a valid date.',
            'from.after_or_equal' => 'The start date cannot be in the past.',
            'to.required' => 'The end date is required.',
            'to.date' => 'The end date must be a valid date.',
            'to.after_or_equal' => 'The end date must be after or equal to the start date.',
        ];
    }

    protected function withValidator(Validator $validator)
    {
        dd("asd");
        $validator->after(function ($validator) {
            $url = $this->input('media');
            $social = $this->input('social_media');

            try {
                $image = Image::make(asset($url));
                $width = $image->width();
                $height = $image->height();

                $valid = false;

                if ($social === 'snapchat') {
                    $valid = ($width === 1080 && $height === 1920);
                }

                if ($social === 'tiktok') {
                    $allowed = [
                        ['width' => 720, 'height' => 1280],
                        ['width' => 1200, 'height' => 628],
                        ['width' => 640, 'height' => 640],
                        ['width' => 640, 'height' => 100],
                        ['width' => 600, 'height' => 500],
                        ['width' => 640, 'height' => 200],
                    ];

                    $valid = collect($allowed)->contains(function ($size) use ($width, $height) {
                        return $width >= $size['width'] && $height >= $size['height'];
                    });
                }

                if (!$valid) {
                    $validator->errors()->add('media', 'Invalid image dimensions for selected social platform.');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('media', 'Could not load or process the image.');
            }
        });
    }
}
