{{ csrf_field() }}
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'name'}
      Name
  .col
    %input#name.form-control{'type' => 'text', 'placeholder' => 'Enter Highlight name', 'required' => true, 'name' => 'name', 'value' => "#{ old('name', $highlight->name) }" }
.card.mb-3
  .card-header
    Address
  .card-body
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'road'}
          Street
      .col
        %input#road.form-control{'type' => 'text', 'placeholder' => 'Enter Address Street', 'required' => true, 'name' => 'road', 'value' => "#{ old('road', $highlight->road) }" }
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'road2'}
          Street 2
      .col
        %input#road2.form-control{'type' => 'text', 'placeholder' => 'Enter Address Street 2', 'name' => 'road2', 'value' => "#{ old('road2', $highlight->road2) }" }
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'city'}
          City
      .col
        %input#city.form-control{'type' => 'text', 'placeholder' => 'Enter Address City', 'required' => true, 'name' => 'city', 'value' => "#{ old('city', $highlight->city) }" }
      .col-sm-2
        %label.col-form-label{'for' => 'state'}
          State
      .col
        %select#state.form-control{'required' => true, 'name' => 'state' }
          %option{'value' => '', 'readonly' => true}
            Select a State
          @foreach($states as $value => $name)
          %option{'value' => $value, 'selected' => ($value == old('state', $highlight->state))}
            {{ $name }}
          @endforeach
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'zip'}
          Zip
      .col
        %input#zip.form-control{'type' => 'text', 'placeholder' => 'Enter Address Zip', 'required' => true, 'name' => 'zip', 'value' => "#{ old('zip', $highlight->zip) }" }
      .col-sm-2
        %label.col-form-label{'for' => 'country'}
          Country
      .col
        %select#country.form-control{'required' => true, 'name' => 'country' }
          @foreach($countries as $value => $name)
          %option{'value' => $value, 'selected' => ($value == old('country', $highlight->country))}
            {{ $name }}
          @endforeach
    %a{'href' => '#advanced-location', 'data-toggle' => 'collapse' }
      Advanced
    .form-group.row.collapse#advanced-location
      .col
        .form-group.row
          .col-sm-2
            %label.col-form-label{'for' => 'lat'}
              Latitude
          .col
            %input#lat.form-control{'type' => 'text', 'placeholder' => 'Enter Highlight latitude', 'name' => 'lat', 'value' => "#{ old('lat', $highlight->lat) }" }
        .form-group.row.mb-0
          .col-sm-2
            %label.col-form-label{'for' => 'lon'}
              Longitude
          .col
            %input#lon.form-control{'type' => 'text', 'placeholder' => 'Enter Highlight longitude', 'name' => 'lon', 'value' => "#{ old('lon', $highlight->lon) }" }
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'start_date'}
      Start Date
  .col-auto
    %input#start_date.form-control{'type' => 'date', 'required' => true, 'name' => 'start_date', 'value' => "#{ old('start_date', (empty($highlight->start_date) ? $trip->start_date : $highlight->start_date)) }" }
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'end_date'}
      End Date
  .col-auto
    %input#end_date.form-control{'type' => 'date', 'required' => true, 'name' => 'end_date', 'value' => "#{ old('end_date', (empty($highlight->end_date) ? $trip->end_date : $highlight->end_date)) }" }
.form-group.row
  .col
    %label.col-form-label{'for' => 'description'}
      Description
    %textarea#description.form-control{'name' => 'description' } = old('description', $highlight->description)
.form-group.row
  .col
    %label.col-form-label{'for' => 'attendees'}
      Attendees
    %select#attendees.form-control{'required' => true, 'name' => 'attendees[]', 'multiple' => true }
      - $prev = old('attendees', $highlight->attendees()->get()->pluck(['id'])->toArray())
      @if (empty($prev))
      - $prev = $trip->attendees()->get()->pluck(['id'])->toArray()
      @endif
      @foreach($attendees as $attendee)
      %option{'value' => $attendee->id, 'selected' => in_array($attendee->id, $prev)}
        {{ $attendee->first_name }} {{ $attendee->last_name }}
      @endforeach
