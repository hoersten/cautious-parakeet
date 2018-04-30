#app
#header
  %nav.navbar.navbar-expand-md.navbar-toggler-right.navbar-light.bg-light{ role: 'navigation'}
    .container
      %a.navbar-brand{'href' => route('trips.index')}
        My Travel Log
      %button.navbar-toggler{ 'type' => 'button', 'data-toggle' => 'collapse', 'data-target' => '#navbar', 'aria-controls' => 'navbar', 'aria-expanded' => 'false', 'aria-label' => 'Toggle navigation' }
        %span.navbar-toggler-icon
      #navbar.collapse.navbar-collapse
        %ul.navbar-nav.mr-auto
          %li.nav-item
            %a.nav-link{ 'href' => route('trips.create') }
              New Trip
@include('layouts.status')