{{--  
    CSS AND  DEPENDECIES REQUIRED TO RUN DATA TABLES, INLCUDE THIS IN 
    VIEWS REQUIRING DATA TABLES
--}}
<style>
    .dataTables_length, .dataTables_filter{
        /*margin: 20px;*/
        padding: 30px;
    }
    
    .dataTables_filter  input{
        border: 1px solid rgb(183, 183, 183) !important;
        background-color: rgb(255, 255, 255) !important;
        width: 200px !important;
        padding-left: 0;
    }
    .dataTables_filter  label{
        font-weight: 400;
    }
    .dataTables_paginate  span a{
        background-color: rgb(255, 255, 255) !important;
        border: 0px !important;
        background: none !important;
    }
    .dataTables_paginate .paginate_button:hover {
        background-color: #daeeff !important;
    }
    .dataTables_paginate a.next:hover{
        border: 0 !important;
        background: #8ba7c0 !important;
        color: black !important;
        
    }

    .dataTables_paginate a.previous:hover{
        border: 0 !important;
        background: #8ba7c0 !important;
        
    }

    .dataTables_info{
        padding-left: 10px !important; 
    }
    .dataTables_paginate{
        padding-right: 10px !important; 
    }


    /* Make the header row sticky */
.sticky-header {
    position: sticky !important;
    top: 0 !important;
    background-color: white !important; /* Set your desired background color */
    z-index: 2 !important; /* Adjust the z-index as needed to control layering */
}



</style>


<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            order: [[0, 'desc']]
        });
    } );

        new DataTable('#loanApplicationTable', {
            fixedColumns: {
            left: 5,
        },
        order: [[0, 'desc']],
        paging: true,
        scrollCollapse: true,
        scrollX: true,
        scrollY: 300
    });

    

    

    $(document).ready(function() {
        $("#applyFilterBtn").click(function() {
            var campusValue = $("#campusSelect").val();
            var unitValue = $("#unitSelect").val();

            $(".admin-table tbody tr").each(function() {
                var campus = $(this).find("td:nth-child(4)").text();
                var unit = $(this).find("td:nth-child(5)").text();

                if ((campusValue === "All" || campusValue === campus) && (unitValue === "All" || unitValue === unit)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

   

</script>