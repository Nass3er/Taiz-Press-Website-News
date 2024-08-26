<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
<!-- JQuery min js -->
<script src="{{URL::asset('adminassets2/plugins/jquery/jquery.min.js')}}"></script>  <!-- very important -->
<!-- Bootstrap Bundle js -->
<script src="{{URL::asset('adminassets2/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>  <!--  important -->
<!-- Ionicons js -->
{{-- <script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script> --}}   <!-- not important -->
<!-- Moment js -->
{{-- <script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>   --}}   <!-- not important -->

<!-- Rating js-->
<script src="{{URL::asset('adminassets2/plugins/rating/jquery.rating-stars.js')}}"></script>  <!-- not important -->
{{-- <script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script> --}}  <!-- not important -->

<!--Internal  Perfect-scrollbar js -->
{{-- <script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script> --}} <!-- not important -->
{{-- <script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script> --}} <!-- not important -->
<!--Internal Sparkline js -->
<script src="{{URL::asset('adminassets2/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script><!--important for charts lines -->
<!-- Custom Scroll bar Js-->
<script src="{{URL::asset('adminassets2/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>  <!--important for sidebar scroll -->
<!-- right-sidebar js -->
<script src="{{URL::asset('adminassets2/plugins/sidebar/sidebar-rtl.js')}}"></script> <!--   important for another left sidebar , i can delete it -->
<script src="{{URL::asset('adminassets2/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
{{-- <script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script> --}} <!-- not important -->
@yield('js')
<!-- Sticky js -->
<script src="{{URL::asset('adminassets2/js/sticky.js')}}"></script> <!--  important for display the page-header for each page  -->
<!-- custom js -->
<script src="{{URL::asset('adminassets2/js/custom.js')}}"></script> <!--  important for display the notifications and emails msg when click on icon on topbar , Left-menu js -->
<script src="{{URL::asset('adminassets2/plugins/side-menu/sidemenu.js')}}"></script>  <!-- important for scroll sidebar-->

{{-- FROM OLD TEMPLATE --}}
<script src="{{ asset('adminassets/js/app.js') }}"></script>
<script src="{{ asset('adminassets2/js/main.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>