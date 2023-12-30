<!-- Vendor -->
<script src={{ asset('/assets/vendor/jquery/jquery.js') }}></script>
<script src={{ asset('/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}></script>
<script src={{ asset('/assets/vendor/popper/umd/popper.min.js') }}></script>
<script src={{ asset('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<script src={{ asset('/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}></script>
<script src={{ asset('/assets/vendor/common/common.js') }}></script>
<script src={{ asset('/assets/vendor/nanoscroller/nanoscroller.js') }}></script>
<script src={{ asset('/assets/vendor/magnific-popup/jquery.magnific-popup.js') }}></script>
<script src={{ asset('/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}></script>

<!-- Specific Page Vendor -->

<script src={{ asset('/assets/vendor/datatables/media/js/jquery.dataTables.min.js') }}></script>
<script src={{ asset('/assets/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}></script>

<!-- Examples -->
<script src={{ asset('/assets/js/examples/examples.header.menu.js') }}></script>
<script src={{ asset('/assets/js/examples/examples.ecommerce.dashboard.js') }}></script>
<script src={{ asset('/assets/js/examples/examples.ecommerce.datatables.list.js') }}></script>

<!-- Specific Page Vendor -->
<script src={{ asset('/assets/vendor/jquery-appear/jquery.appear.js') }}></script>
<script src={{ asset('/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.js') }}></script>
<script src={{ asset('/assets/vendor/flot/jquery.flot.js') }}></script>
<script src={{ asset('/assets/vendor/flot.tooltip/jquery.flot.tooltip.js') }}></script>
<script src={{ asset('/assets/vendor/flot/jquery.flot.pie.js') }}></script>
<script src={{ asset('/assets/vendor/flot/jquery.flot.categories.js') }}></script>
<script src={{ asset('/assets/vendor/flot/jquery.flot.resize.js') }}></script>
<script src={{ asset('/assets/vendor/jquery-sparkline/jquery.sparkline.js') }}></script>
<script src={{ asset('/assets/vendor/raphael/raphael.js') }}></script>
<script src={{ asset('/assets/vendor/morris/morris.js') }}></script>
<script src={{ asset('/assets/vendor/gauge/gauge.js') }}></script>
<script src={{ asset('/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}></script>
<script src={{ asset('/assets/vendor/snap.svg/snap.svg.js') }}></script>
<script src={{ asset('/assets/vendor/liquid-meter/liquid.meter.js') }}></script>
<script src={{ asset('/assets/vendor/chartist/chartist.js') }}></script>

<!-- Theme Base, Components and Settings -->
<script src={{ asset('/assets/js/theme.js') }}></script>

<!-- Theme Custom -->
<script src={{ asset('/assets/js/custom.js') }}></script>

<!-- Theme Initialization Files -->
<script src={{ asset('/assets/js/theme.init.js') }}></script>

<style>
    #ChartistCSSAnimation .ct-series.ct-series-a .ct-line {
        fill: none;
        stroke-width: 4px;
        stroke-dasharray: 5px;
        -webkit-animation: dashoffset 1s linear infinite;
        -moz-animation: dashoffset 1s linear infinite;
        animation: dashoffset 1s linear infinite;
    }

    #ChartistCSSAnimation .ct-series.ct-series-b .ct-point {
        -webkit-animation: bouncing-stroke 0.5s ease infinite;
        -moz-animation: bouncing-stroke 0.5s ease infinite;
        animation: bouncing-stroke 0.5s ease infinite;
    }

    #ChartistCSSAnimation .ct-series.ct-series-b .ct-line {
        fill: none;
        stroke-width: 3px;
    }

    #ChartistCSSAnimation .ct-series.ct-series-c .ct-point {
        -webkit-animation: exploding-stroke 1s ease-out infinite;
        -moz-animation: exploding-stroke 1s ease-out infinite;
        animation: exploding-stroke 1s ease-out infinite;
    }

    #ChartistCSSAnimation .ct-series.ct-series-c .ct-line {
        fill: none;
        stroke-width: 2px;
        stroke-dasharray: 40px 3px;
    }

    @-webkit-keyframes dashoffset {
        0% {
            stroke-dashoffset: 0px;
        }

        100% {
            stroke-dashoffset: -20px;
        };
    }

    @-moz-keyframes dashoffset {
        0% {
            stroke-dashoffset: 0px;
        }

        100% {
            stroke-dashoffset: -20px;
        };
    }

    @keyframes dashoffset {
        0% {
            stroke-dashoffset: 0px;
        }

        100% {
            stroke-dashoffset: -20px;
        };
    }

    @-webkit-keyframes bouncing-stroke {
        0% {
            stroke-width: 5px;
        }

        50% {
            stroke-width: 10px;
        }

        100% {
            stroke-width: 5px;
        };
    }

    @-moz-keyframes bouncing-stroke {
        0% {
            stroke-width: 5px;
        }

        50% {
            stroke-width: 10px;
        }

        100% {
            stroke-width: 5px;
        };
    }

    @keyframes bouncing-stroke {
        0% {
            stroke-width: 5px;
        }

        50% {
            stroke-width: 10px;
        }

        100% {
            stroke-width: 5px;
        };
    }

    @-webkit-keyframes exploding-stroke {
        0% {
            stroke-width: 2px;
            opacity: 1;
        }

        100% {
            stroke-width: 20px;
            opacity: 0;
        };
    }

    @-moz-keyframes exploding-stroke {
        0% {
            stroke-width: 2px;
            opacity: 1;
        }

        100% {
            stroke-width: 20px;
            opacity: 0;
        };
    }

    @keyframes exploding-stroke {
        0% {
            stroke-width: 2px;
            opacity: 1;
        }

        100% {
            stroke-width: 20px;
            opacity: 0;
        };
    }
</style>
<script src={{ asset('/assets/js/examples/examples.charts.js') }}></script>

