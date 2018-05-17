%a.btn.btn-danger.text-white{"title"=>'Delete Trip', "data-toggle"=>"modal", "data-target"=>"#deleteModal-" . $trip->slug}
  Delete

.modal.fade{ "tabindex"=>"-1", "role"=>"dialog", "aria-labelledby"=>"#deleteModalLabel", "aria-hidden"=>"true", "id" => "deleteModal-" . $trip->slug }
  .modal-dialog{ "role"=>"document" }
    .modal-content
      .modal-header
        %h5.modal-title#deleteModalLabel
          Delete Trip
        %button.close{"type"=>"button", "data-dismiss"=>"modal", "aria-label"=> 'Cancel'}
          %span{"aria-hidden"=>"true"}
            &times;
      .modal-body
        %p
          Deleting a trip will remove it from the system and remove all attached data and pictures.  Click "Continue" if you are sure you want the trip removed.
      .modal-footer
        %button.btn.btn-secondary{"type"=>"button", "data-dismiss"=>"modal"}
          Cancel
        %form{'action' => route('trips.destroy', $trip), 'id' => 'deleteTripForm', 'method' => 'POST'}
          {{ csrf_field() }}
          %input{ "name" => "_method", "type" => "hidden", "value" => "DELETE" }
          %button.btn.btn-danger
            Continue
