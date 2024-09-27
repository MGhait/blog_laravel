<!DOCTYPE html>
<html lang="en">
    @include('site.partials.head')
    <body>
        @include('site.partials.header')

        @yield('content')
        @include('site.partials.footer')
        @include('site.partials.scripts')
    </body>
</html>