<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="em_quote_form">
                <div class="quote_form_inner" >
                    <div class="quote_form_field">
                        <input type="text" name="search_bar" id="search_bar" placeholder="@if(isset($search_bar_place_holder)){{ $search_bar_place_holder }}@else{{'Search'}}@endif" class="box-shadow"/>
                        @if(!isset($show_button) OR $show_button == true)
                        <button class="quote_button" id="search_bar_submit">@if(isset($search_bar_button_text)){{ $search_bar_button_text }}@else{{ 'Submit' }}@endif</button>
                        @endif
                        <div class="autocom-box box-shadow inactive" id="autocom_box"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
