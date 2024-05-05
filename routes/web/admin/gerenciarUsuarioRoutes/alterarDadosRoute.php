<?php

use app\Infrastructure\Http\Response;

$obRouter->get('/admin/user/update',[
'middlewares' => [
'required-admin-login'
],
function($request) {
return new Response(200,Admin\User::getUpdate($request));
}
]);

$obRouter->post('/admin/user/update',[
'middlewares' => [
'required-admin-login'
],
function($request) {
return new Response(200,Admin\User::setUpdate($request));
}
]);

