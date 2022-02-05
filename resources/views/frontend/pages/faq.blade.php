@extends ('../../layouts/app')
@section('title')
    Frequently Asked Questions - Jersey Swap
@endsection
@section('meta_description')
    Jersey Swap is revolutionizing the sports collection industry by providing a  platform that operates as the central hub for sports jerseys and sports cards trading.
@endsection
@section('content')
    <section id="page-box" class="page-hero-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Frequently Asked Questions</h1>
                    <ul class="breadcrumb mx-auto justify-content-center" aria-label="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Frequently Asked Questions
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us" class="mt-md-3 mt-0 pt-md-5 pt-0 pb-md-5 pb-0">
        <div class="container">
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What is Jerseyswaponline.com?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Located in Voorhees NJ, Jersey Swap currently has 10 employees, and 10,000 users currently signed up on the site! Jersey Swap gives users the ability to create their own listings and manage their own deals! Users have the ability to buy, sell, and swap sports jerseys and sports cards with different users across the United States!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Can I create my own listing after I sign up?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            YES, the site has no sign up or listing fees! Anyone can post as many listings as they want to the exchange free of charge.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How do I create a listing?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            All you have to do is go to the “create listing” tab and input the information required. Listings will include a description and images of the item you are listing on the site. If you are looking to swap, please include specific items you are looking for in the description.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                            What fees are included?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="collapseFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            The ONLY fee on the site is the “security fee”. It is paid only when a user accepts an offer and is checking out. This is a $1.00 fee that is paid with every transaction. We pride ourselves on limiting fees for a better user experience. Unlike our competitors.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                            Can I only swap items, or can I purchase items as well?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="collapseFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            There are 2 ways to make deal on Jersey Swap!
                            <ol>
                                <li>The first way is by viewing the listing on the exchange and pressing "Buy it now" allowing the user to purchase the item.</li>
                                <li>The second way is by viewing the listing on the exchange and pressing "Make trade offer". This will allow you to send an offer with images of the item you are attempting to swap.</li>
                            </ol>
                            For example, Ryan has a Lebron James Heat jersey and creates a listing on the exchange. Matthew has a Lebron James Cavaliers jersey and sends Ryan an offer with images of his Lebron James Cavaliers jersey. Ryan now gets a notification through the site and has the option to “accept” or “decline” the offer. If accepted both parties will get a new Lebron James jersey for just $1.00!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            What happens when a swap offer is accepted?
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>User 1 (owner), who is accepting the offer will be taken to the checkout page. When User 1 completes the checkout, User 2 (offer maker) will be notified on the site and through email to complete the checkout.</p>
                            <p>Both users can track the deal in the "transactions" tab. Both users will see the deal in "pending payment" until both parties complete the checkout, then it will be shown as "in progress".</p>
                            <p>When the deal is showing as "in progress" both parties will be provided the shipping information by email, and are required to ship the sports jersey/ sports card immediately. Users will be sent real time updates/ provided tracking numbers through website notifications as well!</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            What happens when a purchase offer (Buy it now) is accepted?
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>User 1 (owner), who is accepting the offer for their listing will be taken to the checkout page. When User 1 (owner) completes the checkout, User 2 (offer maker) will be notified on the site and through email to complete the checkout and pay for the item during checkout.</p>
                            <p>Both users can track the deal in the "transactions" tab. Both users will see the deal in "pending payment" until both parties completed the checkout, then it will be shown as "in progress".</p>
                            <p>When the deal is showing as "in progress" User 1 (owner) will be provided the shipping information by email, and are required to ship the sports jersey/ sports card immediately. Both users will be sent real time updates, and User 2 (offer maker) will be provided the tracking number through the website notifications/email as well.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            Where are my funds from the deal?
                        </button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            All funds for swaps/purchases are held in escrow until the deal is marked as "completed" by Jersey Swap in the "transactions" tab. Deals get marked as completed when the sports jersey/sports card have arrived at the door step.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            The deal is completed how do I withdraw my funds?
                        </button>
                    </h2>
                    <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            When the deal is marked as completed, the funds can be found in your "dashboard" where it says "credits" next to your profile picture. When a user has credits present, they will be able to press the "withdraw amount" icon. This will send an alert to Jersey Swap and a representative will be in contact with you immediately in regards to the method of receiving funds!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEleven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                            How do I leave a review when the deal is completed?
                        </button>
                    </h2>
                    <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            When a deal is marked as completed, both users will be given a site notification to leave a review. All reviews are based out of 5 stars, and users can leave comments as well. Please be courteous when submitting reviews as it will show on the user’s profile! False reviews can lead to a termination on your account, and an IP address ban preventing you from using the site permanently.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwelve">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                            Can I create a listing for my sports cards or is it only sports jerseys?
                        </button>
                    </h2>
                    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            YES, both sports cards and sports jerseys are allowed to be listed on the site!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                            I filled out my dashboard/ profile with sensitive information can anyone see it?
                        </button>
                    </h2>
                    <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            NO, absolutely not. When a user checks out your profile, they can only view the "about" section, profile picture, username, and reviews! All personal information is kept private for your safety!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFourteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                            I signed up with my email and personal information will I receive spam messages?
                        </button>
                    </h2>
                    <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            NO, absolutely not. Jersey Swap will not market to you in any form. You will receive notifications in regards to offers on your listings, and updates. However, at no time will Jersey Swap sell any of your information or use it for marketing in any type of way. That is highly against our policy!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFifteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapseFifteen">
                            I pressed "Buy it now" why does it say offer has been made?
                        </button>
                    </h2>
                    <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            "Buy it now" and "Make trade offer" work completely identical. The user who created the listing on the exchange (owner) has to "accept" the offer for the transaction to start! The deal will not start until the item owner agrees to accept!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSixteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapseSixteen">
                            Can I chat with a different user about a listing I am interested in?
                        </button>
                    </h2>
                    <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            YES, users can chat in the "Inbox" tab which can be used to communicate with users across the country or negotiate offers! Users will get site alerts if they get sent new messages! To chat, please type the users name where it says "type username".
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSeventeen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapseSeventeen">
                            How do I know what offers are pending and what offers are declined?
                        </button>
                    </h2>
                    <div id="collapseSeventeen" class="accordion-collapse collapse" aria-labelledby="headingSeventeen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            In my account, please go to "active offers". This will show all offers that are still pending, declined, and accepted! You will be able to track all offers you make by using this tab.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingEighteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEighteen" aria-expanded="false" aria-controls="collapseEighteen">
                            I am looking for a specific item how can I find it?
                        </button>
                    </h2>
                    <div id="collapseEighteen" class="accordion-collapse collapse" aria-labelledby="headingEighteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            In the "exchange" tab we provide users a search bar which will help locate any specific item you are looking for!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNineteen">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNineteen" aria-expanded="false" aria-controls="collapseNineteen">
                            How do I cancel or edit a listing that I have listed?
                        </button>
                    </h2>
                    <div id="collapseNineteen" class="accordion-collapse collapse" aria-labelledby="headingNineteen" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            If you go to "My account" and then "Listings" you can view all the listings you currently have. If you press the title of the listing, you will have the option to "cancel listing" or "edit listing". However, listings can not be edited once an offer is already made on it.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwenty">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty" aria-expanded="false" aria-controls="collapseTwenty">
                            I accepted an offer and user 2 never checked out. What do I do if its still in pending payment?
                        </button>
                    </h2>
                    <div id="collapseTwenty" class="accordion-collapse collapse" aria-labelledby="headingTwenty" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            All accepted offers have an expiration period of 5 days. If both users do not check out the order will be cancelled and the user will be refunded. Refunds will show as site credit which can be found in a user’s "Dashboard". To withdraw please press "withdraw amount" and a Jersey Swap representative will be with you promptly.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyOne" aria-expanded="false" aria-controls="collapseTwentyOne">
                            When do I ship the items?
                        </button>
                    </h2>
                    <div id="collapseTwentyOne" class="accordion-collapse collapse" aria-labelledby="headingTwentyOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            As previously mentioned, items are required to be shipped immediately when the deal shows as "In progress" in the "transactions tab". Only then will the shipping information be provided!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyTwo" aria-expanded="false" aria-controls="collapseTwentyTwo">
                            I was sent the wrong item! What should I do?
                        </button>
                    </h2>
                    <div id="collapseTwentyTwo" class="accordion-collapse collapse" aria-labelledby="headingTwentyTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Please contact Jersey Swap IMMEDIATELY! Contact us through our contact page or email (<a href="mailto:officialjerseyswap@gmail.com">Officialjerseyswap@gmail.com</a>). We will contact all parties involved to try to resolve the issue as fast as possible. If the issue cannot be resolved, you will be refunded the SAME amount as the lost item or lost funds. If a fraud/ scam is expected legal authorities will be involved in an investigation. Fraud charges can include up to a $10,000 penalty, and up to 5 years in prison.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyThree" aria-expanded="false" aria-controls="collapseTwentyThree">
                            I was sent no item! What Should I do?
                        </button>
                    </h2>
                    <div id="collapseTwentyThree" class="accordion-collapse collapse" aria-labelledby="headingTwentyThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Please contact Jersey Swap IMMEDIATELY! Contact us through our contact page or email (<a href="mailto:officialjerseyswap@gmail.com">Officialjerseyswap@gmail.com</a>). We will contact all parties involved to try to resolve the issue as fast as possible. If the issue cannot be resolved you will be refunded the SAME amount as the lost item or lost funds. If a fraud/ scam is expected legal authorities will be involved in an investigation. Fraud charges can include up to a $10,000 penalty, and up to 5 years in prison.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyFour" aria-expanded="false" aria-controls="collapseTwentyFour">
                            I was a victim of fraud what should I do?
                        </button>
                    </h2>
                    <div id="collapseTwentyFour" class="accordion-collapse collapse" aria-labelledby="headingTwentyFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Please contact Jersey Swap IMMEDIATELY! Law enforcement will be contacted to start a legal investigation. The users account will be terminated from the website, and funds associated with the profile will be cleared. The user will have his IP address banned from using the website permanently. Fraud charges can include up to a $10,000 penalty, and up to 5 years in prison as per the United States law.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyFive" aria-expanded="false" aria-controls="collapseTwentyFive">
                            I want to cancel an order how do I cancel?
                        </button>
                    </h2>
                    <div id="collapseTwentyFive" class="accordion-collapse collapse" aria-labelledby="headingTwentyFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Users can only cancel orders by contacting us first! If the order gets cancelled it will shows as "cancelled" in the transactions tab. If an order is cancelled you will be refunded the full amount that you paid. However, you will not be refunded shipping and handling. The refund will show in "site credits" in your "dashboard". Please press "withdraw amount" to be contacted by a Jersey Swap representative to obtain funds.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentySix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentySix" aria-expanded="false" aria-controls="collapseTwentySix">
                            How do I track all my transactions?
                        </button>
                    </h2>
                    <div id="collapseTwentySix" class="accordion-collapse collapse" aria-labelledby="headingTwentySix" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            All transactions can be tracked in the "transactions" tab. Users can press the "product title" to reveal the unique deal number! It also shows the listing, and the offer that was accepted. Furthermore, users can view the real time tracking updates in this tab as well!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentySeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentySeven" aria-expanded="false" aria-controls="collapseTwentySeven">
                            Is there a notification system?
                        </button>
                    </h2>
                    <div id="collapseTwentySeven" class="accordion-collapse collapse" aria-labelledby="headingTwentySeven" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            YES! Users can look at all site notifications by viewing the "bell" icon! This includes getting offer alerts, declined alerts, offer accepted alerts, checkout alert, real time tracking alerts, etc. Also, users will get emailed with any important alerts as well!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyEight" aria-expanded="false" aria-controls="collapseTwentyEight">
                            Why is there an amount in Make trade offer?
                        </button>
                    </h2>
                    <div id="collapseTwentyEight" class="accordion-collapse collapse" aria-labelledby="headingTwentyEight" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Users can include an amount in the offer if the swap is unfair. Users can use the amount to make the trade more even!</p>
                            <p>For example, Ryan creates a listing for an Aaron Rodgers vintage Packers jersey worth $200. Matthew, sends Ryan an offer with images of his $150 Patrick Mahomes Chiefs jersey. Matthew will also include $50 in the "amount" to make the trade fairer in hopes the offer will be accepted! If the offer is accepted Ryan will now have the Patrick Mahomes Chiefs jersey and $50 in credit.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwentyNine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyNine" aria-expanded="false" aria-controls="collapseTwentyNine">
                            I think the buy it now price is high! Can I customize the amount?
                        </button>
                    </h2>
                    <div id="collapseTwentyNine" class="accordion-collapse collapse" aria-labelledby="headingTwentyNine" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            If you want to make your own custom purchase offer users can use the "Make trade offer" button on the exchange. Please enter the amount you wish to offer and keep the image section empty. Your custom priced offer will now send!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirty">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirty" aria-expanded="false" aria-controls="collapseThirty">
                            The swap is not going to be fair! What can I do?
                        </button>
                    </h2>
                    <div id="collapseThirty" class="accordion-collapse collapse" aria-labelledby="headingThirty" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Users can include an amount in the offer if the swap is unfair. Users can use the amount to make the trade more even!</p>
                            <p>For example, Ryan creates a listing for an Aaron Rodgers vintage Packers jersey worth $200. Matthew, sends Ryan an offer with images of his $150 Patrick Mahomes Chiefs jersey. Matthew will also include $50 in the "amount" to make the trade fairer in hopes the offer is now accepted! If the offer is accepted Ryan will now have the Patrick Mahomes Chiefs jersey and $50 in credit.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirtyOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyOne" aria-expanded="false" aria-controls="collapseThirtyOne">
                            What are credits?
                        </button>
                    </h2>
                    <div id="collapseThirtyOne" class="accordion-collapse collapse" aria-labelledby="headingThirtyOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Credits can be withdrawn and turned into U.S currency.</p>
                            <p>For example, $25 credits are equal to $25.00!</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirtyTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyTwo" aria-expanded="false" aria-controls="collapseThirtyTwo">
                            Do I ship my items to Jersey Swap or to the user?
                        </button>
                    </h2>
                    <div id="collapseThirtyTwo" class="accordion-collapse collapse" aria-labelledby="headingThirtyTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Jersey Swap will facilitate the entire deal. However, users will send the items to each other when the deal is marked as "in progress".
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirtyThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyThree" aria-expanded="false" aria-controls="collapseThirtyThree">
                            Why is there only the security fee?
                        </button>
                    </h2>
                    <div id="collapseThirtyThree" class="accordion-collapse collapse" aria-labelledby="headingThirtyThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We only have the $1.00 security fee because as a company we want everyone to be able to obtain new sports cards and sports jerseys. We are in business because of our users! And we want to expand the website with them. We know how important profits and we want to help users in any way possible!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirtyFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyFour" aria-expanded="false" aria-controls="collapseThirtyFour">
                            What is the image gallery?
                        </button>
                    </h2>
                    <div id="collapseThirtyFour" class="accordion-collapse collapse" aria-labelledby="headingThirtyFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            The image gallery is where users upload images of the sports jersey/ sports card to show users the condition of the item!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirtyFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtyFive" aria-expanded="false" aria-controls="collapseThirtyFive">
                            What is the exchange?
                        </button>
                    </h2>
                    <div id="collapseThirtyFive" class="accordion-collapse collapse" aria-labelledby="headingThirtyFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            The exchange is where users can find items listed on the site! Press the title of any listing on the exchange to view the listing and potentially make an offer!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThirtySix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirtySix" aria-expanded="false" aria-controls="collapseThirtySix">
                            What happens after I send an offer?
                        </button>
                    </h2>
                    <div id="collapseThirtySix" class="accordion-collapse collapse" aria-labelledby="headingThirtySix" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            The owner will be able to review your proposal and either accept or decline it! You will get a site notification and email notification based on what the owner decides.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
