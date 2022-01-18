@extends ('../../layouts/app')
@section('title')
    Listings - Jersey Swap
@endsection
@section('meta_description')
    Swap your jersey and find best offers for your listing.
@endsection
@section('content')
   <section id="heading" class="mt-5"><div class="container">
          <div class="row exchange-header">
              <div class="col-md-5">
                  <h1>Available Exchange</h1>
                  <div class="divider"></div>
              </div>
              <div class="col-md-4">
                <ul id="category-tab" class="nav nav-pills">
                  <li class="nav-item">
                    <a id="categoryAll" class="nav-link active" aria-current="page">All</a>
                  </li>
                  <li class="nav-item">
                    <a id="categoryJersey" class="nav-link">Sports Jerseys</a>
                  </li>
                  <li class="nav-item">
                    <a id="categoryCard" class="nav-link">Sports Cards</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-2">
                <input type="text" class="form-control" id="search_keyword" placeholder="Search..." name="search_keyword" required>
              </div>
          </div>
      </div>
  </section>

  <section id="products" class="mt-2 mb-5">
      <div class="container">
          <div id="listing" class="row">
              <!-- @foreach($listing as $list)
                  <div class="col-md-3 mb-2">
                      <div class="card product-card">
                          <a href="{{url('/exchange/'.$list->slug)}}">
                              <img src="{{asset(url('/'.$list->product_img))}}" class="card-img-top" alt="...">
                          </a>
                          <div class="card-body">
                              <div class="mb-2">
                                  <h6 class="font-weight-semibold mb-2 product-title">
                                      <a href="{{url('/exchange/'.$list->slug)}}" class="text-default mb-2" data-abc="true">
                                      {{$list->product_title}}
                                      </a>
                                  </h6>
                              </div>
                              <div class="product-meta d-flex flex-row">
                                  <div class="user-avatar p-1">
                                      <img src="{{ static_url('avatar/'.$list->user->profile_picture) }}" class="avatar">
                                  </div>
                                  <div class="user-name align-self-center">
                                      By <a href="{{url('user/'.$list->owner->username)}}">{{$list->user->f_name." ".$list->user->l_name}}</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach -->
          </div>
          <div class="row">
              <div class="col-md-12 mt-5">
                  <div class="d-flex justify-content-center">
                    <nav>
                      <ul id="paginav" class="pagination"></ul>
                    </nav>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection

@section('custom-scripts')
  <script>
    $(document).ready(function() {
      var listing = {!! json_encode($listing) !!};
      var index = 1;
      var pageSize = 12;
      var category = -1;
      var keyword = '';

      function load_data () {
        $("#listing").empty();
        var listingData = listing;
        if(category > -1){
          listingData = listingData.filter(item => item.category == category);
        }
        
        if(keyword != ''){
          listingData = 
            listingData.filter(item => item.product_title.toLowerCase().includes(keyword.toLowerCase()) 
            || item.product_description.toLowerCase().includes(keyword.toLowerCase()));
        }
        var filtered = listingData.slice((index - 1) * pageSize, index * pageSize)
        filtered.forEach((list)=>{
          var ret = document.createElement('div');
          ret.className = "col-md-3 mb-2";
          
          var cardDiv = document.createElement('div');
          cardDiv.className = "card product-card";
          var imgA = document.createElement('a');
          imgA.setAttribute('href', "{{url('/exchange')}}/" + list.slug);
          
          var imgProd = document.createElement("img");
          imgProd.setAttribute("src", "{{static_url('/')}}products_featured/"+list.product_img);
          imgProd.className = "card-img-top";
          imgProd.alt = "...";
          imgA.append(imgProd);
          cardDiv.append(imgA);
          var cardBody = document.createElement('div');
          cardBody.className = "card-body";

          var titleDiv = document.createElement('div');
          titleDiv.className = "mb-2";
          var h = document.createElement("H6");
          h.className = "font-weight-semibold mb-2 product-title";
          var titleA = document.createElement('a');
          titleA.setAttribute('href', "{{url('/exchange')}}/" + list.slug);
          titleA.className = "text-default mb-2";
          titleA.text = list.product_title;
          h.append(titleA);
          titleDiv.append(h);
          cardBody.append(titleDiv);

          var userDiv = document.createElement('div');
          userDiv.className = "product-meta d-flex flex-row mb-2";
          var userAvatarDiv = document.createElement('div');
          userAvatarDiv.className = "user-avatar p-1";
          var imgUserAvatar = document.createElement("img");
          imgUserAvatar.setAttribute("src", "{{static_url('avatar')}}/"+list.user.profile_picture);
          imgUserAvatar.className = "avatar";
          userAvatarDiv.append(imgUserAvatar);
          userDiv.append(userAvatarDiv);
          var userNameDiv = document.createElement('div');
          userNameDiv.className = "user-name align-self-center";
          var userNameA = document.createElement('a');
          userNameA.setAttribute('href', "{{url('/user')}}/" + list.owner.username);
          userNameA.text = list.owner.username;
          userNameDiv.innerHTML = 'By ';
          userNameDiv.append(userNameA);
          userDiv.append(userNameDiv);
          cardBody.append(userDiv);
          
          var span = document.createElement('span');
          span.innerHTML = "Buy Now: $"+ list.price;
          span.style.cssText = 'color:green;font-weight:bold';
          cardBody.append(span);

          cardDiv.append(cardBody);
          ret.append(cardDiv);
          $("#listing").append(ret);
        })
        // Paginavigation
        $("#paginav").empty();
        var totalPaginate = Math.ceil(listingData.length/pageSize);
        if(totalPaginate == 0) index = 0;

        var firstLi = document.createElement('li');
        firstLi.className = "page-item";
        firstLi.style.cursor = "pointer";
        var span = document.createElement('span');
        span.className = "page-link";
        span.setAttribute('aria-hidden', true);
        span.innerHTML = '<<';
        firstLi.append(span);
        firstLi.onclick = function(){
          if(index == 1 || index == 0) return;
          index = 1;
          load_data();
        };
        $("#paginav").append(firstLi);

        var prevLi = document.createElement('li');
        prevLi.className = "page-item";
        prevLi.style.cursor = "pointer";
        var span = document.createElement('span');
        span.className = "page-link";
        span.setAttribute('aria-hidden', true);
        span.innerHTML = '<';
        prevLi.append(span);
        prevLi.onclick = function(){
          if(index == 1 || index == 0) return;
          index--;
          load_data();
        };
        $("#paginav").append(prevLi);

        var content = document.createElement('li');
        content.className = "page-item";
        var span = document.createElement('span');
        span.className = "page-link";
        span.innerHTML = index + ' of ' + totalPaginate;
        content.append(span);
        $("#paginav").append(content);

        var nextLi = document.createElement('li');
        nextLi.className = "page-item";
        nextLi.style.cursor = "pointer";
        var span = document.createElement('span');
        span.className = "page-link";
        span.innerHTML = '>';
        nextLi.append(span);
        nextLi.onclick = function(){
          if(index == totalPaginate) return;
          index++;
          load_data();
        };
        $("#paginav").append(nextLi);

        var lastLi = document.createElement('li');
        lastLi.className = "page-item";
        lastLi.style.cursor = "pointer";
        var span = document.createElement('span');
        span.className = "page-link";
        span.setAttribute('aria-hidden', true);
        span.innerHTML = '>>';
        lastLi.append(span);
        lastLi.onclick = function(){
          if(index == totalPaginate) return;
          index = totalPaginate;
          load_data();
        };
        $("#paginav").append(lastLi);
      }
      load_data();
      $("#categoryAll").click(function() {
        $("#categoryJersey").removeClass("active");
        $("#categoryCard").removeClass("active");
        $(this).addClass("active");
        category = -1;
        index = 1;
        load_data();
      })
      
      $("#categoryJersey").click(function() {
        $("#categoryAll").removeClass("active");
        $("#categoryCard").removeClass("active");
        $(this).addClass("active");
        category = 0;
        index = 1;
        load_data();
      })
      
      $("#categoryCard").click(function() {
        $("#categoryAll").removeClass("active");
        $("#categoryJersey").removeClass("active");
        $(this).addClass("active");
        category = 1;
        index = 1;
        load_data();
      })
      $("#search_keyword").bind('input', function() { 
        keyword = $(this).val();
        index = 1;
        load_data();
      });
    });
  </script>
@endsection