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
            'campaigName',
        ];
        foreach ($draft as $key => $value) {
            if (!is_null($value) && $value !== '' && !in_array($key, $notIncluded)) {
                if(is_array($value)){
                    $value = array_map('ucwords', $value);
                    $value = implode(", ", $value);
                }
                try{
                    $output.= '<p><strong>' . ucwords(str_replace('_', ' ', $key)) . ':</strong> ' . ucwords(htmlspecialchars($value)) . '</p>';
                }catch(\Exception $ex){
                   
                }
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

    public function getCampaignName(){
        $output = '';
        $draft = json_decode($this->value, true);
        foreach ($draft as $key => $value) {
            if (!is_null($value) && $value !== '' && $key == 'campaigName') {
                return $value;
            }
        }
    }
}
