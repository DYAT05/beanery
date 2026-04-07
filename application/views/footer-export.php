
			</div>

</section>

<!-- Vendor -->
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>


</body>
</html>
<script type="text/javascript">
$(function(){
$("#datatable-default-tools").DataTable({
dom: 'Bfrtip',
buttons: [
    'copyHtml5',
    'excelHtml5',
    'csvHtml5',
    'pdfHtml5',
    'pageLength'
],
		lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
});
})
$("#submitbtnchange").click(function(){
$.post('<?= base_url().'index.php/'.$this->uri->segment(1) ?>/execChangePassword',
        {	
            oldpassword : $("#oldpassword").val(),
            newpassword : $("#newpassword").val(),
            re_newpassword : $("#re_newpassword").val()
        },
        function(data){
            console.log(data);
            if(data == "success"){
                alert("Your password has been successfully updated.");

                location.reload();
            } else if(data == "matchissue") {
                alert("New password and repeat new password do not match. Please try again.");
            } else if(data == "oldissue") {
                alert("Your old password you entered is incorrect. Please try again.");
            }
        }
    );
});
</script>