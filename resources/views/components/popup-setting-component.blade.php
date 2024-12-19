@if(!empty($popupSetting?->image_url))
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$popupSetting?->title}}</h5>
            </div>
            <div class="modal-body">
                <img src="{{$popupSetting?->image_url}}" width="100%" alt="">
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

                function showAndHideModal() {
                    myModal.show();
                    setTimeout(function () {
                        myModal.hide(); // Close the modal after 5 seconds
                        setTimeout(showAndHideModal, {{$popupSetting?->iteration_duration * 60000}});
                    }, {{$popupSetting?->display_duration * 60000}});
                }

                showAndHideModal(); // Initial call
            });
        </script>
    @endpush
</div>
@endif
