<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.header')
<style>
    #dataTable tbody td {
        color: white;
    }

    /* Style for disabled pagination buttons */
    .page-item.disabled .page-link {
        /* background: linear-gradient(to right, #1487b3, #38afc3); */
        background: transparent;
        color: white;
        border: none;
    }

    .pagination .active .page-link {
        background: linear-gradient(to right, #1487b3, #38afc3);
        color: white;
        border: none;
    }


    .pagination .page-link:hover {
        background: linear-gradient(to right, #1487b3, #38afc3);
        color: white;
        border: none;
    }


    /* .pagination .page-link:focus {
                        background: linear-gradient(to right, #1487b3, #38afc3);
                        color: white;
                        border: none;
                    } */

    /* Optional: Style for active and non-disabled pagination buttons to match primary-btn */
    #media {
        /* background: linear-gradient(to right, #1487b3, #38afc3); */
        color: white;
        padding: 8px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Optional: Hide default file input text and customize label */
    #media::-webkit-file-upload-button {
        /* background: rgba(255, 255, 255, 0.2); */
        background: linear-gradient(to right, #1487b3, #38afc3);
        ;
        border: none;
        padding: 8px 12px;
        color: white;
        border-radius: 4px;
        cursor: pointer;
    }

    #media::file-selector-button {
        background: linear-gradient(to right, #1487b3, #38afc3);
        ;
        border: none;
        padding: 8px 12px;
        color: white;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Toolbar (top) */
    /* .cke_top {
                            background: linear-gradient(to right, #1487b3, #38afc3) !important;

                        } */


    /* Bottom bar */
    .cke_bottom {
        background: linear-gradient(to right, #2e3e4a, #0c2c3e) !important;
    }

    /* Buttons in the toolbar */
    .cke_button {
        background: transparent !important;
        color: white !important;
    }
</style>
{{-- Sidebar --}}
@include('admin.layouts.sidebar')


<!-- Main Content -->
<main class="col-sm-12 col-md-10 ms-sm-auto  dashboard-container">
    <!-- nav contents -->
    @include('admin.layouts.navbar')
    <!-- end top nav -->



    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
                <div>{{ $err }}</div>
            @endforeach
        </div>
    @endif

    @yield('content')



</main>
@include('admin.layouts.footer')



<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": false,
        "maxOpened": 1,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(".select2").select2();

    $(document).on('click', '.delete', function() {
        toastr.remove();
        toastr['warning']('Are you sure you want to delete this Record for <b>' + $(this).attr('data-title') +
            '</b>?<br /><br /><a type="button" href="' + $(this).attr('data-href') +
            '" class="btn-sm btn-danger clear">Confirm</a>',
            'Warning', {
                closeButton: true,
                tapToDismiss: false,
                progressBar: false
            });
    });

    var table = $('#dataTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
        order: [
            [0, 'desc']
        ],
        pageLength: 10, // default: show 10 per page
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ], // user can choose
        columnDefs: [{
            targets: 0,
            visible: false,
            searchable: false
        }]
    });
</script>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="imageForm">
                <div class="modal-header">
                    <div class="row" style="width:100%">
                        <div class="col-md-6">
                            <h4 class="modal-title" id="imageModalLabel">{{ __('messages.ChooseYourMedia') }}</h4>
                        </div>
                        <div class="col-md-6" style="text-align: right"><a href="{{ route('add.media') }}"
                                class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i>
                                {{ __('messages.UploadMedia') }}</a></div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @foreach ($medias as $media)
                            @if ($media->media_type == 'image')
                                <div class="col-4">
                                    <label class="image-radio">
                                        <input type="radio" name="image" value="{{ $media->media }}"
                                            data-path="{{ asset($media->media) }}" data-type="{{ $media->media_type }}">
                                        <img src="{{ asset($media->media) }}" alt="{{ $media->name }}">
                                        {{ $media->getImageSize() }}
                                    </label>
                                </div>
                            @else
                                <div class="col-4">
                                    <label class="image-radio">
                                        <input type="radio" name="image" value="{{ $media->media }}"
                                            data-path="{{ asset($media->media) }}"
                                            data-type="{{ $media->media_type }}">
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset($media->media) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">{{ __('messages.Select') }}</button>
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.Cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.image-radio').on('click', function() {
            $('.image-radio input[type="radio"]').prop('checked', false);
            $('.image-radio').removeClass('checked');

            const input = $(this).find('input[type="radio"]');
            input.prop('checked', true);
            $(this).addClass('checked');
        });

        $('#imageForm').on('submit', function(e) {
            e.preventDefault();
            const selected = $('input[name="image"]:checked').val();
            const selectedType = $('input[name="image"]:checked').attr('data-type');
            const selectedpath = $('input[name="image"]:checked').attr('data-path');
            if (selected) {
                $('#selectedMedia').val(selected);
                $('#selectedType').val(selectedType == 'image' ? 1 : 0);
                renderMedia(selectedType, selectedpath)
                $('#imageModal').modal('hide');
            } else {
                alert('Please select an image.');
            }
        });


        function renderMedia(mediaType, mediaSrc) {
            let html = '';

            if (mediaType === 'video') {
                html = `
                    <video width="320" height="240" controls>
                        <source src="${mediaSrc}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
            } else if (mediaType === 'image') {
                html = `<img src="${mediaSrc}" alt="Media" height="200">`;
            }

            $('#mediaArea').html(html);
        }
    });
</script>

<script>
    window.intercomSettings = {
        api_base: "https://api-iam.intercom.io",
        app_id: "a67agzdn",
        name: '{{ Auth::user()->full_name != '' ? Auth::user()->full_name : Auth::user()->name }}',
        email: '{{ Auth::user()->email }}',
    };
</script>


<script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/a67agzdn'
    (function() {
        var w = window;
        var ic = w.Intercom;
        if (typeof ic === "function") {
            ic('reattach_activator');
            ic('update', w.intercomSettings);
        } else {
            var d = document;
            var i = function() {
                i.c(arguments);
            };
            i.q = [];
            i.c = function(args) {
                i.q.push(args);
            };
            w.Intercom = i;
            var l = function() {
                var s = d.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://widget.intercom.io/widget/a67agzdn';
                var x = d.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            };
            if (document.readyState === 'complete') {
                l();
            } else if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@stack('scripts')



<script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>


</body>

</html>
