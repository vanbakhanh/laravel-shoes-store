/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

// DataTable
require('datatables.net/js/jquery.dataTables');
require('datatables.net-bs4/js/dataTables.bootstrap4');

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