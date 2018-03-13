@if ($errors->any())
    <script>swal("Error!", "{{$errors->first()}}", "error");</script>
@endif

@if (session('error'))
    <script>swal("Error!", "{{session('error')}}", "error");</script>
@endif

@if (session('warning'))
    <script>swal('What is this?', '{{session('warning')}}', 'warning')</script>
@endif

@if (session('success'))
    <script>swal('Success!', '{{session('success')}}', 'success')</script>
@endif
