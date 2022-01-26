'use strict';


const e = React.createElement;
const pageSize = 7;

class ReviewsContainer extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data : [],
            isLoaded: false,
            avgRating:0,
            totalRating:0,
            index: 0,
            totalPages: 0,
        };
    }
    componentDidMount() {
        fetch('/reviews/'+user)
        .then(res => res.json())
        .then(result => {
            this.setState({
                isLoaded: true,
                data: result.reviews,
            });
            if(result.reviews.length > 1)
                this.setState({totalPages: Math.ceil(result.reviews.length/pageSize), index: 1});
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

    onClickFirst(){
        if(this.state.index<2) return;
        this.setState({index: 1});
    }

    onClickPrev(){
        if(this.state.index<2) return;
        this.setState({index: this.state.index - 1});
    }

    onClickNext(){
        if(this.state.index>=this.state.totalPages) return;
        this.setState({index: this.state.index + 1});
    }

    onClickLast(){
        if(this.state.index>=this.state.totalPages) return;
        this.setState({index: this.state.totalPages});
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
            let showData= this.state.data.slice((this.state.index - 1) * pageSize, this.state.index * pageSize);
            console.log(showData);
            return (
                <div>
                    <div className="col-md-12">
                        <h2>Reviews
                            <span className="star">Avg <i className="fa fa-star yellow"></i>{parseFloat(this.state.avgRating)}</span>
                            <span>| Total {this.state.totalRating}</span>
                        </h2>
                        <hr/>
                    </div>
                    {showData.map(function(review,i){
                        var date = new Date(review.created_at);
                        return (
                            <div className="col-md-12 review">
                                <div className="row">
                                    <div className="col-md-1 col-2">
                                        <div className="user-avatar p-1">
                                            <img src={static_url+"avatar/"+review.owner.profile_picture} className="avatar w-100" />
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
                    <div className="row">
                        <div className="col-md-12 mt-4">
                            <div className="d-flex justify-content-center">
                            <nav>
                                <ul className="pagination">
                                    <li className="page-item" onClick={this.onClickFirst.bind(this)}>
                                        <span className="page-link" style={{cursor: 'pointer'}} aria-hidden="true">{"<<"}</span>
                                    </li>
                                    <li className="page-item" onClick={this.onClickPrev.bind(this)}>
                                        <span className="page-link" style={{cursor: 'pointer'}} aria-hidden="true">{"<"}</span>
                                    </li>
                                    <li className="page-item">
                                        <span className="page-link" aria-hidden="true">
                                            {this.state.index} {'\u00A0'}of {'\u00A0'}{this.state.totalPages}    
                                        </span>
                                    </li>
                                    <li className="page-item" onClick={this.onClickNext.bind(this)}>
                                        <span className="page-link" style={{cursor: 'pointer'}} aria-hidden="true">{">"}</span>
                                    </li>
                                    <li className="page-item" onClick={this.onClickLast.bind(this)}>
                                        <span className="page-link" style={{cursor: 'pointer'}} aria-hidden="true">{">>"}</span>
                                    </li>
                                </ul>
                            </nav>
                            </div>
                        </div>
                    </div>
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