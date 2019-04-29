// Shrink Navbar on Scroll
window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("navbar").style.padding = "5px 10px";
        document.getElementById("navbar").classList.remove("shadow-none");
    } else {
        document.getElementById("navbar").style.padding = "20px 10px";
        document.getElementById("navbar").classList.add("shadow-none");
    }
}

// initialize AOS
var AOS = require('aos');
AOS.init({
    duration: 700,
    once: true,
});