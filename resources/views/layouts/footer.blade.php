@if (
    Request::path() == '/'
||  Request::path() == 'login'
||  Request::path() == 'generate'
)
<div class="footer footer-fixed site_bg footer-copyright">
    Disclaimer: All resources in this project are used for educational purposes | Project in IT199R-2 OJT Project
</div>
@elseif(Request::path() == 'contact' ||  Request::path() == 'about')
    <div id="fixed" class="footer site_bg footer-copyright">
        Disclaimer: All resources in this project are used for educational purposes | Project in IT199R-2 OJT Projecth3
    </div>
@else
    <div class="footer site_bg footer-copyright">
        Disclaimer: All resources in this project are used for educational purposes | Project in IT199R-2 OJT Project
    </div>
@endif



