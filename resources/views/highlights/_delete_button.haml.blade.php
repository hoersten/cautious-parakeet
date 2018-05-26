%a.btn.btn-danger.text-white{"title"=>'Delete Highlight', "data-toggle"=>"modal", "data-target"=>"#deleteModal-" . $highlight->slug}
  Delete

.modal.fade{ "tabindex"=>"-1", "role"=>"dialog", "aria-labelledby"=>"#deleteModalLabel", "aria-hidden"=>"true", "id" => "deleteModal-" . $highlight->slug }
  .modal-dialog{ "role"=>"document" }
    .modal-content
      .modal-header
        %h5.modal-title#deleteModalLabel
          Delete Highlight
        %button.close{"type"=>"button", "data-dismiss"=>"modal", "aria-label"=> 'Cancel'}
          %span{"aria-hidden"=>"true"}
            &times;
      .modal-body
        %p
          Deleting a highlight will remove it from the system and remove all attached data and pictures.  Click "Continue" if you are sure you want the highlight removed.
      .modal-footer
        %button.btn.btn-secondary{"type"=>"button", "data-dismiss"=>"modal"}
          Cancel
        %form{'action' => route('highlights.destroy', ['trip' => $trip, 'highlight' => $highlight]), 'id' => 'deleteHighlightForm', 'method' => 'POST'}
          {{ csrf_field() }}
          %input{ "name" => "_method", "type" => "hidden", "value" => "DELETE" }
          %button.btn.btn-primary
            Continue
