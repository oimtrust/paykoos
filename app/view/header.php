<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Paykoos</title>

    <!-- Bootstrap Core CSS-->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="asset/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="asset/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="asset/js/jquery.js"></script>
    <script src="asset/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="asset/js/bootstrap.min.js"></script>
    <script src="asset/js/bootstrap-datetimepicker.js"></script>
    <script src="asset/js/bootstrap-datetimepicker.min.js" media="screen"></script>
    <script src="asset/js/bootstrap-datetimepicker.id.js" media="screen"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    <!-- Js Contact Form -->
    <script src="asset/js/jqBootstrapValidation.js"></script>
    <script src="asset/js/contact_me.js"></script>

    <!-- Js maskMoney And Custom-->
    <script src="asset/js/jquery.maskMoney.min.js"></script>
    <script src="asset/js/custom.js"></script> 
    

    <script type="text/javascript">
        $(document).ready(function()
        {
            //Untuk dynamix selectbox owner-payment-add.php
            $("#id_class").change(function() {
                var id=$(this).val();
                var dataString = 'id='+ id;

                $.ajax
                ({
                    type: "POST",
                    url: "owner-payment-add-dynamic_room.php",
                    data: dataString,
                    dataType : 'JSON',
                    cache: false,
                    success: function(responses)
                    {
                        //untuk mengisi data kelasnya
                        $('#prices').val(responses.price)

                        //untuk isi selectbox
                        $('#id_room').find('option').remove();
                        $('#id_room').append('<option selected="selected">--Select Room--</option>');
                        $.each(responses.room_name, function(key, val){
                            $('#id_room').append('<option value="'+val.id_room+'">'+val.room_name+'</option>');
                        });
                        //console.log(responses.price);
                    }
                });
            });

            $("#id_room").change(function()
            {
                var id=$(this).val();
                var dataString = 'id_room='+ id;
            
                $.ajax
                ({
                    type: "POST",
                    url: "owner-payment-add-dynamic_renter.php",
                    data: dataString,
                    cache: false,
                    success: function(html)
                    {
                        $("#id_renter").html(html);
                    } 
                });
            });

             $('.form_date').datetimepicker({
                language:  'id',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        });

        
    </script>

    <script type="text/javascript">
        function sum() {
            var pricecls    = document.getElementById('prices').value;
            var tmonth      = document.getElementById('total_month').value;
            var payprice    = document.getElementById('payment').value;
            var total       = parseInt(pricecls) * parseInt(tmonth) + parseInt(payprice);
            if (!isNaN(total)) {
                 document.getElementById('total').value = total;
            };
            //document.getElementById('total').value = fullTotal;
        }
    </script>
</head>

<body>