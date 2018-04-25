{{ csrf_field() }}
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'name'}
      Name
  .col
    %input#name.form-control{'type' => 'text', 'placeholder' => 'Enter trip name', 'required' => true, 'name' => 'name', 'value' => "#{ old('name', $trip->name) }" }
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'type'}
      Trip Type
  .col-auto
    %select#type.form-control{'required' => true, 'name' => 'type' }
      - $prev = old('type', $trip->type)
      @foreach($types as $value => $name)
      %option{'value' => $value, 'selected' => ($prev == $value)}
        {{ $name }}
      @endforeach
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'start_date'}
      Start Date
  .col-auto
    %input#start_date.form-control{'type' => 'date', 'required' => true, 'name' => 'start_date', 'value' => "#{ old('start_date', $trip->start_date) }" }
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'end_date'}
      End Date
  .col-auto
    %input#end_date.form-control{'type' => 'date', 'required' => true, 'name' => 'end_date', 'value' => "#{ old('end_date', $trip->end_date) }" }
.form-group.row
  .col-sm-2
    %label.col-form-label{'for' => 'color'}
      Icon Color
  .col-auto
    %input#color.form-control{'type' => 'color', 'required' => true, 'name' => 'color', 'value' => "#{ old('color', $trip->color) }" }
.form-group.row
  .col
    %label.col-form-label{'for' => 'description'}
      Description
    %textarea#description.form-control{'name' => 'description' } = old('description', $trip->description)
.form-group.row
  .col
    %label.col-form-label{'for' => 'attendees'}
      Attendees
    %select#attendees.form-control{'required' => true, 'name' => 'attendees[]', 'multiple' => true }
      - $prev = old('attendees[]', $trip->attendees()->get()->pluck(['id'])->toArray())
      @foreach($attendees as $attendee)
      %option{'value' => $attendee->id, 'selected' => in_array($attendee->id, $prev)}
        {{ $attendee->first_name }} {{ $attendee->last_name }}
      @endforeach
