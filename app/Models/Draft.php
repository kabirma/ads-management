<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    use HasFactory;

    public function getDraftPretty(){
        $output = '';
        $draft = json_decode($this->value, true);
        $notIncluded = [
            'draftid',
            'id',
            'media_type',
            'age_group',
            'location',
            'media',
            'step',
        ];
        foreach ($draft as $key => $value) {
            if (!is_null($value) && $value !== '' && !in_array($key, $notIncluded)) {
                $output.= '<p><strong>' . ucwords(str_replace('_', ' ', $key)) . ':</strong> ' . htmlspecialchars($value) . '</p>';
            }
        }

        return $output;
    }

    public function getMedia(){
        $output = '';
        $draft = json_decode($this->value, true);
     
        foreach ($draft as $key => $value) {
            if (!is_null($value) && $value !== '' && $key == 'media') {
                return $value;
            }
        }
    }
}
