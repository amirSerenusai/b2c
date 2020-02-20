<button class="btn btn-primary btn-lg" data-toggle="modal" id="afterOrderModal"  data-target="#myModal">Launch modal</button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="afterOrderModalHeading">Modal Heading afterOrderModalHeading</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>Text in a modal</h4>
                    <p id="afterModalBody">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>

                    <h4>{{s_title( app('request')->input('n') ) }}</h4>

                    <p>This <a href="#" role="button" class="btn btn-secondary" data-toggle="popover" title="" data-content="And here's some amazing content. It's very engaging. right?" data-original-title="A Title">button</a> should trigger a popover on click.</p>
                    <div>
                     @if (auth()->user()->client_id)
                        <a href="{{ route( 'combination.run', 109  )}}" role="button" class="btn btn-secondary">button</a>
                         @else
                            <a href="{{ route( 'procedures.run', 109  )}}" role="button" class="btn btn-secondary">button</a>
                     @endif
                    </div>
                    {{--@component('mail::button', ['url' => route( 'combination.run', $combinationID  )] )"--}}
                    <h4>Tooltips in a modal</h4>
                    <p><a href="#" data-toggle="tooltip" title="" data-original-title="Tooltip">This link</a> and <a href="#" data-toggle="tooltip" title="" data-original-title="Tooltip">that link</a> should have tooltips on hover.</p>
                    <hr>
                    <h4>Overflowing text to show scroll behavior</h4>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                    <p class="nobottommargin">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
