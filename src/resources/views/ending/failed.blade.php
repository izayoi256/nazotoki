@extends('layouts.index')

<h1>おしまい(失敗)</h1>
<form method="post" action="{{ route('reset') }}">
    @csrf
    <button type="submit">タイトルに戻る</button>
</form>
