{{ csrf_field() }}
.form-group.row
  .col
    %label.col-form-label{'for' => 'caption'}
      Caption
    %textarea#caption.form-control{'name' => 'caption' } = old('caption', $picture->caption)
.form-group.row
  .col
    %a{'href' => '#advanced-info', 'data-toggle' => 'collapse' }
      Advanced
.form-group.row.collapse#advanced-info
  .col
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'lat'}
          Latitude
      .col
        %input#lat.form-control{'type' => 'text', 'placeholder' => 'Enter Picture latitude', 'name' => 'lat', 'value' => "#{ old('lat', $picture->lat) }" }
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'lon'}
          Longitude
      .col
        %input#lon.form-control{'type' => 'text', 'placeholder' => 'Enter Picture longitude', 'name' => 'lon', 'value' => "#{ old('lon', $picture->lon) }" }
    .form-group.row
      .col-sm-2
        %label.col-form-label{'for' => 'date_taken'}
          Date Taken
      .col-auto
        %input#date_taken.form-control{'type' => 'date', 'name' => 'date_taken', 'value' => "#{ old('date_taken', $picture->date_taken) }" }
