<div class="white-row">
    {foreach $view_mail as $mail}
    <div class="row">
        <div class="col-sm-2"> <img class="img-responsive" src="{$smarty.const.USER_PICS_URL}{$mail['username']}/{$mail['pic']}" /> 
        </div>
        <div class="col-sm-10 text-right">
            <h3> <small>Message from <a href="{$smarty.const.BASE_URL}member/view/{$mail['sender']}" />
                {$mail['sender']}
                </a> &bull; <strong>
                {$format->datetime( $mail['date'] )}
                </strong></small> <br />
                <em>"
                {$mail['subject']}
                "</em> </h3>
        </div>
    </div>
    <hr class="margin-top10 margin-bottom10" />

    <div>
        <p>
            {$mail['message']}
        </p>
    </div>
    
    {/foreach}
    <br>
    <br>
    <div class="toogle">
        <div class="toggle">
            <label>Reply</label>
            <div class="toggle-content">
                <p> 
                    <script src="{$smarty.const.MODULES_URL}ckeditor/ckeditor.js"></script>
                <form action="{$smarty.const.BASE_URL}documents/process" method="post" role="form">
                    <div class="input-group"> 
                    <span class="input-group-addon"><span style="font-size: 21px; font-weight: bold; letter-spacing: 1px;">Subject </span></span>
                        <input type="text" class="form-control" id="document_title" name="document_title" placeholder="RE: {$mail['subject']}">
                    </div>
                    <br>
                    <textarea name="document" id="document" rows="10" cols="80"></textarea>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'document' );
                    </script> 
                    <br>
                    <br>
                    
                    <button class="btn btn-success pull-right" data-loading-text="Saving..."><i class="fa fa-envelope-o"></i> Send</button>
                </form>
                </p>
            </div>
        </div>
    </div>
</div>