<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

abstract class IsType {

    private $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    abstract public function getType();

    public function handle($request, Closure $next)
    {
        if($this->auth->user()->type != $this->getType()){
            return back()->withInput();
        }
        return $next($request);
    }


}

