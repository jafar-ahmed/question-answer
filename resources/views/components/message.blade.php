<!-- <div class="alert alert-info">
<div class="alert alert-success">
<div class="alert alert-warning">
<div class="alert alert-danger"> -->
<div class="alert alert-{{ $type ?? 'info' }}">
    <h4>{{ $title }}</h4>
    {{ $slot }}
</div>