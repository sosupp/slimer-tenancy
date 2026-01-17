@extends('layouts.registration')
@section('content')

    <div class="custom-inputs-wrapper">
        <!-- Add this to your layout -->
        <button>
            <span>📱 Install App</span>
            <small style="display: block; font-size: 0.8em; opacity: 0.8;">Works offline</small>
        </button>
    </div>

    <script>
        const workspace = localStorage.getItem('susucrm.workspace');

        if (workspace) {
            window.location.replace(`/t/${workspace}`);
        } else {
            window.location.replace('/select-workspace');
        }
    </script>
@endsection
