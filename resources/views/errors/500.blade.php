@extends('errors::minimal')

@section('title', __('サーバエラー'))
@section('code', '500')
@section('message', __('サーバでエラーが発生しています'))
