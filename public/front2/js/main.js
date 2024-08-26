const menuBtn = document.querySelector('.menu');
const menu = document.querySelector('.mobile');
const language = document.querySelector('.language');
const toUpBtn = document.querySelector('.to-up');
let langu = localStorage.getItem('lang');

// document.addEventListener('DOMContentLoaded',()=>{
//    if(langu) {
//       if(langu == 'ar') {
//          language.selectedIndex  = 0;
//       } else {
//          language.selectedIndex  = 1;
//       }
//    }
// })

menuBtn.onclick = ()=>{
   menu.classList.toggle('active');
}

 
// language.onchange = (e)=>{
//    if(e.target.value == 'ar') {
//       document.documentElement.lang = 'ar';
//       document.documentElement.dir = 'rtl';
//       localStorage.setItem('lang','ar');
//    } else {
//       document.documentElement.lang = 'en';
//       document.documentElement.dir = 'ltr';
//       localStorage.setItem('lang','en');
//    }

// }

$(document).ready(function() {
   $('.mobile li a').click(function() {
     $('.mobile li a').removeClass('active'); // Remove active class from all links
     $(this).addClass('active'); // Add active class to the clicked link
   });
 });
 
 
document.onscroll = (e)=> {
   if(scrollY >= 1000) {
      toUpBtn.classList.add('active');
   } else {
      toUpBtn.classList.remove('active')
   }
}



toUpBtn.onclick = ()=>{
   scrollTo({
      top:0,
      behavior: "smooth"
   });
}

// var copyLinkButtons = document.querySelectorAll('.copy-link-button');

//     copyLinkButtons.forEach(function (button) {
//         var postUrl = button.getAttribute('data-post-url');

//         button.addEventListener('click', function (event) {
//             event.preventDefault();

//             var tempInput = document.createElement('input');
//             tempInput.value = postUrl;
//             document.body.appendChild(tempInput);
//             tempInput.select();
//             document.execCommand('copy');
//             document.body.removeChild(tempInput);

//             alert('Link copied!');
//         });
//     });

var copyLinkButtons = document.querySelectorAll('.copy-link-button');
var alertElement = document.getElementById('alert');
var alertMessageElement = document.getElementById('alert-message');

copyLinkButtons.forEach(function (button) {
    var postUrl = button.getAttribute('data-post-url');

    button.addEventListener('click', function (event) {
        event.preventDefault();

        var tempInput = document.createElement('input');
        tempInput.value = postUrl;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Show the success alert by adding the 'show' class
        alertElement.classList.add('show');

        // Set the alert message
      //   alertMessageElement.textContent = 'Link Copied!';

        // Disable the copy link button temporarily
        button.disabled = true;

        // Re-enable the copy link button and hide the success alert after 3 seconds
        setTimeout(function() {
            alertElement.classList.remove('show');
            button.disabled = false;
        }, 3000); // 3 seconds
    });
});
