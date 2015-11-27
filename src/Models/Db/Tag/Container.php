<?php namespace FrenchFrogs\Models\Db\Tag;

use FrenchFrogs\Laravel\Database\Eloquent\Model;

class Container extends Model
{
    protected $primaryKey  = 'tag_container_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag_container';
    public $uuid = true;

    public function routes()
    {
        return $this->hasMany(Route::class, 'tag_container_id', 'tag_container_id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'tag_container_id', 'tag_container_id');
    }
}