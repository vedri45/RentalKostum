<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Costume extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'costume';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','category_id','status','price','penalty'];
    public $incrementing = false;

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function images()
    {
        return $this->hasMany('App\CostumeImage');
    }
}
