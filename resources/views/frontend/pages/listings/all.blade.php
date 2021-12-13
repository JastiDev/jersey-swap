@extends ('../../layouts/app')
@section('title')
    Listings - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <ul id="deals-tab" class="tab-list">
                            <li>
                                <a class="active" href="#" data-title="Listings" data-change="false">Listings</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{url('/listings/add-listing')}}" class="btn btn-success">Add New Listing</a>
                    </div>
                    <div class="col-md-12">
                        <div id="deals-table" class="deals-table">
                            <div class="filter-title">
                                Listings
                            </div>
                            <div class="table-responsive">
                                <table id="table-data" class="table table-hover w-100">
                                    <thead>
                                        <td>Photo</td>
                                        <td>Product Title</td>
                                        <td>Status</td>
                                        <td>Created at</td>
                                    </thead>
                                    <tbody>
                                        {{-- Table Data --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center mb-3">
                                <button id="load-more" class="btn btn-primary" style="display:none;">
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
            var page_url="{{url('/my/listings')}}";
            var base_url = "{{url('/')}}";
            function load_data(){
                if(page_url!=null && page_url!=""){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: page_url,
                        method: 'GET',
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
                                

                                {{-- Creating Third Column --}}
                                td = document.createElement('td');
                                if(item.status=="cancelled"){
                                     td.innerHTML='<span class="badge bg-danger">Cancelled</span>';
                                }
                                else if(item.status=="closed"){
                                     td.innerHTML='<span class="badge bg-danger">Closed</span>';
                                }
                                else{
                                     td.innerHTML='<span class="badge bg-dark">'+item.status+'</span>';
                                }
                                tr.appendChild(td);

                                
                                {{-- Creating Fourth Column --}}
                                td = document.createElement('td');
                                var date = new Date(item.created_at);
                                td.innerHTML= date.getDate()+" "+date.toLocaleString('en-us', { month: 'long' })+", "+date.getFullYear();
                                tr.appendChild(td);
                                

                                $("#table-data tbody").append(tr);
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
            load_data();
            $("#load-more").click(function(){
                load_data();
            });
        }); 
    </script>
    @endsection
