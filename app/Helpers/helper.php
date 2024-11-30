<?php

use Illuminate\Support\Str;

if (!function_exists('setActiveSegmentWildcard')) {
    function setActiveSegmentWildcard($segmentPrefix)
    {
        return Str::startsWith(request()->segment(2), $segmentPrefix) ?
            'flex items-center gap-2 border rounded-lg p-2 bg-blue-700 hover:bg-blue-800 transition-all duration-300 shadow-md'
            :
            'flex items-center gap-2 rounded-lg p-2 hover:bg-blue-700 hover:shadow-md transition-all duration-300';
    }
}
