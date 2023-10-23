@extends('member-components.member-layout')


<div class="container d-flex justify-content-center align-items-center" style="height: 95%; overflow: hidden;">
    <div class="text-center">
        <h1 class="display-1 text-danger">403 Forbidden</h1>
        <p class="lead">
            @if(!is_null($customMessage))
                {{ $customMessage }}
            @else
                {{ $default }}
            @endif
        </p>
    </div>
</div>
