<?php namespace FrenchFrogs\Models\Db\Tag;

use FrenchFrogs\Laravel\Database\Eloquent\Model;

class Route extends Model
{
    protected $primaryKey  = 'tag_route_id';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tag_route';

    public $uuid = true;

    public function container()
    {
        return $this->belongsTo(Container::class, 'tag_route_id', 'tag_route_id');
    }
}