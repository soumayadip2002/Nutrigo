const alert = document.querySelector('.alert');
const close_alert = document.querySelector('#alert_close');

close_alert.addEventListener('click', ()=>{
    alert.style.display = 'none';
});


setTimeout(()=>{
    alert.style.display='none';
}, 3000);