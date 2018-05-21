#app
#header
  %nav.navbar.navbar-expand-md.navbar-toggler-right.navbar-light.bg-light{ role: 'navigation'}
    .container
      %a.navbar-brand{'href' => route('home')}
        Our Travel Photos
      %button.navbar-toggler{ 'type' => 'button', 'data-toggle' => 'collapse', 'data-target' => '#navbar', 'aria-controls' => 'navbar', 'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation' }
        %span.navbar-toggler-icon
      #navbar.collapse.navbar-collapse
        %ul.navbar-nav.ml-auto
          - if (Auth::check())
            %li.nav-item
              %a.nav-link{ 'href' => route('trips.create') }
                New Trip
            %li.nav-item
              %a.nav-link{ 'href' => route('logout'), 'onclick' => "event.preventDefault(); document.getElementById('logout-form').submit();" }
                Logout

              %form#logout-form.hidden{ 'action' => route('logout'), 'method' => 'POST' }
                {{ csrf_field() }}
          - else
            %li.nav-item
              %a.nav-link{ 'href' => route('login') }
              Login
@include('layouts.status')