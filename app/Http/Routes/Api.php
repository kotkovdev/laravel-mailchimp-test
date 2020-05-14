<?php
declare(strict_types=1);

/** @var \Laravel\Lumen\Routing\Router $router */

// MailChimp group
$router->group(['prefix' => 'mailchimp', 'namespace' => 'MailChimp'], function () use ($router) {
    // Lists group
    $router->group(['prefix' => 'lists'], function () use ($router) {
        $router->post('/', 'ListsController@create');
        $router->get('/{listId}', 'ListsController@show');
        $router->put('/{listId}', 'ListsController@update');
        $router->delete('/{listId}', 'ListsController@remove');

        $router->post('/{listId}/members', 'MembersController@create');
        $router->get('/{listId}/members/{subscriptionHash}', 'MembersController@show');
        $router->put('/{listId}/members/{subscriptionHash}', 'MembersController@update');
        $router->delete('/{listId}/members/{subscriptionHash}', 'MembersController@delete');
    });
});

//Users group
$router->group(['prefix' => 'user', 'namespace' => 'User'], function () use ($router) {
    $router->post('/', 'UserController@create');
    $router->get('/list', 'UserController@list');
    $router->get('/{userId}', 'UserController@show');
    $router->put('/{userId}', 'UserController@update');
    $router->delete('/{userId}', 'UserController@delete');
});
