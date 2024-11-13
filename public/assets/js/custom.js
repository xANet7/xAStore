
(function () {
    "use strict";

    /* tooltip */
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    /* header theme toggle */
    function toggleTheme() {
        let html = document.querySelector('html');
        if (html.getAttribute('data-theme-mode') === "dark") {
            html.setAttribute('data-theme-mode', 'light');
            html.setAttribute('data-header-styles', 'light');
            html.setAttribute('data-menu-styles', 'light');
            html.removeAttribute('data-bg-theme');
            html.removeAttribute('style');
            document.querySelector('html').style.removeProperty('--body-bg-rgb', localStorage.bodyBgRGB);
            localStorage.removeItem("ynexdarktheme");
            localStorage.removeItem("ynexMenu");
            localStorage.removeItem("ynexHeader");
            localStorage.removeItem("bodylightRGB");
            localStorage.removeItem("bodyBgRGB");
            if(localStorage.getItem("ynexlayout")!= "horizontal"){
                html.setAttribute("data-menu-styles", "dark");
            }
            html.setAttribute("data-header-styles", "light");
        } else {
            html.setAttribute('data-theme-mode', 'dark');
            html.setAttribute('data-header-styles', 'dark');
            html.setAttribute('data-menu-styles', 'dark');
            localStorage.setItem("ynexdarktheme", "true")
            localStorage.setItem("ynexMenu", "dark")
            localStorage.setItem("ynexHeader", "dark")
            localStorage.removeItem("bodylightRGB")
            localStorage.removeItem("bodyBgRGB")
        }
    }
    let layoutSetting = document.querySelector(".layout-setting")
    layoutSetting.addEventListener("click", toggleTheme);
    /* header theme toggle */

    /* footer year */
    document.getElementById("year").innerHTML = new Date().getFullYear();
    /* footer year */

    /* node waves */
    Waves.attach('.btn-wave', ['waves-light']);
    Waves.init();
    /* node waves */

    /* back to top */
    const scrollToTop = document.querySelector(".scrollToTop");
    const $rootElement = document.documentElement;
    const $body = document.body;
    window.onscroll = () => {
        const scrollTop = window.scrollY || window.pageYOffset;
        const clientHt = $rootElement.scrollHeight - $rootElement.clientHeight;
        if (window.scrollY > 100) {
            scrollToTop.style.display = "flex";
        } else {
            scrollToTop.style.display = "none";
        }
    };
    scrollToTop.onclick = () => {
        window.scrollTo(0, 0);
    };
    /* back to top */

    var myHeadernotification = document.getElementById('header-notification-scroll');
    new SimpleBar(myHeadernotification, { autoHide: true });
})();

/* full screen */
var elem = document.documentElement;
function openFullscreen() {
    let open = document.querySelector('.full-screen-open');
    let close = document.querySelector('.full-screen-close');

    if (!document.fullscreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement)  {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.webkitRequestFullscreen) { /* Safari */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE11 */
            elem.msRequestFullscreen();
        }
        close.classList.add('d-block')
        close.classList.remove('d-none')
        open.classList.add('d-none')
    }
    else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) { /* Safari */
            document.webkitExitFullscreen();
            console.log("working");
        } else if (document.msExitFullscreen) { /* IE11 */
            document.msExitFullscreen();
        }
        close.classList.remove('d-block')
        open.classList.remove('d-none')
        close.classList.add('d-none')
        open.classList.add('d-block')
    }
}
/* full screen */






