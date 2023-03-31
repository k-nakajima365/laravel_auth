@extends('errors::minimal')

@section('title', __('サーバダウン'))
@section('code', '503')
@section('message', __('サーバが一時的にダウンしています'))
