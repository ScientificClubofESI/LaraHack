<div class="container-fluid footer" id="contact" style="background-color: #FBFBFB;">
    <div class="row footer-row">
        <div class="col-12">
            <a href="#" class="footer-title">
                {{ config('app.name') }}
            </a>
        </div>
    </div>

    <div class="row footer-row footer-info">
        <div class="col-12">
            cse@esi.dz
        </div>



        <div class="col-12">
            Copyright ©
            <script>
                document.write(new Date().getFullYear())
            </script> {{ config('app.name') }}
        </div>

        <div class="col-12">
            <a href="#" target="_blank"><img src="{{asset('images/LOGO.png')}} " style="padding-top: 2em; width: 15%;"></a>
        </div>
    </div>

    <div class="row footer-row justify-content-around footer-social-links">
        <div class="col-sm-3 col-12">
            <a href="#" target="_blank">Facebook</a>
        </div>

        <div class="col-sm-3 col-12">
            <a href="#" target="_blank">Twitter</a>
        </div>

        <div class="col-sm-3 col-12">
            <a href="#" target="_blank">LinkedIn</a>
        </div>
        <div class="col-sm-3 col-12">
            <a href="#" target="_blank">Instagram</a>
        </div>
    </div>

</div>