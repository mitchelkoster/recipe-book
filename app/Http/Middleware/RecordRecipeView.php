<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Models\RecipeView;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;

class RecordRecipeView
{
    private const COOKIE = 'viewer_uuid';

    /**
     * Handle an incoming request for visited recipe count.
     *  - Anymous users get tracked through a unique cookie (UUID)
     *  - Authenticated users get tracked through their user ID
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only capture requests view /recipe*
        $recipe = $request->route('recipe');
        if ( ! $recipe) {
           return $next($request); 
        }

        // Determine viewer
        // - If autneticated viewerId null as we can use the userID
        // - If not authenticated viewerId becomes a UUID
        $viewerId = null;
        $setCookie = false;
        $user = $request->user();
        $view = null;
        
        if ($user) {
            $view = RecipeView::firstOrNew([
                'recipe_id' => $recipe->id,
                'user_id'   => $user->id,
            ]);
        } else {
            $viewerId = $request->cookie(self::COOKIE) ?? (string) Str::uuid();
            $setCookie = true;

            $view = RecipeView::firstOrNew([
                'recipe_id' => $recipe->id,
                'viewer_id' => $viewerId,
            ]);
        }
        // Update fields post record lookup/creation
        $view->last_viewed_at = now()->toDateString();
        $view->view_count = ($view->view_count ?? 0) + 1;
        $view->save();

        // Update recipe view count
        $recipe->increment('total_views', 1);

        // All view counts have been updated, hand of response
        $response = $next($request);

        // Set cookie for anonymous visits
        if ($setCookie) {
            Cookie::queue(self::COOKIE, $viewerId, 60 * 24 * 7); // 1 week
        }

        return $response; 
    }
}
