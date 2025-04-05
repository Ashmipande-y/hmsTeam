<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Request</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include("../include/header.php"); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="padding-left: 0;">
                <?php include("sidenav.php"); ?>
            </div>

            <div class="col-md-10">
                <h5 class="text-center my-3">Job Request</h5>
                <div id="show"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            show();

            function show(){
                $.ajax({
                    url: "ajax_job_request.php",
                    method: "POST",
                    success: function(data){
                        $("#show").html(data);
                    }
                });
            }

            $(document).on('click', '.approve', function(){
                var id = $(this).attr("id");
                if (confirm("Are you sure you want to approve this request?")) {
                    $.ajax({
                        url: "ajax_approve.php",
                        method: "POST",
                        data: {id: id},
                        success: function(){
                            show();
                        }
                    });
                }
            });

            $(document).on('click', '.reject', function(){
                var id = $(this).attr("id");
                if (confirm("Are you sure you want to reject this request?")) {
                    $.ajax({
                        url: "ajax_reject.php",
                        method: "POST",
                        data: {id: id},
                        success: function(){
                            show();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
