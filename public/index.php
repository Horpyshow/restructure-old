           $result = @mysqli_query($dbcon, $query);

                                while ($block = @mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    $block_name = $block["block_name"];
                                    $block_id = $block["block_id"];
                                    
                                    $query3 = "SELECT * ";
                                    $query3 .= "FROM customers ";
                                    $query3 .= "WHERE shop_no != '' ";
                                    $query3 .= "AND shop_block = '$block_name' ";
                                    $query3 .= "AND facility_status = 'active'";
                                    $new_result = @mysqli_query($dbcon, $query3);
                                    $shops_per_block = @mysqli_num_rows($new_result);
                                    
                                    if($shops_per_block != 0) {
                                        echo '<a href="mod/leasing/mpr_active_block_analysis.php?block_id='.$block_id.'" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors btn-modern">'.$block_name.': '.$shops_per_block.' space(s)</a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Dropdown hover functionality
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.dropdown-menu');
            
            dropdown.addEventListener('mouseenter', () => {
                menu.classList.remove('hidden');
            });
            
            dropdown.addEventListener('mouseleave', () => {
                menu.classList.add('hidden');
            });
        });

        // Loading overlay
        function showLoading() {
            document.querySelector('.loading-overlay').style.display = 'flex';
        }

        function hideLoading() {
            document.querySelector('.loading-overlay').style.display = 'none';
        }

        // Hide loading on page load
        window.addEventListener('load', hideLoading);

        // Show loading on form submissions and link clicks
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', showLoading);
        });

        document.querySelectorAll('a[href]:not([href^="#"])').forEach(link => {
            link.addEventListener('click', showLoading);
        });
    </script>

    <!-- Legacy JavaScript Functions -->
    <script type="text/javascript">
    function appid2(id)
    {
        if(confirm('Are you sure you have verified that this shop is vacant?'))
        {
            window.location.href='mod/leasing/vacant_shop_processing.php?appid2='+id;
        }
    }
    function appid3(id)
    {
        if(confirm('Are you sure you want to approve and declared this shop as vacant?'))
        {
            window.location.href='mod/leasing/vacant_shop_processing.php?appid3='+id;
        }
    }
    $('#stats').ready 
        (function statRefresh() {
        var $statboard = $("#stats");
        setInterval(function statRefresh() {
        $statboard.load("index.php #stats");
        }, 180000);
    })
    //60000 - 1mins
    //1000 - 1secs
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });
    });
    </script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '#delete_record', function(e){
                
                var vshopId = $(this).data('id');
                SwalDelete(vshopId);
                e.preventDefault();
            });
            
        });
        
        function SwalDelete(vshopId){
            
            swal({
                title: 'Are you sure?',
                text: "It will be reversed to active shops!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reverse it!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve) {
                       
                     $.ajax({
                        url: 'mod/leasing/delete_vacant_shop_declaration.php',
                        type: 'POST',
                           data: 'delete='+vshopId,
                           dataType: 'json'
                     })
                     .done(function(response){
                        swal('Shop remains active!', response.message, response.status);
                        reloadPage();
                     })
                     
                     .fail(function(){
                        swal('Oops...', 'Something went wrong, record not reversed!', 'error');
                     });
                  });
                },
                allowOutsideClick: false			  
            });	
            
            function reloadPage(){
                //window.location.href='index.php';
    //			$( "#container" ).load(window.location.href + " #container" );
    //location.reload();
    setTimeout(function () {
            location.reload()
        }, 2000);
            }
        }
    </script>

    <script>
    $(document).ready(function(){
            $(document).on('click', '#resolved_rbtn', function(e){
                
                var resId = $(this).data('id');
                Swalresrecord(resId);
                e.preventDefault();
            });
            
        });
        function Swalresrecord(resId){
            
            swal({
                title: 'Are you sure?',
                text: "An automatic email will be sent to Control and CE!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, It is resolved!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve) {
                       
                     $.ajax({
                        url: 'mod/leasing/resolved_record_declaration.php',
                        type: 'POST',
                           data: 'resolveid='+resId,
                           dataType: 'json'
                     })
                     .done(function(response){
                        swal('Notification sent, awaiting confirmation!', response.message, response.status);
                        
                     })
                     
                     .fail(function(){
                        swal('Oops...', 'Something went wrong, notification not sent!', 'error');
                     });
                  });
                },
                allowOutsideClick: false			  
            });		
    function reloadPage(){
    setTimeout(function () {
            location.reload()
        }, 2000);
            }
        }
    </script>

    <script>
    $(document).ready(function(){
            $(document).on('click', '#confirmation_rbtn', function(e){
                
                var conId = $(this).data('id');
                Swalconrecord(conId);
                e.preventDefault();
            });
            
        });
        function Swalconrecord(conId){
            
            swal({
                title: 'Are you sure?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, It is confirmed!',
                showLoaderOnConfirm: true,
                  
                preConfirm: function() {
                  return new Promise(function(resolve) {
                       
                     $.ajax({
                        url: 'mod/leasing/confirmed_record_declaration.php',
                        type: 'POST',
                           data: 'confirmid='+conId,
                           dataType: 'json'
                     })
                     .done(function(response){
                        swal('Record Successfully Confirmed!', response.message, response.status);
                        
                     })
                     
                     .fail(function(){
                        swal('Oops...', 'Something went wrong!', 'error');
                     });
                  });
                },
                allowOutsideClick: false			  
            });		
    function reloadPage(){
    setTimeout(function () {
            location.reload()
        }, 2000);
            }
        }
        
        
    $(document).ready(function(){  
          $('#tb_unresolved_issues').DataTable(
          {"pageLength": 4}
          );  
     });
    </script>
    <?php ob_end_flush(); ?>
</body>
</html>