<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <title>User Dashboard</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('assets/public/assets/css/animate.min.css') }}" />

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/font-awesome.css') }}">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/feather-icon.css') }}">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/style.css') }}">

    
    <!-- Plugin CSS file with desired skin css -->
    <link rel="stylesheet" href="{{ asset('assets/public/assets/css/vendors/ion.rangeSlider.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs')}}/datatables.net-bs4/css/responsive.dataTables.min.css">



    <style>
    .no-scrollbar::-webkit-scrollbar{
        display: none;
    }
    .line-clamp-3{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }
    
    </style>
</head>

<body>


    @include('components.dash-header')

    
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>User Dashboard</h2>
                        @if (auth()->user()->shops->count() == 0)
                            <span class="mx-4">
                                <a href="{{ route('business_admin.businesses.create') }}" class="btn text-white mt-xxl-4 mt-2 home-button mend-auto theme-bg-color"><span class="text-white fa fa-plus mx-2"></span>Create business</a>
                            </span>
                        @endif
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('business_admin.home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title??"" }} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    
    {{-- Error Alerts --}}
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @elseif(session()->has('message'))
        <div class="alert alert-primary">{{ session()->get('message') }}</div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
    {{-- End Error Alerts --}}

    
    <!-- User Dashboard Section Start -->
    <section class="user-dashboard-section section-b-space">
        <!-- Main Content start -->
        @yield('section')
        <!-- Main Content end -->
    </section>
    <!-- User Dashboard Section End -->




    @include('components.footer')

    <script>
        let showErrandModal = function(event){
            $('#errandModal').modal().show();
        }
    </script>

    <!-- latest jquery-->
    <script src="{{ asset('assets/public/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('assets/public/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/public/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('assets/public/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('assets/public/assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('assets/public/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('assets/public/assets/js/auto-height.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('assets/public/assets/js/timer1.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('assets/public/assets/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('assets/public/assets/js/quantity-2.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('assets/public/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('assets/public/assets/js/script.js') }}"></script>


    {{-- ADDITIONAL --}}
    <!-- Slick js-->
    <script src="{{ asset('assets/public/assets/js/custom-slick-animated.js') }}"></script>

    <!-- Range slider js -->
    <script src="{{ asset('assets/public/assets/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('assets/public/assets/js/timer2.js') }}"></script>

    <!-- Copy clipboard Js -->
    <script src="{{ asset('assets/public/assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/copy-clipboard.js') }}"></script>


    <!-- sidebar open js -->
    <script src="{{ asset('assets/public/assets/js/filter-sidebar.js') }}"></script>

    <!-- Zoom Js -->
    <script src="{{ asset('assets/public/assets/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/zoom-filter.js') }}"></script>

    <!-- Sticky-bar js -->
    <script src="{{ asset('assets/public/assets/js/sticky-cart-bottom.js') }}"></script>
    <script src="{{ asset('libs')}}/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('libs')}}/datatables.net-bs4/js/dataTables.responsive.min.js"></script>




    @yield('script')

    <script>
         $(function () {
            $('.table , .adv-table table').DataTable(
                {
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    // 'copy', 'csv', 'excel',
                    {
                        // text: 'Download PDF',
                        // extend: 'pdfHtml5',
                        // message: '',
                        // orientation: 'portrait',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function (doc) {
                            doc.pageMargins = [10,10,10,10];
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 7;
                            doc.styles.title.fontSize = 9;
                            doc.content[0].text = doc.content[0].text.trim();

                            doc['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        "{!! $title ?? '' !!}",
                                        {
                                            // This is the right column
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                        }
                                    ],
                                    margin: [10, 0]
                                }
                            });
                            // Styling the table: create style object
                            var objLayout = {};
                            // Horizontal line thickness
                            objLayout['hLineWidth'] = function(i) { return .5; };
                            // Vertikal line thickness
                            objLayout['vLineWidth'] = function(i) { return .5; };
                            // Horizontal line color
                            objLayout['hLineColor'] = function(i) { return '#aaa'; };
                            // Vertical line color
                            objLayout['vLineColor'] = function(i) { return '#aaa'; };
                            // Left padding of the cell
                            objLayout['paddingLeft'] = function(i) { return 4; };
                            // Right padding of the cell
                            objLayout['paddingRight'] = function(i) { return 4; };
                            // Inject the object in the document
                            doc.content[1].layout = objLayout;
                        }
                    }

                ],
                info:     true,
                searching: true,
                lengthMenu: [[10, 25, 50, -1],[10, 25, 50, 'All']],
            }
            );



            

            $('form').each((index, element)=>{
                $(element).on('submit', (event)=>{
                    // $(element).
                    // event.preventDefault();
                    let submit_btn = $(element).find("button, input[type='submit']").first();
                    $(submit_btn).prop('disabled', 'true');
                })
            })

    });
    </script>
    <script>

        // Get all inputs that have a word limit
        document.querySelectorAll('input[data-max-words]').forEach(input => {
            // Remember the word limit for the current input
            let maxWords = parseInt(input.getAttribute('data-max-words') || 0)
            // Add an eventlistener to test for key inputs
            input.addEventListener('keydown', e => {
                let target = e.currentTarget
                // Split the text in the input and get the current number of words
                let words = target.value.split(/\s+/).length
                // If the word count is > than the max amount and a space is pressed
                // Don't allow for the space to be inserted
                if (!target.getAttribute('data-announce'))
                // Note: this is a shorthand if statement
                // If the first two tests fail allow the key to be inserted
                // Otherwise we prevent the default from happening
                words >= maxWords && e.keyCode == 32 && e.preventDefault()
                else
                words >= maxWords && e.keyCode == 32 && (e.preventDefault() || alert('Word Limit Reached'))
            })
        })

        window.onbeforeunload = function(){
            alert('Redirecting');
        }
    </script>
</body>

</html>