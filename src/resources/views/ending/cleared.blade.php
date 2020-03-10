@extends('layouts.index')

<h1>おしまい(成功)</h1>
<form method="post" action="{{ route('reset') }}">
    @csrf
    <button type="submit">タイトルに戻る</button>
</form>
