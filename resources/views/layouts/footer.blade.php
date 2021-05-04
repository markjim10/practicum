@if (
    Request::path() == '/'
||  Request::path() == 'login'
||  Request::path() == 'generate'
||  Request::path() == 'schedule'

)
<div class="footer footer-fixed site_bg footer-copyright">
    Disclaimer: All resources in this project are used for educational purposes | Practicum Project | Mark Jim Domondon
</div>
@elseif(Request::path() == 'contact' ||  Request::path() == 'about')
    <div id="fixed" class="footer site_bg footer-copyright">
        Disclaimer: All resources in this project are used for educational purposes | Practicum Project | Mark Jim Domondon
    </div>
@else
    <div class="footer site_bg footer-copyright">
        Disclaimer: All resources in this project are used for educational purposes | Practicum Project | Mark Jim Domondon
    </div>
@endif



