<?php
/**
 * Created by PhpStorm.
 * User: DityaRa
 * Date: 13/12/2018
 * Time: 13:02
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'name',
        'category_id',
        'image',
        'description',
        'author',
        'created_at',
        'updated_at',
    ];

    public function getCategory(){
        return $this->belongsTo('App\Model\Categories','category_id');
    }

}