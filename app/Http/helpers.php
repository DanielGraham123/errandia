<?php


use Illuminate\Support\Facades\Route;

function isRoutePrefixActive($prefix) {
    return str_starts_with(Route::currentRouteName(), $prefix);
}