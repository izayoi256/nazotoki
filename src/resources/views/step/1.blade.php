@extends('layouts.step')

@section('step_content')
    <h1>1ページ目</h1>
    <form method="post" action="{{ route('step.answer', ['step' => $step]) }}">
        @csrf
        <div>
            <label>
                Q1.
                <input type="text" name="q1" value="{{ old('q1') }}" placeholder="答えはhoge" />
            </label>
        </div>
        <div>
            <label>
                Q2.
                <input type="text" name="q2" value="{{ old('q2') }}" placeholder="答えはfuga" />
            </label>
        </div>
        <button type="submit">送信</button>
        @if ($errors->any())
            <div>
                はずれ
            </div>
        @else
            <div>
                ステップのはじめに表示する文章等
            </div>
        @endif
    </form>
@endsection
