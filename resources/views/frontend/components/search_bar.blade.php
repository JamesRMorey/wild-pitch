<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="em_quote_form">
                <form action="#">
                    <div class="quote_form_inner" >
                        <div class="quote_form_field">
                            <input type="text" name="search_bar" placeholder="@if(isset($search_bar_place_holder)){{ $search_bar_place_holder }}@else{{'Search'}}@endif" class="box-shadow"/>
                            <button class="quote_button" name="submit">@if(isset($search_bar_button_text)){{ $search_bar_button_text }}@else{{ 'Submit' }}@endif</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
