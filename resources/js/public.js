import './bootstrap';

window.Echo.channel('vouchers')
.listen('VoucherCreated', (event) => {
    console.log(event);
    alert(`New voucher: ${event.title} - ${event.discount} % discount!`);
});