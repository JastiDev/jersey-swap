@extends ('../../layouts/app')
@section('title')
    Offers - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="deals-tab" class="tab-list">
                            <li>
                                <a class="active" href="#" data-title="Pending" data-status="posted">Pending</a>
                            </li>
                            <li>
                                <a href="#" data-title="Accepted" data-status="closed">Accepted</a>
                            </li>
                            <!-- <li>
                                <a href="#" data-title="Direct Buy" data-status="buyRequest">Direct Buy</a>
                            </li> -->
                            <li>
                                <a href="#" data-title="Cancelled" data-status="cancelled">Declined</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div id="deals-table" class="deals-table">
                            <!-- <div class="filter-title">
                                Posted offers
                            </div> -->
                            <div class="table-responsive">
                                <table class="table table-hover w-100" style="text-align:center;">
                                    <thead>
                                        <td>Listing</td>
                                        <td>Trade</td>
                                        <td>Username</td>
                                        <td>Amount</td>
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
            var page_url="{{url('/offers/status')}}";
            var base_url = "{{url('/')}}";
            var pg_url = "{{url('/offers/status')}}";
            var status = "posted";
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
                            console.log(result);
                            result.offers.forEach((item)=>{
                                var tr = document.createElement('tr');

                                {{-- Creating First Column --}}
                                var td = document.createElement('td');
                                var imgA = document.createElement('a');
                                imgA.setAttribute('href', "{{url('/listing')}}/" + item.slug);
                                var img = document.createElement('img');
                                img.classList.add('product_img');
                                img.setAttribute('src',base_url+'/'+item.product_img);
                                imgA.append(img);
                                td.append(imgA);

                                tr.appendChild(td);

                                {{-- Creating Second Column --}}
                                td = document.createElement('td');
                                
                                if(item.gallery.length>0){
                                    item.gallery.forEach(element => {
                                        var imgA = document.createElement('a');
                                        imgA.setAttribute('href', "{{url('/storage/offers')}}/" + element.image);
                                        imgA.setAttribute('target', '_blank');

                                        var imgProd = document.createElement("img");
                                        imgProd.setAttribute("src", "{{asset('storage/offers')}}/"+element.image);
                                        imgProd.classList.add('product_img');
                                        imgProd.alt = "...";
                                        imgA.append(imgProd);
                                        td.append(imgA);
                                    });
                                }
                                tr.appendChild(td);

                                {{-- Creating Third Column --}}
                                td = document.createElement('td');
                                td.innerHTML="<span class='text-center'>"+item.username+"</span>";
                                tr.appendChild(td);

                                tr.appendChild(td);
                                
                                {{-- Creating Fourth Column --}}
                                td = document.createElement('td');
                                td.innerHTML="<span class='text-center'> $"+item.offer_price+"</span>";
                                tr.appendChild(td);
                                

                                $("#table-data-body").append(tr);
                            });
                            //console.log("###########"+result.listing.next_page_url);
                            page_url = result.offers.next_page_url;
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
