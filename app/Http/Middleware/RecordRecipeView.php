<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Models\RecipeView;
use Illuminate\Support\Facades\Log;

class RecordRecipeView
{
    private const COOKIE = 'viewer_uuid';

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $recipe = $request->route('recipe');
        if ( ! $recipe) {
           return $next($request); 
        }

        // Perform task after it's handled by the application
        // Let's give the recipe back first to the user and process view count later
        $response = $next($request);

        // Determine user or anonymouse viewer
        $viewerId = null;
        $setCookie = false;

        $user = $request->user();
        if (! $user) {
            $viewerId = $request->cookie(self::COOKIE);
            if (! $viewerId) {
                $viewerId = (string) Str::uuid();
                $setCookie = true;
            }
        }

        // Update review views  table accordinglyio
        $view = RecipeView::firstOrNew([
            'recipe_id' => $recipe->id,
            'user_id'   => $user?->id,
            'viewer_id' => $viewerId,
        ]);

        $view->last_viewed_at = now()->toDateString();
        $view->view_count = ($view->view_count ?? 0) + 1;

        Log::info('RecordRecipeView', [
            'recipe' => $recipe?->id,
            'auth_id' => $request->user()?->id,
            'viewer_cookie' => $request->cookie('viewer_uuid'),
        ]);

        $view->save();

        Log::info('RecordRecipeView saved', [
            'recipe' => $recipe->id,
            'user_id' => $user?->id,
            'viewer_id' => $viewerId,
        ]);

Log::info('DB path', [
    'db' => config('database.connections.sqlite.database'),
    'default' => config('database.default'),
]);



        // Set cookie
        if ($setCookie) {
            $response->cookie(self::COOKIE, $viewerId, 60 * 24 * 7); // 1 week
        }

        return $response; 
    }
}
