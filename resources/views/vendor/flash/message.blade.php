<!-- Include SweetAlert CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@foreach (session('flash_notification', collect())->toArray() as $message)
    <?php
    $variable = $message['level'];
    
    switch ($variable) {
        case 'primary':
        case 'secondary':
        case 'info':
            $icon = 'info';
            break;
        case 'success':
            $icon = 'success';
            break;
        case 'danger':
        case 'warning':
            $icon = 'warning';
            break;
        case 'light':
        case 'dark':
            $icon = 'question';
            break;
        default:
            $icon = 'info';
            break;
    }
    ?>

    @if ($message['overlay'])
        <script>
            Swal.fire({
                title: "{{ $message['title'] }}",
                html: "{!! $message['message'] !!}",
                icon: "{{ $icon }}",
                showCloseButton: true,
                focusConfirm: false,
            });
        </script>
    @else
        <script>
            Swal.fire({
                icon: "{{ $icon }}",
                title: "{{ ucfirst($message['level']) }}",
                html: "{!! $message['message'] !!}",
                @if($message['important'])
                    showCloseButton: true,
                @endif
            });
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
