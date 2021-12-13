@extends ('../../layouts/app')
@section('title')
    Transactions - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="deals-tab" class="tab-list">
                            <li>
                                <a class="active" href="#" data-title="In Progress" data-status="progress">In Progress</a>
                            </li>
                            <li>
                                <a href="#" data-title="Completed" data-status="completed">Completed</a>
                            </li>
                            <li>
                                <a href="#" data-title="Pending Payment" data-status="payment">Pending Payment</a>
                            </li>
                            <li>
                                <a href="#" data-title="Cancelled" data-status="cancelled">Cancelled</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div id="deals-table" class="deals-table">
                            <div class="filter-title">
                                In Progress Deals
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover w-100">
                                    <thead>
                                        <td>Product</td>
                                        <td>Product Title</td>
                                        <td>Deal Started on</td>
                                    </thead>
                                    <tbody id="table-data-body">
                                    </tbody>
                                </table>
                            </div>
                            <div id="load-more" class="text-center mb-3">
                                <button class="btn btn-primary">
                                    Load More
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {
            var page_url="{{url('/trading/status')}}";
            var base_url = "{{url('/')}}";
            var pg_url = "{{url('/trading/status')}}";
            var status = "progress";
            function load_data(){
                if(page_url!=null && page_url!=""){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: page_url,
                        method: 'POST',
                        data : {
                            status: status
                        },
                        success: function(result){
                            result.listings.data.forEach((item)=>{
                                var tr = document.createElement('tr');
                                {{-- Creating First Column --}}
                                var td = document.createElement('td');
                                var img = document.createElement('img');
                                img.classList.add('product_img');
                                img.setAttribute('src',base_url+'/'+item.product_img);
                                td.append(img);

                                tr.appendChild(td);

                                {{-- Creating Second Column --}}
                                td = document.createElement('td');
                                td.innerHTML="<a href='"+base_url+"/listing/"+item.slug+"'>"+item.product_title+"</a>";
                                tr.appendChild(td);
                                

                                
                                {{-- Creating Fourth Column --}}
                                td = document.createElement('td');
                                var date = Date.createFromMysql(item.created_at);
                                td.innerHTML= date.getDate()+" "+date.toLocaleString('en-us', { month: 'long' })+", "+date.getFullYear();
                                tr.appendChild(td);
                                

                                $("#table-data-body").append(tr);
                            });
                            //console.log("###########"+result.listing.next_page_url);
                            page_url = result.listings.next_page_url;
                            if(page_url==null){
                                $("#load-more").fadeOut();
                            }
                        },
                        error: function (request, status, error) {
                            $('#form-alert').addClass('alert-danger');
                            $('#alert-message').text('There is an error in submitting the form, please try again later!');
                            $('#form-alert').show();
                        }
                    });
                }
            }
            $("#load-more").hide();
            load_data();
            $("#load-more").click(function(){
                load_data();
            });
            $("#deals-tab li a").click(function(){
               status = $(this).data('status');
               $("#table-data-body").children('tr').remove();
               page_url = pg_url;
               load_data();
            });
        }); 
    </script>
    @endsection
