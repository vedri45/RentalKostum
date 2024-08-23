<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class CostumeImage extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'costume_images';
    protected $dates = ['deleted_at'];
    protected $fillable = ['costume_id','image'];
    public $incrementing = false;

    public function costume()
    {
        return $this->belongsTo('App\Costume');
    }

}
