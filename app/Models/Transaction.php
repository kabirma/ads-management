<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    public function getReference(){
        if($this->ref == 'wallet') {
            return 'Wallet Top Up';
        } else if($this->ref == 'ads') {
            $ads = Ads::find($this->ref_id);
            if($ads !== null) {
               $link = route('detail.ads', ['id'=>$ads->id, 'platform'=>$ads->platform]);
               return '<a href="'. $link .'" target="_blank">Ads Created: <b>'. $ads->name .'</b> <i class="fa fa-eye"></i></a>'; 
            }
        } else {
            $package = Package::find($this->ref_id);
            if($package !== null){
                return 'Package Purchased: <b>'. $package->name . '</b>';
            }
        }

        return ''; 
    }

    public function getAmount() {
         if($this->ref == 'wallet') {
            return '<span class="btn btn-sm btn-success">+'.$this->amount.' SAR</span>';
        } else if($this->ref == 'ads') {
            return '<span class="btn btn-sm btn-danger">-'.$this->amount.' SAR</span>';
        } else {
            return '<span class="btn btn-sm btn-danger">-'.$this->amount.' SAR</span>';
        }

        return $this->amount;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
