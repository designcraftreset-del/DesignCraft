// app/Http/Middleware/CheckModerator.php
public function handle($request, Closure $next)
{
    if (Auth::check() && (Auth::user()->role === 'moderator' || Auth::user()->role === 'admin')) {
        return $next($request);
    }
    
    return redirect('/')->with('error', 'Доступ запрещен');
}