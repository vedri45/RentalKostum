<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class CustomerImage extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'customer_images';
    protected $dates = ['deleted_at'];
    protected $fillable = ['customer_id','image'];
    public $incrementing = false;

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

}
