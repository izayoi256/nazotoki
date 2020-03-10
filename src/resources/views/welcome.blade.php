@extends('layouts.index')

<h1>忘れられた幽霊船からの脱出</h1>
<form method="post" action="{{ route('start') }}">
    @csrf
    <button type="submit">スタート</button>
</form>
