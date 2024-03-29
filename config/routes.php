<?php

use Wfm\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$', ['admin_prefix' => 'admin']);


Router::add('^(?P<lang>[a-z]+)?/?product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
Router::add('^(?P<lang>[a-z]+)?/?category/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
Router::add('^(?P<lang>[a-z]+)?/?page/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^(?P<lang>[a-z]+)?/?cart/view/?$', ['controller' => 'Cart', 'action' => 'view']);

Router::add('^(?P<lang>[a-z]+)?/?user/signup/?$', ['controller' => 'User', 'action' => 'signup']);
Router::add('^(?P<lang>[a-z]+)?/?user/orders/?$', ['controller' => 'User', 'action' => 'orders']);
Router::add('^(?P<lang>[a-z]+)?/?user/files/?$', ['controller' => 'User', 'action' => 'files']);
Router::add('^(?P<lang>[a-z]+)?/?user/order/?$', ['controller' => 'User', 'action' => 'view']);
Router::add('^(?P<lang>[a-z]+)?/?user/cabinet/?$', ['controller' => 'User', 'action' => 'cabinet']);
Router::add('^(?P<lang>[a-z]+)?/?user/signin/?$', ['controller' => 'User', 'action' => 'signin']);
Router::add('^(?P<lang>[a-z]+)?/?user/logout/?$', ['controller' => 'User', 'action' => 'logout']);


Router::add('^(?P<lang>[a-z]+)?/?wishlist/?$', ['controller' => 'Wishlist', 'action' => 'index']);
Router::add('^(?P<lang>[a-z]+)?/?search/?$', ['controller' => 'Search', 'action' => 'index']);
Router::add('^(?P<lang>[a-z]+)?$', ['controller' => 'Main', 'action' => 'index']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
Router::add('^(?P<lang>[a-z]+)/(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');