<?php

use Illuminate\Support\Str;

if (!function_exists('setActiveSegmentWildcardMobile')) {
    function setActiveSegmentWildcardMobile($segmentPrefix)
    {
        return Str::startsWith(request()->segment(2), $segmentPrefix) ?
            'border rounded p-2 bg-blue-700 hover:bg-blue-800 transition-all duration-300'
            :
            'hover:border rounded p-2 hover:bg-blue-700 transition-all duration-300';
    }
}
