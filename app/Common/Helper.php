<?php

if (!function_exists('makeSortLink')) {
    function makeSortLink($request, $field)
    {
        if (strlen($field)) {
            if (isset($request['sort_field']) && $request['sort_field'] == $field
                && isset($request['sort_type']) && $request['sort_type'] == 'desc') {
                $request['sort_type'] = 'asc';
            } else {
                $request['sort_field'] = $field;
                $request['sort_type'] = 'desc';
            }
        }

        return $request;
    }
}

if (!function_exists('getSortIcon')) {
    function getSortIcon($request, $field)
    {
        if (strlen($field)) {
            if (isset($request['sort_field']) && $request['sort_field'] == $field && isset($request['sort_type']) && $request['sort_type'] == 'desc') {
                return 'fa-sort-down';
            }

            if (isset($request['sort_field']) && $request['sort_field'] == $field && isset($request['sort_type']) && $request['sort_type'] == 'asc') {
                return 'fa-sort-up';
            }
        }

        return 'fa-sort';
    }
}

if (!function_exists('getSizeBarActive')) {
    function getSizeBarActive($routeNames)
    {
        $current = Route::currentRouteName();

        if (in_array($current, $routeNames)) {
            return 'active';
        }

        return '';
    }
}
