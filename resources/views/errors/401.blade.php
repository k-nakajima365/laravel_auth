@extends('errors::minimal')

@section('title', __('認証エラー'))
@section('code', '401')
@section('message', __('ユーザ登録又はログインを行ってください'))
