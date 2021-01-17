$(document).ready(function(){

    /**
     * Tab notas de crédito
     ----------------------------------*/

     $('#AddInvoiceCredit').hide();

     $('#creditNoteAddInvoiceCredit').on('click',(e)=>{
         e.preventDefault();

         $('#creditNoteAddRefundTab').removeClass('tab-open');
         $('#AddRefund').hide();
        
         $('#AddInvoiceCredit').slideDown();
         $('#creditNoteAddInvoiceCredit').addClass('tab-open');
     })

     $('#creditNoteAddRefundTab').on('click',(e)=>{
        e.preventDefault();

        $('#creditNoteAddInvoiceCredit').removeClass('tab-open');
        $('#AddInvoiceCredit').hide();
       
        $('#AddRefund').slideDown();
        $('#creditNoteAddRefundTab').addClass('tab-open');
     })
})