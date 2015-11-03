<?php namespace FrenchFrogs\Tag\Http\Middleware;

use Closure;
use Cache;
use FrenchFrogs\Models\Db\Tag\Tag;
use FrenchFrogs\Models\Db\Tag\Route;

class TagMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Put in cache all of route which are tag
        $routes = Cache::remember('tags', 120, function(){
            return Route::all();
        });

        $results = [];

        // Check if current route has tags
        foreach($routes as $route) {
            if(preg_match('%^' . $route->route . '$%', $request->url())) {
                array_push($results, $route->tag_container_id);
            }
        }

        // Get all container tag of the current route and add this to the layout
        $contents = Tag::whereIn('tag_container_id', $results)->get();

        if($contents) {
            foreach($contents as $content) {
                // if data content format this to integrate them into the script
                if($content->data) {
                    $data = explode(',', $content->data);
                    $params = [];
                    foreach($data as $value) {
                        $params[] = "'+ $value +'";
                    }
                    $script = sprintf($content->content, ...$params);
                } else {
                    $script = $content->content;
                }
                // add script to namespace declared in database
                js($content->position .'-tag')->append($script);
            }
        }
        return $next($request);
    }
}
