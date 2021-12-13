'use strict';


const e = React.createElement;

class ReviewsContainer extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            loadMore : false,
            data : [],
            isLoaded: false,
            avgRating:0,
            totalRating:0,
            page:1
        };
    }
    componentDidMount() {
        fetch('/reviews/'+user+"?page="+this.state.page)
        .then(res => res.json())
        .then(result => {
            this.setState({
            isLoaded: true,
            data: result.reviews.data
            });
            if(result.reviews.next_page_url==null){
                this.setState({
                    loadMore:false
                });
            }
            else{
                var new_page = this.state.page+1;
                this.setState({
                    page: new_page,
                    loadMore: true
                });
            }
            console.log(result);
        });

        fetch('/reviews_meta/'+user)
        .then(res => res.json())
        .then(result => {
            this.setState({
                avgRating : result.data.avg_rating,
                totalRating : result.data.total_reviews
            });
        });
    }
    loadReviews = event =>{
        fetch('/reviews/'+user+"?page="+this.state.page)
        .then(res => res.json())
        .then(result => {
            var reviews = this.state.data;
            reviews.push(...result.reviews.data);
            this.setState({
            data: reviews
            });
            if(result.reviews.next_page_url==null){
                this.setState({
                    loadMore: false
                });
            }
            else{
                var new_page = this.state.page+1;
                this.setState({
                    page: new_page,
                    loadMore: true
                });
            }
        });
    }
    render() {
        if(!this.state.isLoaded){
            return(
                <div className="col-md-12">
                    Loading...
                </div>
            );
        }
        if(this.state.data.length){
            return (
                <div>
                    <div className="col-md-12">
                        <h2>Reviews as a user
                            <span className="star">Avg <i className="fa fa-star yellow"></i>{parseFloat(this.state.avgRating)}</span>
                            <span>| Total {this.state.totalRating}</span>
                        </h2>
                        <hr/>
                    </div>
                    {this.state.data.map(function(review,i){
                        var date = new Date(review.created_at);
                        return (
                            <div className="col-md-12 review">
                                <div className="row">
                                    <div className="col-md-1 col-2">
                                        <div className="user-avatar p-1">
                                            <img src={base_url+"/"+review.owner.profile_picture} className="avatar w-100" />
                                        </div>
                                    </div>
                                    <div className="col-md-11">
                                        <b>{review.owner.username}</b>
                                        <span className="star"><i className="fa fa-star yellow"></i>{review.rating}</span>
                                        <p>{review.feedback}</p>
                                        <p className="text-grey">Published on {date.getDate()+" "+date.toLocaleString('default', { month: 'long' })+" ,"+date.getFullYear()}</p>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        );
                    })}
                    {this.state.loadMore ? 
                        <div className="col-md-12 text-end">
                            <button className="btn btn-primary" onClick={this.loadReviews}><i className="fa fa-plus"></i> Load More</button>
                        </div>
                         : ' '
                    }
                </div>
            );
        }
        else{
            return(
                <div className="col-md-12">
                    No Reviews Found!
                </div>
            );
        }
    }
}

const domContainer = document.querySelector('#reviews_container');
ReactDOM.render(e(ReviewsContainer), domContainer);