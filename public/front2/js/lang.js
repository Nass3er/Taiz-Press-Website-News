
let lang = localStorage.getItem('lang');

document.addEventListener('DOMContentLoaded',()=>{
   if(lang) {
      if(lang == 'ar') {
         document.documentElement.lang = 'ar';
         document.documentElement.dir = 'rtl';
         console.log(lang,'=','ar');
      } else {
         document.documentElement.lang = 'en';
         document.documentElement.dir = 'ltr';
         console.log(lang,'=','en');
      }
   }
})