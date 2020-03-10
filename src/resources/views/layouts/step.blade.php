@extends('layouts.index')

@push('script')
    <script type="text/javascript">
    $(function () {
        var $expiresIn = $('#expires-in');
        var expiresIn = parseInt('{{ $expiresIn }}');
        var secondsPassed = 0;
        var onBeforeUnloadHandler = function (e) {
            return '';
        };

        function unbindHandler() {
            $(window).off('beforeunload', onBeforeUnloadHandler);
        }

        $(window).on('beforeunload', onBeforeUnloadHandler);
        $('form').on('submit', unbindHandler);


        function update$ExpiresIn() {
            secondsPassed++;
            var time = Math.max(0, expiresIn - secondsPassed);
            var date = new Date(time * 1000);
            var minutes = date.getMinutes().toString().padStart(2, '0');
            var seconds = date.getSeconds().toString().padStart(2, '0');
            $expiresIn.text(minutes + ':' + seconds);
            if (time === 0) {
                unbindHandler();
                location.reload();
            }
        }

        update$ExpiresIn();
        setInterval(update$ExpiresIn, 1000);
    });
    </script>
@endpush

@section('content')
    <span id="expires-in"></span>
    @yield('step_content')
@endsection
