<?php
include_once "auth.php";
add_filter('add_dependencies', function ($container)
{
// setting api
    $container['auth'] = function ($c)
    {
        return \SCB\Modules\Auth::getInstance();
    };
    return $container;
});

app()->group(admin_base, function ()
{

    $this->get('/login/', function ($request, $response, $args)
    {
        return $this->view->render($response, 'admin/login.html');
    })->setName('admin_login');

});

app()->add(function ($request, $response, $next)
{

    if (!$request->getAttribute('route')->getName() == 'admin_login')
    {

        if (!$this->auth->is_admin())
        {
            return $response->withRedirect(url_for('admin_login'));
        }
    }
    return $next($request, $response);
});
