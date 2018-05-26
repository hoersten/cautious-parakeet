%head
  %title
    @section('title')
    @show
  %meta{ "charset" => "utf-8" }
  %meta{ "http-equiv" => "X-UA-Compatible", "content" => "IE=edge" }
  %meta{ "name" => "viewport", "content" => "width=device-width, initial-scale=1" }
  %meta{ "name" => "csrf-token", "content" => csrf_token() }

  %link{ 'href' => mix('/css/app.css'), 'media' => 'all', 'rel' => 'stylesheet' }
  %link{ 'href' => 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', 'rel' => 'stylesheet', 'integrity' => 'sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp', 'crossorigin' => 'anonymous' }

  %meta{ "name" => "csrf-token", "content" => csrf_token() }
  %script
    window.Laravel = {!! json_encode([ 'csrfToken' => csrf_token(), ]) !!};
