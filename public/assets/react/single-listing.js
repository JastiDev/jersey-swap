'use strict';


const e = React.createElement;

class SingleListing extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            isLoaded: false,
            offerStatus: null,
            offers: [],
            makePayment : false,
            tracking : [],
        };
    }
    componentDidMount() {
        setTimeout(() => {
            fetch('/offers/'+listing)
            .then(res => res.json())
            .then(result => {
                this.setState({
                        offers : result.response, makePayment : result.makePayment, isLoaded:true
                    });
                if(result.response.length>0){
                    // let hasBuyRequest = false;
                    // for(let item of result.response){
                    //     if(item.offer_status === "buyRequest"){
                    //         hasBuyRequest = true;
                    //         break;
                    //     }
                    // }

                    // if(hasBuyRequest){
                    //     let tempResult = result.response.filter(item => item.offer_status === "buyRequest");
                    //     this.setState({
                    //         offers : tempResult, makePayment : result.makePayment, isLoaded:true
                    //     });
                    // }else
                        this.setState({
                            offers : result.response, makePayment : result.makePayment, isLoaded:true
                        });
                }
                if(result.makePayment==false){
                    fetch('/deal_tracking/'+listing)
                    .then(res => res.json())
                    .then(result => {
                        console.log(result);
                        this.setState({
                            tracking : result.tracking
                        });
                    });
                }
            });
        }, 500);
    }
    loader(){
        return(
                <div className="container mb-5">
                    <div className="row">
                        <div className="col-md-12">
                            Loading...
                        </div>
                    </div>
                </div>
            );
    }
    offers(){
        let offersText = "Offers";
        if(listing_status=="closed"){
            offersText = "Accepted Offer";
        }
        return (
        <section id="offers" className="mb-5">
            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <h2>{offersText}</h2>
                        <hr/>
                        {this.state.offers.map(function(offer, i){
                          let offer_maker_link = '/user/'+offer.username;
                          return (
                                <div className="card card-offer mb-3" key={i}>
                                    <div className="card-body">
                                        <div className="row">
                                            <div className="col-md-1">
                                                <img className="avatar" src={offer.user_profile_picture} />
                                            </div>
                                            <div className="col-md-11">
                                                <div className="row">
                                                    <div className="col">
                                                        <p>By <a href={offer_maker_link}>{offer.username}</a></p>
                                                    </div>
                                                    {offer.offer_price>0 ?
                                                        <div className="col text-end">
                                                            <div className="amount">
                                                                ${offer.offer_price}
                                                            </div>
                                                        </div>
                                                        :
                                                        ''
                                                     }
                                                    <div className="description mb-3">
                                                        {offer.description}
                                                    </div>
                                                    
                                                    <div className="gallery mb-3">
                                                    {offer.gallery.map(function(image,i){
                                                        var img_link = "/storage/offers/"+image.image;
                                                        return (
                                                            <a href={img_link} target="__blank">
                                                                <img src={img_link} className="rounded" alt="..." />
                                                            </a>
                                                        );
                                                    })}
                                                    </div>

                                                    {listing_status!="closed" && listing_status!="completed" && listing_status!="cancelled"?
                                                        <div className="buttons text-end">
                                                        <form className="me-2" method="POST" action="/decline-offer">
                                                            <input type="hidden" name="_token" value={csrf} />
                                                            <input type="hidden" name="listing" value={offer.listing_id} />
                                                            <input type="hidden" name="offer" value={offer.id} />
                                                            <button type="submit" className="btn btn-danger"><i className="fa fa-trash"></i> Decline
                                                                Offer</button>
                                                        </form>
                                                        <form className="me-2" method="POST" action="/checkout">
                                                            <input type="hidden" name="type" value="lister" />
                                                            <input type="hidden" name="offer_id" value={offer.id} />
                                                            <input type="hidden" name="offerBy" value={offer.posted_by} />
                                                            <input type="hidden" name="_token" value={csrf} />
                                                            <input type="hidden" name="price" value={offer.offer_price} />
                                                            <input type="hidden" name="listing" value={offer.listing_id} />
                                                            <button type="submit" className="btn btn-success"><i className="fa fa-check">
                                                                </i> 
                                                                {offer.offer_status == "buyRequest"?" Pay security fee":" Accept Offer"}
                                                            </button>
                                                        </form>
                                                    </div>
                                                    :
                                                    ''
                                                    }

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          );
                        })}
                    </div>
                </div>
            </div>
        </section>
        );
    }
    makePayment(){
        return (
        <section id="payment" className="mb-5">
            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <h2>Make Payment</h2>
                        <hr/>
                        <div className="card card-offer mb-3">
                            <div className="card-body">
                                <p>Your offer has been accepted. To start the transaction, we need you to make your payment so the transaction can start.</p>
                                <form method="POST" action="/checkout">
                                    <input type="hidden" name="_token" value={csrf} />
                                    <input type="hidden" name="type" value="offerMaker" />
                                    <input type="hidden" name="listing" value={listing} />
                                    <div className="text-end">
                                        <button type="submit" className="btn btn-success">Make Payment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        );
    }
    tracking(){
        return (
            <section id="tracking">
                <div className="container">
                    <div className="row">
                        <div className="col-md-12 order-tracking">
                            <h2>Tracking</h2>
                            <hr/>
                            <div className="timeline p-4 block mb-4">
                                {this.state.tracking.map(function(tracking, i){
                                    var date = new Date(tracking.created_at);
                                    return(
                                        <div className="tl-item" key={i}>
                                            <div className="tl-dot">
                                                <span className="w-32 avatar circle gd-warning">&nbsp;</span>
                                            </div>
                                            <div className="tl-content">
                                                <div className="">
                                                    <h4>{tracking.title}</h4>
                                                    <div className="text-muted mt-1">{date.getDate()+" "+date.toLocaleString('default', { month: 'long' })+","+date.getFullYear()}</div>
                                                </div>
                                                <p>{tracking.message}</p>
                                            </div>
                                        </div>
                                    );
                                })}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
    render() {
        if(!this.state.isLoaded){
            return this.loader();
        }
        let offers = this.offers();
        let payment = this.makePayment();
        let tracking = this.tracking();
        if(this.state.offers.length<=0){
            return ('');
        }
        return(
            <div>
                {listing_status!="cancelled" ? offers : ''}
                {this.state.makePayment==true ? payment : ''}

                {this.state.tracking.length>0 ? tracking : ''}
            </div>
        );
    }
}

const domContainer = document.querySelector('#data-loader');
ReactDOM.render(e( SingleListing), domContainer);